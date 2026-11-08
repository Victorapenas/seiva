<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('propostas', function (Blueprint $table) {
            $table->id('id_proposta');
            $table->unsignedBigInteger('lar_id');
            $table->unsignedBigInteger('autor_id');
            $table->enum('tipo', ['meta','divida']);
            $table->string('titulo');
            $table->text('descricao')->nullable();
            $table->string('imagem')->nullable();
            $table->string('link')->nullable();
            $table->decimal('valor_total', 12, 2);
            $table->string('divisao', 20)->default('50/50');
            $table->decimal('valor_mes_por_pessoa', 12, 2)->default(0);
            $table->integer('parcelas_total')->nullable();
            $table->integer('prazo_meses')->nullable();
            $table->text('mensagem')->nullable();
            $table->enum('status', ['pendente','aceita','recusada','contraproposta'])->default('pendente');
            $table->timestamps();
            $table->foreign('lar_id')->references('id_lar')->on('lares')->onDelete('cascade');
            $table->foreign('autor_id')->references('id_usuario')->on('usuarios');
        });
    }
    public function down(): void { Schema::dropIfExists('propostas'); }
};