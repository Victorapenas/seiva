<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('acordos', function (Blueprint $table) {
            $table->id('id_acordo');
            $table->unsignedBigInteger('lar_id');
            $table->unsignedBigInteger('criado_por');
            $table->enum('tipo', ['meta','divida']);
            $table->string('titulo');
            $table->string('imagem')->nullable();
            $table->decimal('valor_total', 12, 2);
            $table->decimal('valor_arrecadado', 12, 2)->default(0);
            $table->string('divisao', 20)->default('50/50');
            $table->decimal('valor_mensal', 12, 2)->default(0);
            $table->string('conta_destino')->nullable();
            $table->string('vencimento_descricao')->nullable();
            $table->integer('parcelas_total')->nullable();
            $table->integer('parcelas_pagas')->nullable();
            $table->enum('status', ['ativo','em_negociacao','concluido','cancelado'])->default('ativo');
            $table->timestamps();
            $table->foreign('lar_id')->references('id_lar')->on('lares')->onDelete('cascade');
            $table->foreign('criado_por')->references('id_usuario')->on('usuarios');
        });
    }
    public function down(): void { Schema::dropIfExists('acordos'); }
};