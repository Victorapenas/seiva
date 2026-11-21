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
            ['nome' => 'Alimentação & Mercado', 'emoji' => 'shopping-cart', 'cor' => '#10b981', 'sistema' => true],
            ['nome' => 'Moradia & Contas', 'emoji' => 'home', 'cor' => '#3b82f6', 'sistema' => true],
            ['nome' => 'Transporte & Combustível', 'emoji' => 'car', 'cor' => '#f59e0b', 'sistema' => true],
            ['nome' => 'Saúde & Farmácia', 'emoji' => 'pill', 'cor' => '#ef4444', 'sistema' => true],
            ['nome' => 'Lazer & Restaurantes', 'emoji' => 'utensils', 'cor' => '#8b5cf6', 'sistema' => true],
            ['nome' => 'Educação & Cursos', 'emoji' => 'graduation-cap', 'cor' => '#06b6d4', 'sistema' => true],
            ['nome' => 'Trabalho & Freela', 'emoji' => 'briefcase', 'cor' => '#6366f1', 'sistema' => true],
            ['nome' => 'Reserva & Investimentos', 'emoji' => 'shield', 'cor' => '#ec4899', 'sistema' => true],
            ['nome' => 'Outros', 'emoji' => 'sparkles', 'cor' => '#64748b', 'sistema' => true],
        ];

        foreach ($categorias as $cat) {
            Categoria::firstOrCreate(['nome' => $cat['nome']], $cat);
        }
    }
}
