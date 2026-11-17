import re

def process_sql():
    path = r"C:\seiva-prototipo\docs do sistema\script_sql (1).sql"
    with open(path, 'r', encoding='utf-8') as f:
        content = f.read()

    mapping = {
        'usuarios': 'id_usuario',
        'sessao_tokens': 'id_sessao_token',
        'lares': 'id_lar',
        'lar_membros': 'id_lar_membro',
        'convites_lar': 'id_convite_lar',
        'contas': 'id_conta',
        'categorias': 'id_categoria',
        'transacoes': 'id_transacao',
        'registros_caixa_preta': 'id_registro_caixa_preta',
        'regras_divisao': 'id_regra_divisao',
        'regras_divisao_detalhes': 'id_regra_divisao_detalhe',
        'despesas_lares': 'id_despesa_lar',
        'participacoes_despesas': 'id_participacao_despesa',
        'acordos': 'id_acordo',
        'acordo_participantes': 'id_acordo_participante',
        'acordo_historicos': 'id_acordo_historico',
        'propostas': 'id_proposta',
        'negociacao_rodadas': 'id_negociacao_rodada',
        'metas': 'id_meta',
        'projetos': 'id_projeto',
        'projeto_itens': 'id_projeto_item',
        'notificacoes': 'id_notificacao',
        'cobrancas': 'id_cobranca',
        'produtos_watchlist': 'id_produto_watchlist'
    }

    blocks = re.split(r'(?=CREATE TABLE)', content)
    new_blocks = [blocks[0]]
    for block in blocks[1:]:
        match = re.search(r"CREATE TABLE `([^`]+)`", block)
        if match:
            tname = match.group(1)
            if tname in mapping:
                nid = mapping[tname]
                block = re.sub(r"`id` BIGINT", f"`{nid}` BIGINT", block, count=1)
                block = re.sub(r"PRIMARY KEY \(`id`\)", f"PRIMARY KEY (`{nid}`)", block, count=1)
        new_blocks.append(block)

    with open(path, 'w', encoding='utf-8') as f:
        f.write("".join(new_blocks))

def process_mmd(filename):
    path = rf"C:\seiva-prototipo\docs do sistema\{filename}"
    with open(path, 'r', encoding='utf-8') as f:
        content = f.read()

    mapping = {
        'usuarios': 'id_usuario',
        'sessao_tokens': 'id_sessao_token',
        'lares': 'id_lar',
        'lar_membros': 'id_lar_membro',
        'convites_lar': 'id_convite_lar',
        'contas': 'id_conta',
        'categorias': 'id_categoria',
        'transacoes': 'id_transacao',
        'registros_caixa_preta': 'id_registro_caixa_preta',
        'regras_divisao': 'id_regra_divisao',
        'regras_divisao_detalhes': 'id_regra_divisao_detalhe',
        'despesas_lares': 'id_despesa_lar',
        'participacoes_despesas': 'id_participacao_despesa',
        'acordos': 'id_acordo',
        'acordo_participantes': 'id_acordo_participante',
        'acordo_historicos': 'id_acordo_historico',
        'propostas': 'id_proposta',
        'negociacao_rodadas': 'id_negociacao_rodada',
        'metas': 'id_meta',
        'projetos': 'id_projeto',
        'projeto_itens': 'id_projeto_item',
        'notificacoes': 'id_notificacao',
        'cobrancas': 'id_cobranca',
        'produtos_watchlist': 'id_produto_watchlist'
    }

    for tname, nid in mapping.items():
        pattern = rf"({tname} \{{[^}}]*?)bigint id PK"
        content = re.sub(pattern, rf"\1bigint {nid} PK", content, flags=re.DOTALL|re.IGNORECASE)

    with open(path, 'w', encoding='utf-8') as f:
        f.write(content)


def process_class(filename):
    path = rf"C:\seiva-prototipo\docs do sistema\{filename}"
    with open(path, 'r', encoding='utf-8') as f:
        content = f.read()

    mapping = {
        'Usuario': 'id_usuario',
        'SessaoToken': 'id_sessao_token',
        'Lar': 'id_lar',
        'LarMembro': 'id_lar_membro',
        'ConviteLar': 'id_convite_lar',
        'Conta': 'id_conta',
        'Categoria': 'id_categoria',
        'Transacao': 'id_transacao',
        'RegistroCaixaPreta': 'id_registro_caixa_preta',
        'RegraDivisao': 'id_regra_divisao',
        'RegraDivisaoDetalhe': 'id_regra_divisao_detalhe',
        'DespesaLar': 'id_despesa_lar',
        'ParticipacaoDespesa': 'id_participacao_despesa',
        'Acordo': 'id_acordo',
        'AcordoParticipante': 'id_acordo_participante',
        'AcordoHistorico': 'id_acordo_historico',
        'Proposta': 'id_proposta',
        'NegociacaoRodada': 'id_negociacao_rodada',
        'Meta': 'id_meta',
        'Projeto': 'id_projeto',
        'ProjetoItem': 'id_projeto_item',
        'Notificacao': 'id_notificacao',
        'Cobranca': 'id_cobranca',
        'ProdutoWatchlist': 'id_produto_watchlist'
    }

    for tname, nid in mapping.items():
        pattern = rf"(class {tname} \{{[^}}]*?)-Long id\b"
        content = re.sub(pattern, rf"\1-Long {nid}", content, flags=re.DOTALL)
        
        pattern_plus = rf"(class {tname} \{{[^}}]*?)\+Long id\b"
        content = re.sub(pattern_plus, rf"\1+Long {nid}", content, flags=re.DOTALL)

    with open(path, 'w', encoding='utf-8') as f:
        f.write(content)


process_sql()
process_mmd("modelo_fisico_er (1).mmd")
process_class("diagrama_classes (1).mmd")
print("Tudo atualizado!")
