<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('transacoes', function (Blueprint $table) {
            $table->id('id_transacao');
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('conta_id');
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->unsignedBigInteger('lar_id')->nullable();
            $table->string('titulo');
            $table->string('emoji', 50)->nullable();
            $table->decimal('valor', 12, 2);
            $table->enum('tipo', ['entrada','saida']);
            $table->date('data');
            $table->enum('visibilidade', ['pessoal','privado','compartilhado','lar'])->default('pessoal');
            $table->timestamps();
            $table->index('data');
            $table->foreign('usuario_id')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('conta_id')->references('id_conta')->on('contas')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id_categoria')->on('categorias')->onDelete('set null');
            $table->foreign('lar_id')->references('id_lar')->on('lares')->onDelete('set null');
        });
    }
    public function down(): void { Schema::dropIfExists('transacoes'); }
};