<?php

namespace App\Dominio;

use Illuminate\Support\Facades\DB;
use PDO;

/**
 * Classe: ConexaoBanco
 * Responsabilidade: Gerenciamento orientado a objetos da conexão com o banco de dados SQLite.
 * Padrão: Singleton / Abstração de Conexão.
 * Disciplina: Projeto Interdisciplinar de ADS - IFBA.
 */
class ConexaoBanco
{
    /** @var PDO|null Instância única da conexão PDO */
    private static ?PDO $instancia = null;

    /**
     * Construtor privado para impedir instanciação direta fora do padrão Singleton.
     */
    private function __construct() {}

    /**
     * Obtém a instância ativa da conexão PDO configurada no Laravel.
     * 
     * @return PDO
     */
    public static function obterConexao(): PDO
    {
        if (self::$instancia === null) {
            self::$instancia = DB::connection()->getPdo();
        }

        return self::$instancia;
    }

    /**
     * Executa uma consulta preparada com parâmetros vinculados (Prepared Statements).
     * 
     * @param string $sql Comando SQL a ser executado
     * @param array $parametros Parâmetros para binding seguro
     * @return array
     */
    public static function consultar(string $sql, array $parametros = []): array
    {
        $conexao = self::obterConexao();
        $stmt = $conexao->prepare($sql);
        $stmt->execute($parametros);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
