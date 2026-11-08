<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Categorias padrão do sistema (Sem criar nenhum usuário, conforme solicitado)
        $categorias = [
            ['nome' => 'Alimentação & Mercado', 'emoji' => '🛒', 'cor' => '#10b981', 'sistema' => true],
            ['nome' => 'Moradia & Contas', 'emoji' => '🏠', 'cor' => '#3b82f6', 'sistema' => true],
            ['nome' => 'Transporte & Combustível', 'emoji' => '🚗', 'cor' => '#f59e0b', 'sistema' => true],
            ['nome' => 'Saúde & Farmácia', 'emoji' => '💊', 'cor' => '#ef4444', 'sistema' => true],
            ['nome' => 'Lazer & Restaurantes', 'emoji' => '🍔', 'cor' => '#8b5cf6', 'sistema' => true],
            ['nome' => 'Educação & Cursos', 'emoji' => '🎓', 'cor' => '#06b6d4', 'sistema' => true],
            ['nome' => 'Trabalho & Freela', 'emoji' => '💼', 'cor' => '#6366f1', 'sistema' => true],
            ['nome' => 'Reserva & Investimentos', 'emoji' => '🐷', 'cor' => '#ec4899', 'sistema' => true],
            ['nome' => 'Outros', 'emoji' => '✨', 'cor' => '#64748b', 'sistema' => true],
        ];

        foreach ($categorias as $cat) {
            Categoria::firstOrCreate(['nome' => $cat['nome']], $cat);
        }
    }
}
