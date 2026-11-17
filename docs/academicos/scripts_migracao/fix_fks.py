import re

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

for tname, nid in mapping.items():
    pattern = rf"REFERENCES `{tname}` \(`id`\)"
    content = re.sub(pattern, rf"REFERENCES `{tname}` (`{nid}`)", content)

with open(path, 'w', encoding='utf-8') as f:
    f.write(content)

print("FKs fixed!")
