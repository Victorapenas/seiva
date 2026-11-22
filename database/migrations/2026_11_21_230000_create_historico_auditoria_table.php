<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('historico_auditoria', function (Blueprint $table) {
            $table->id('id_auditoria');
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->unsignedBigInteger('lar_id')->nullable();
            $table->string('entidade_tipo', 50); // conta, transacao, despesa_lar, meta, acordo
            $table->unsignedBigInteger('entidade_id')->nullable();
            $table->string('acao', 50); // criado, editado, estornado, arquivado, reajustado, cancelado
            $table->string('descricao', 500);
            $table->json('dados_anteriores')->nullable();
            $table->json('dados_novos')->nullable();
            $table->timestamps();

            $table->foreign('usuario_id')->references('id_usuario')->on('usuarios')->onDelete('set null');
            $table->foreign('lar_id')->references('id_lar')->on('lares')->onDelete('set null');
            $table->index(['entidade_tipo', 'entidade_id']);
            $table->index('created_at');
        });

        // Adiciona coluna 'ativa' na tabela de contas para permitir arquivamento seguro
        if (Schema::hasTable('contas') && !Schema::hasColumn('contas', 'ativa')) {
            Schema::table('contas', function (Blueprint $table) {
                $table->boolean('ativa')->default(true)->after('cor');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('historico_auditoria');
        if (Schema::hasTable('contas') && Schema::hasColumn('contas', 'ativa')) {
            Schema::table('contas', function (Blueprint $table) {
                $table->dropColumn('ativa');
            });
        }
    }
};
