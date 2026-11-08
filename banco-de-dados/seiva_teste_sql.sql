-- ==============================================================================
-- Script SQL DDL (MySQL 8) - MVP SEIVA (Gestão Financeira Pessoal e Compartilhada)
-- Compatível com Laravel 11 (snake_case, id bigint auto_increment, timestamps)
-- ==============================================================================

SET FOREIGN_KEY_CHECKS = 0;

-- -----------------------------------------------------
-- 1. Tabela: usuarios
-- -----------------------------------------------------
CREATE TABLE `usuarios` (
  `id_usuario` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `telefone` VARCHAR(20) DEFAULT NULL,
  `senha_hash` VARCHAR(255) NOT NULL,
  `tipo_renda` ENUM('clt', 'pj', 'autonomo', 'outro') NOT NULL DEFAULT 'clt',
  `renda_mensal` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `dia_recebimento` INT DEFAULT NULL,
  `tem_renda_extra` BOOLEAN NOT NULL DEFAULT FALSE,
  `renda_extra` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `banco_principal` VARCHAR(100) DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuarios_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- 2. Tabela: sessao_tokens
-- -----------------------------------------------------
CREATE TABLE `sessao_tokens` (
  `id_sessao_token` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` BIGINT UNSIGNED NOT NULL,
  `token` VARCHAR(255) NOT NULL,
  `expira_em` TIMESTAMP NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_sessao_token`),
  UNIQUE KEY `sessao_tokens_token_unique` (`token`),
  CONSTRAINT `fk_sessao_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- 3. Tabela: lares
-- -----------------------------------------------------
CREATE TABLE `lares` (
  `id_lar` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `emoji` VARCHAR(50) DEFAULT '🏠',
  `criado_por` BIGINT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_lar`),
  CONSTRAINT `fk_lar_criador` FOREIGN KEY (`criado_por`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- 4. Tabela: lar_membros
-- -----------------------------------------------------
CREATE TABLE `lar_membros` (
  `id_lar_membro` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lar_id` BIGINT UNSIGNED NOT NULL,
  `usuario_id` BIGINT UNSIGNED NOT NULL,
  `papel` ENUM('administrador', 'membro') NOT NULL DEFAULT 'membro',
  `renda_declarada` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `percentual_contribuicao` DECIMAL(5,2) NOT NULL DEFAULT 0.00,
  `aceito_em` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_lar_membro`),
  UNIQUE KEY `lar_membro_unique` (`lar_id`, `usuario_id`),
  CONSTRAINT `fk_membro_lar` FOREIGN KEY (`lar_id`) REFERENCES `lares` (`id_lar`) ON DELETE CASCADE,
  CONSTRAINT `fk_membro_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- 5. Tabela: convites_lar
-- -----------------------------------------------------
CREATE TABLE `convites_lar` (
  `id_convite_lar` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lar_id` BIGINT UNSIGNED NOT NULL,
  `convidado_por` BIGINT UNSIGNED NOT NULL,
  `email_convidado` VARCHAR(255) DEFAULT NULL,
  `token_convite` VARCHAR(100) NOT NULL,
  `status` ENUM('pendente', 'aceito', 'expirado') NOT NULL DEFAULT 'pendente',
  `expira_em` TIMESTAMP NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_convite_lar`),
  UNIQUE KEY `convite_token_unique` (`token_convite`),
  CONSTRAINT `fk_convite_lar` FOREIGN KEY (`lar_id`) REFERENCES `lares` (`id_lar`) ON DELETE CASCADE,
  CONSTRAINT `fk_convite_autor` FOREIGN KEY (`convidado_por`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- 6. Tabela: contas
-- -----------------------------------------------------
CREATE TABLE `contas` (
  `id_conta` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` BIGINT UNSIGNED NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `tipo` ENUM('corrente', 'poupanca', 'cartao', 'carteira') NOT NULL,
  `saldo` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `comprometido` DECIMAL(12,2) DEFAULT 0.00,
  `funcao` ENUM('gasto', 'reserva', 'carteira') DEFAULT NULL,
  `objetivo` VARCHAR(255) DEFAULT NULL,
  `cor` VARCHAR(20) DEFAULT '#000000',
  `chave_pix` VARCHAR(255) DEFAULT NULL,
  `limite` DECIMAL(12,2) DEFAULT NULL,
  `usado` DECIMAL(12,2) DEFAULT NULL,
  `vencimento_fatura` INT DEFAULT NULL COMMENT 'Dia do vencimento da fatura (1-31)',
  `atualizado_em` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_conta`),
  CONSTRAINT `fk_conta_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- 7. Tabela: categorias
-- -----------------------------------------------------
CREATE TABLE `categorias` (
  `id_categoria` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `emoji` VARCHAR(20) DEFAULT NULL,
  `cor` VARCHAR(20) DEFAULT NULL,
  `sistema` BOOLEAN NOT NULL DEFAULT FALSE,
  `usuario_id` BIGINT UNSIGNED DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_categoria`),
  CONSTRAINT `fk_categoria_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- 8. Tabela: transacoes
-- -----------------------------------------------------
CREATE TABLE `transacoes` (
  `id_transacao` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` BIGINT UNSIGNED NOT NULL,
  `conta_id` BIGINT UNSIGNED NOT NULL,
  `categoria_id` BIGINT UNSIGNED DEFAULT NULL,
  `lar_id` BIGINT UNSIGNED DEFAULT NULL,
  `titulo` VARCHAR(255) NOT NULL,
  `emoji` VARCHAR(50) DEFAULT NULL,
  `valor` DECIMAL(12,2) NOT NULL,
  `tipo` ENUM('entrada', 'saida') NOT NULL,
  `data` DATE NOT NULL,
  `visibilidade` ENUM('pessoal', 'privado', 'compartilhado', 'lar') NOT NULL DEFAULT 'pessoal',
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_transacao`),
  KEY `idx_transacao_data` (`data`),
  CONSTRAINT `fk_transacao_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE,
  CONSTRAINT `fk_transacao_conta` FOREIGN KEY (`conta_id`) REFERENCES `contas` (`id_conta`) ON DELETE CASCADE,
  CONSTRAINT `fk_transacao_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id_categoria`) ON DELETE SET NULL,
  CONSTRAINT `fk_transacao_lar` FOREIGN KEY (`lar_id`) REFERENCES `lares` (`id_lar`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- 9. Tabela: registros_caixa_preta 
-- Refatorada para TEXT (compativel com Eloquent $casts = ['campo' => 'encrypted'])
-- -----------------------------------------------------
CREATE TABLE `registros_caixa_preta` (
  `id_registro_caixa_preta` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` BIGINT UNSIGNED NOT NULL,
  `titulo_cifrado` TEXT NOT NULL,
  `valor_cifrado` TEXT NOT NULL,
  `conta_cifrada` TEXT NOT NULL,
  `data` DATE NOT NULL,
  `bloqueado` BOOLEAN NOT NULL DEFAULT FALSE,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_registro_caixa_preta`),
  CONSTRAINT `fk_caixapreta_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- 10. Tabelas: regras_divisao e regras_divisao_detalhes
-- -----------------------------------------------------
CREATE TABLE `regras_divisao` (
  `id_regra_divisao` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lar_id` BIGINT UNSIGNED NOT NULL,
  `tipo` ENUM('igualitaria', 'proporcional', 'customizada') NOT NULL,
  `ativa` BOOLEAN NOT NULL DEFAULT TRUE,
  `vigente_desde` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_regra_divisao`),
  CONSTRAINT `fk_regradiv_lar` FOREIGN KEY (`lar_id`) REFERENCES `lares` (`id_lar`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE UNIQUE INDEX `idx_regra_ativa_lar` ON `regras_divisao` (`lar_id`, (CASE WHEN ativa = TRUE THEN 1 ELSE NULL END));

CREATE TABLE `regras_divisao_detalhes` (
  `id_regra_divisao_detalhe` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `regra_divisao_id` BIGINT UNSIGNED NOT NULL,
  `usuario_id` BIGINT UNSIGNED NOT NULL,
  `percentual` DECIMAL(5,2) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_regra_divisao_detalhe`),
  UNIQUE KEY `idx_regradetalhe_user` (`regra_divisao_id`, `usuario_id`),
  CONSTRAINT `fk_regradet_regra` FOREIGN KEY (`regra_divisao_id`) REFERENCES `regras_divisao` (`id_regra_divisao`) ON DELETE CASCADE,
  CONSTRAINT `fk_regradet_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- 11. Tabela: despesas_lares
-- -----------------------------------------------------
CREATE TABLE `despesas_lares` (
  `id_despesa_lar` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lar_id` BIGINT UNSIGNED NOT NULL,
  `regra_divisao_id` BIGINT UNSIGNED NOT NULL,
  `registrada_por` BIGINT UNSIGNED NOT NULL,
  `titulo` VARCHAR(255) NOT NULL,
  `emoji` VARCHAR(50) DEFAULT NULL,
  `valor` DECIMAL(12,2) NOT NULL,
  `tipo_despesa` ENUM('fixa', 'variavel', 'emergencia') NOT NULL,
  `divisao_label` VARCHAR(50) DEFAULT NULL,
  `status` ENUM('pago', 'pendente') NOT NULL DEFAULT 'pendente',
  `data_vencimento` DATE DEFAULT NULL,
  `comprovante` BOOLEAN NOT NULL DEFAULT FALSE,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_despesa_lar`),
  CONSTRAINT `fk_despesa_lar` FOREIGN KEY (`lar_id`) REFERENCES `lares` (`id_lar`) ON DELETE CASCADE,
  CONSTRAINT `fk_despesa_regra` FOREIGN KEY (`regra_divisao_id`) REFERENCES `regras_divisao` (`id_regra_divisao`),
  CONSTRAINT `fk_despesa_autor` FOREIGN KEY (`registrada_por`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- 12. Tabela: participacoes_despesas
-- -----------------------------------------------------
CREATE TABLE `participacoes_despesas` (
  `id_participacao_despesa` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `despesa_lar_id` BIGINT UNSIGNED NOT NULL,
  `usuario_id` BIGINT UNSIGNED NOT NULL,
  `transacao_id` BIGINT UNSIGNED DEFAULT NULL COMMENT 'A transacao (movimentacao real) que quitou esta parte',
  `valor_parte` DECIMAL(12,2) NOT NULL,
  `pago` BOOLEAN NOT NULL DEFAULT FALSE,
  `pago_em` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_participacao_despesa`),
  UNIQUE KEY `idx_part_despesa_user` (`despesa_lar_id`, `usuario_id`),
  CONSTRAINT `fk_part_despesa` FOREIGN KEY (`despesa_lar_id`) REFERENCES `despesas_lares` (`id_despesa_lar`) ON DELETE CASCADE,
  CONSTRAINT `fk_part_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE,
  CONSTRAINT `fk_part_transacao` FOREIGN KEY (`transacao_id`) REFERENCES `transacoes` (`id_transacao`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- 13. Tabelas: acordos, participantes e histórico
-- -----------------------------------------------------
CREATE TABLE `acordos` (
  `id_acordo` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lar_id` BIGINT UNSIGNED DEFAULT NULL,
  `usuario_id` BIGINT UNSIGNED DEFAULT NULL COMMENT 'Usado quando o acordo for estritamente pessoal (DividaPrivada)',
  `tipo` ENUM('meta', 'divida') NOT NULL,
  `titulo` VARCHAR(255) NOT NULL,
  `imagem` VARCHAR(255) DEFAULT NULL,
  `valor_total` DECIMAL(12,2) NOT NULL,
  `guardado` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `progresso` INT NOT NULL DEFAULT 0,
  `divisao_label` VARCHAR(50) DEFAULT NULL,
  `valor_mes` DECIMAL(12,2) NOT NULL,
  `conta_destino` VARCHAR(255) DEFAULT NULL,
  `vencimento` DATE DEFAULT NULL,
  `parcelas_total` INT DEFAULT NULL,
  `parcelas_pagas` INT DEFAULT NULL,
  `status` ENUM('ativo', 'em_negociacao') NOT NULL DEFAULT 'ativo',
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_acordo`),
  CONSTRAINT `fk_acordo_lar` FOREIGN KEY (`lar_id`) REFERENCES `lares` (`id_lar`) ON DELETE CASCADE,
  CONSTRAINT `fk_acordo_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE,
  CONSTRAINT `chk_acordo_owner` CHECK (lar_id IS NOT NULL OR usuario_id IS NOT NULL)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `acordo_participantes` (
  `id_acordo_participante` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `acordo_id` BIGINT UNSIGNED NOT NULL,
  `usuario_id` BIGINT UNSIGNED NOT NULL,
  `parte_mensal` DECIMAL(12,2) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_acordo_participante`),
  UNIQUE KEY `idx_acordo_part_user` (`acordo_id`, `usuario_id`),
  CONSTRAINT `fk_apart_acordo` FOREIGN KEY (`acordo_id`) REFERENCES `acordos` (`id_acordo`) ON DELETE CASCADE,
  CONSTRAINT `fk_apart_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `acordo_historicos` (
  `id_acordo_historico` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `acordo_id` BIGINT UNSIGNED NOT NULL,
  `descricao` VARCHAR(255) NOT NULL,
  `estado` ENUM('pago', 'pendente') NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_acordo_historico`),
  CONSTRAINT `fk_ahist_acordo` FOREIGN KEY (`acordo_id`) REFERENCES `acordos` (`id_acordo`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- 14. Tabelas: propostas e negociação
-- -----------------------------------------------------
CREATE TABLE `propostas` (
  `id_proposta` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lar_id` BIGINT UNSIGNED DEFAULT NULL,
  `autor_id` BIGINT UNSIGNED NOT NULL,
  `tipo` ENUM('meta', 'divida') NOT NULL,
  `titulo` VARCHAR(255) NOT NULL,
  `imagem` VARCHAR(255) DEFAULT NULL,
  `link` VARCHAR(255) DEFAULT NULL,
  `valor_total` DECIMAL(12,2) NOT NULL,
  `divisao_label` VARCHAR(50) DEFAULT NULL,
  `valor_mes_por_pessoa` DECIMAL(12,2) NOT NULL,
  `parcelas_total` INT DEFAULT NULL,
  `prazo_meses` INT DEFAULT NULL,
  `mensagem` TEXT,
  `status` ENUM('pendente', 'aceita', 'recusada', 'contraproposta') NOT NULL DEFAULT 'pendente',
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_proposta`),
  CONSTRAINT `fk_proposta_lar` FOREIGN KEY (`lar_id`) REFERENCES `lares` (`id_lar`) ON DELETE CASCADE,
  CONSTRAINT `fk_proposta_autor` FOREIGN KEY (`autor_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `negociacao_rodadas` (
  `id_negociacao_rodada` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `proposta_id` BIGINT UNSIGNED NOT NULL,
  `autor_id` BIGINT UNSIGNED NOT NULL,
  `valor_proposto` DECIMAL(12,2) NOT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_negociacao_rodada`),
  CONSTRAINT `fk_negoc_proposta` FOREIGN KEY (`proposta_id`) REFERENCES `propostas` (`id_proposta`) ON DELETE CASCADE,
  CONSTRAINT `fk_negoc_autor` FOREIGN KEY (`autor_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- 15. Tabela: metas
-- -----------------------------------------------------
CREATE TABLE `metas` (
  `id_meta` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` BIGINT UNSIGNED DEFAULT NULL,
  `lar_id` BIGINT UNSIGNED DEFAULT NULL,
  `titulo` VARCHAR(255) NOT NULL,
  `emoji` VARCHAR(50) DEFAULT NULL,
  `categoria` ENUM('produto', 'viagem', 'poupanca', 'reserva', 'curso') NOT NULL,
  `valor_alvo` DECIMAL(12,2) NOT NULL,
  `valor_atual` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `prazo` DATE DEFAULT NULL,
  `compartilhada` BOOLEAN NOT NULL DEFAULT FALSE,
  `conta_guardando` VARCHAR(255) DEFAULT NULL,
  `pix_destino` VARCHAR(255) DEFAULT NULL COMMENT 'usado so em meta compartilhada do Lar',
  `responsavel_usuario_id` BIGINT UNSIGNED DEFAULT NULL COMMENT 'membro responsavel pela conta',
  `contribuicao_mensal` DECIMAL(12,2) DEFAULT 0.00,
  `imagem` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_meta`),
  CONSTRAINT `fk_meta_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE,
  CONSTRAINT `fk_meta_lar` FOREIGN KEY (`lar_id`) REFERENCES `lares` (`id_lar`) ON DELETE CASCADE,
  CONSTRAINT `fk_meta_responsavel` FOREIGN KEY (`responsavel_usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL,
  CONSTRAINT `chk_meta_owner` CHECK (usuario_id IS NOT NULL OR lar_id IS NOT NULL)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- 16. Tabelas: projetos e projeto_itens (RF008)
-- -----------------------------------------------------
CREATE TABLE `projetos` (
  `id_projeto` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` BIGINT UNSIGNED DEFAULT NULL,
  `lar_id` BIGINT UNSIGNED DEFAULT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `descricao` TEXT,
  `orcamento_estimado` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `gasto_atual` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `status` ENUM('planejado', 'em_andamento', 'concluido') NOT NULL DEFAULT 'planejado',
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_projeto`),
  CONSTRAINT `fk_projeto_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE,
  CONSTRAINT `fk_projeto_lar` FOREIGN KEY (`lar_id`) REFERENCES `lares` (`id_lar`) ON DELETE CASCADE,
  CONSTRAINT `chk_projeto_owner` CHECK (usuario_id IS NOT NULL OR lar_id IS NOT NULL)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `projeto_itens` (
  `id_projeto_item` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `projeto_id` BIGINT UNSIGNED NOT NULL,
  `categoria_id` BIGINT UNSIGNED DEFAULT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `valor_estimado` DECIMAL(12,2) DEFAULT 0.00,
  `valor_real` DECIMAL(12,2) DEFAULT 0.00,
  `adquirido` BOOLEAN NOT NULL DEFAULT FALSE,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_projeto_item`),
  CONSTRAINT `fk_pitem_projeto` FOREIGN KEY (`projeto_id`) REFERENCES `projetos` (`id_projeto`) ON DELETE CASCADE,
  CONSTRAINT `fk_pitem_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id_categoria`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- 17. Tabela: notificacoes
-- -----------------------------------------------------
CREATE TABLE `notificacoes` (
  `id_notificacao` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` BIGINT UNSIGNED NOT NULL,
  `lar_id` BIGINT UNSIGNED DEFAULT NULL,
  `texto` VARCHAR(255) NOT NULL,
  `tipo` ENUM('sucesso', 'atencao', 'lar', 'info') NOT NULL DEFAULT 'info',
  `lida` BOOLEAN NOT NULL DEFAULT FALSE,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_notificacao`),
  CONSTRAINT `fk_notif_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE,
  CONSTRAINT `fk_notif_lar` FOREIGN KEY (`lar_id`) REFERENCES `lares` (`id_lar`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- 18. Tabela: cobrancas (RF005 - Cobrador Diplomata)
-- -----------------------------------------------------
CREATE TABLE `cobrancas` (
  `id_cobranca` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lar_id` BIGINT UNSIGNED NOT NULL,
  `criada_por` BIGINT UNSIGNED NOT NULL,
  `destinatario_id` BIGINT UNSIGNED NOT NULL,
  `titulo` VARCHAR(255) NOT NULL,
  `valor` DECIMAL(12,2) NOT NULL,
  `vencimento` DATE NOT NULL,
  `mensagem` TEXT,
  `estado` ENUM('pendente', 'enviada', 'agendada') NOT NULL DEFAULT 'pendente',
  `canal` ENUM('app', 'email', 'whatsapp') NOT NULL DEFAULT 'app',
  `antecedencia` ENUM('1_dia', '2_dias', '3_dias', '1_semana') DEFAULT '2_dias',
  `enviada_em` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cobranca`),
  CONSTRAINT `fk_cobranca_lar` FOREIGN KEY (`lar_id`) REFERENCES `lares` (`id_lar`) ON DELETE CASCADE,
  CONSTRAINT `fk_cobranca_autor` FOREIGN KEY (`criada_por`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE,
  CONSTRAINT `fk_cobranca_destinatario` FOREIGN KEY (`destinatario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- 19. Tabela: produtos_watchlist
-- -----------------------------------------------------
CREATE TABLE `produtos_watchlist` (
  `id_produto_watchlist` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `usuario_id` BIGINT UNSIGNED NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `emoji` VARCHAR(50) DEFAULT NULL,
  `preco` DECIMAL(12,2) DEFAULT 0.00,
  `loja` VARCHAR(255) DEFAULT NULL,
  `imagem` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_produto_watchlist`),
  CONSTRAINT `fk_watchlist_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
