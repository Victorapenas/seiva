<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('contas', function (Blueprint $table) {
            $table->id('id_conta');
            $table->unsignedBigInteger('usuario_id');
            $table->string('nome');
            $table->enum('tipo', ['corrente','poupanca','cartao','carteira']);
            $table->decimal('saldo', 12, 2)->default(0);
            $table->decimal('comprometido', 12, 2)->default(0);
            $table->enum('funcao', ['gasto','reserva','carteira'])->nullable();
            $table->string('objetivo')->nullable();
            $table->string('cor', 20)->default('#000000');
            $table->string('chave_pix')->nullable();
            $table->decimal('limite', 12, 2)->nullable();
            $table->decimal('usado', 12, 2)->nullable();
            $table->integer('vencimento_fatura')->nullable();
            $table->timestamps();
            $table->foreign('usuario_id')->references('id_usuario')->on('usuarios')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('contas'); }
};