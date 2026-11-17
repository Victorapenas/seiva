<?php

namespace Tests\Feature;

use App\Dominio\ConexaoBanco;
use App\Dominio\ProcessarCadastro;
use App\Dominio\Autenticacao;
use App\Dominio\Casal;
use App\Dominio\GerenciarUsuarios;
use App\Models\Lar;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Teste: DominioPooTest
 * Valida o funcionamento das classes de domínio POO com nomenclaturas em Português:
 * ConexaoBanco, ProcessarCadastro, Autenticacao, Casal e GerenciarUsuarios.
 */
class DominioPooTest extends TestCase
{
    use RefreshDatabase;

    public function test_conexao_banco_singleton_executa_consulta_com_sucesso(): void
    {
        $conexao = ConexaoBanco::obterConexao();
        $this->assertInstanceOf(\PDO::class, $conexao);

        $resultado = ConexaoBanco::consultar("SELECT 1 as teste");
        $this->assertNotEmpty($resultado);
        $this->assertEquals(1, $resultado[0]['teste']);
    }

    public function test_processar_cadastro_e_autenticacao_com_poo(): void
    {
        $processador = new ProcessarCadastro();

        $dados = [
            'nome' => 'Juliana Costa',
            'email' => 'juliana@teste.com',
            'senha' => 'senhaSegura123',
            'renda_mensal' => 5000.00,
            'pin_caixa_preta' => '9876',
        ];

        $usuario = $processador->registrar($dados);
        $this->assertInstanceOf(Usuario::class, $usuario);
        $this->assertEquals('Juliana Costa', $usuario->nome);

        // Autentica via classe POO Autenticacao
        $auth = new Autenticacao();
        $usuarioLogado = $auth->autenticar('juliana@teste.com', 'senhaSegura123');
        $this->assertEquals($usuario->id_usuario, $usuarioLogado->id_usuario);

        // Valida PIN da Caixa Preta via GerenciarUsuarios
        $gestor = new GerenciarUsuarios($usuario);
        $this->assertTrue($gestor->validarPinCaixaPreta('9876'));
        $this->assertFalse($gestor->validarPinCaixaPreta('0000'));

        // Valida exportação de dados para LGPD
        $dadosLGPD = $gestor->exportarDadosLGPD();
        $this->assertArrayHasKey('titular', $dadosLGPD);
        $this->assertEquals('Juliana Costa', $dadosLGPD['titular']['nome']);
    }

    public function test_casal_calcula_rateio_proporcional_justo(): void
    {
        $u1 = Usuario::create([
            'nome' => 'Carlos Silva',
            'email' => 'carlos@lar.com',
            'senha_hash' => bcrypt('123456'),
            'renda_mensal' => 6000.00,
        ]);

        $u2 = Usuario::create([
            'nome' => 'Mariana Dias',
            'email' => 'mariana@lar.com',
            'senha_hash' => bcrypt('123456'),
            'renda_mensal' => 4000.00,
        ]);

        $lar = Lar::create([
            'nome' => 'Nosso Ninho',
            'emoji' => '🏡',
            'criado_por' => $u1->id_usuario,
        ]);

        $gestorCasal = new Casal($lar);
        $gestorCasal->adicionarMembro($u1, 'administrador');
        $gestorCasal->adicionarMembro($u2, 'membro');

        $rateio = $gestorCasal->calcularRateioProporcional();
        $this->assertCount(2, $rateio);

        // Carlos ganha 6k de 10k (60%) e Mariana ganha 4k de 10k (40%)
        $carlosRateio = $rateio->firstWhere('nome', 'Carlos Silva');
        $marianaRateio = $rateio->firstWhere('nome', 'Mariana Dias');

        $this->assertEquals(60.0, $carlosRateio['percentual_calculado']);
        $this->assertEquals(40.0, $marianaRateio['percentual_calculado']);
    }
}
