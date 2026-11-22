<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Transacao;
use App\Models\DespesaLar;
use App\Models\Meta;

class AtualizarCategoriasIconesSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Cadastrar / Atualizar Categorias Oficiais com ícones Lucide
        $categorias = [
            'Beleza' => ['emoji' => 'sparkles', 'cor' => '#ec4899'],
            'Saúde' => ['emoji' => 'activity', 'cor' => '#ef4444'],
            'Alimentação' => ['emoji' => 'utensils', 'cor' => '#10b981'],
            'Moradia' => ['emoji' => 'home', 'cor' => '#3b82f6'],
            'Transporte' => ['emoji' => 'car', 'cor' => '#f59e0b'],
            'Lazer' => ['emoji' => 'clapperboard', 'cor' => '#8b5cf6'],
            'Mercado' => ['emoji' => 'shopping-cart', 'cor' => '#059669'],
            'Presente' => ['emoji' => 'gift', 'cor' => '#f43f5e'],
            'Trabalho & Freela' => ['emoji' => 'briefcase', 'cor' => '#6366f1'],
            'Outros' => ['emoji' => 'credit-card', 'cor' => '#64748b'],
        ];

        $mapCat = [];
        foreach ($categorias as $nome => $meta) {
            $cat = Categoria::firstOrCreate(
                ['nome' => $nome],
                ['emoji' => $meta['emoji'], 'cor' => $meta['cor'], 'sistema' => true]
            );
            $cat->update(['emoji' => $meta['emoji'], 'cor' => $meta['cor']]);
            $mapCat[$nome] = $cat;
        }

        // 2. Atualizar transações existentes no banco
        $todasTransacoes = Transacao::all();
        foreach ($todasTransacoes as $t) {
            $tLower = mb_strtolower($t->titulo);

            if (str_contains($tLower, 'sephora') || str_contains($tLower, 'maquiagem')) {
                $t->categoria_id = $mapCat['Beleza']->id_categoria;
                $t->emoji = 'sparkles';
            } elseif (str_contains($tLower, 'academia') || str_contains($tLower, 'bio ritmo') || str_contains($tLower, 'smart fit') || str_contains($tLower, 'farmácia')) {
                $t->categoria_id = $mapCat['Saúde']->id_categoria;
                $t->emoji = 'activity';
            } elseif (str_contains($tLower, 'rappi') || str_contains($tLower, 'ifood') || str_contains($tLower, 'restaurante') || str_contains($tLower, 'almoço') || str_contains($tLower, 'lanche')) {
                $t->categoria_id = $mapCat['Alimentação']->id_categoria;
                $t->emoji = 'utensils';
            } elseif (str_contains($tLower, 'mercado') || str_contains($tLower, 'supermercado')) {
                $t->categoria_id = $mapCat['Mercado']->id_categoria;
                $t->emoji = 'shopping-cart';
            } elseif (str_contains($tLower, 'uber') || str_contains($tLower, 'gasolina') || str_contains($tLower, 'transporte')) {
                $t->categoria_id = $mapCat['Transporte']->id_categoria;
                $t->emoji = 'car';
            } elseif (str_contains($tLower, 'fatura') || str_contains($tLower, 'aluguel') || str_contains($tLower, 'condomínio') || str_contains($tLower, 'luz') || str_contains($tLower, 'internet')) {
                $t->categoria_id = $mapCat['Moradia']->id_categoria;
                $t->emoji = str_contains($tLower, 'fatura') ? 'credit-card' : 'home';
            } elseif (str_contains($tLower, 'honorários') || str_contains($tLower, 'freela') || str_contains($tLower, 'salário')) {
                $t->categoria_id = $mapCat['Trabalho & Freela']->id_categoria;
                $t->emoji = 'briefcase';
            } else {
                if (!$t->categoria_id) {
                    $t->categoria_id = $mapCat['Outros']->id_categoria;
                }
                if (!$t->emoji || preg_match('/[\x{1F300}-\x{1F9FF}]/u', $t->emoji)) {
                    $t->emoji = $t->tipo === 'entrada' ? 'trending-up' : 'credit-card';
                }
            }

            // Garante que não haja emojis unicode
            if (preg_match('/[\x{1F300}-\x{1F9FF}]/u', $t->emoji)) {
                $t->emoji = 'credit-card';
            }

            $t->save();
        }

        // 3. Remover 'snowflake' de Despesas do Lar
        $despesas = DespesaLar::all();
        foreach ($despesas as $d) {
            $tLower = mb_strtolower($d->titulo);
            if (str_contains($tLower, 'internet') || str_contains($tLower, 'fibra') || str_contains($tLower, 'wifi')) {
                $d->emoji = 'wifi';
            } elseif (str_contains($tLower, 'aluguel') || str_contains($tLower, 'condomínio')) {
                $d->emoji = 'home';
            } elseif (str_contains($tLower, 'luz') || str_contains($tLower, 'energia')) {
                $d->emoji = 'zap';
            } elseif (str_contains($tLower, 'água')) {
                $d->emoji = 'droplet';
            } elseif ($d->emoji === 'snowflake') {
                $d->emoji = 'home';
            }
            $d->save();
        }

        // 4. Remover 'snowflake' de Metas
        Meta::where('emoji', 'snowflake')->update(['emoji' => 'shopping-cart']);
    }
}
