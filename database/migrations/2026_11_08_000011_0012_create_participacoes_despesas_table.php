<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('participacoes_despesas', function (Blueprint $table) {
            $table->id('id_participacao');
            $table->unsignedBigInteger('despesa_lar_id');
            $table->unsignedBigInteger('usuario_id');
            $table->decimal('valor_parte', 12, 2);
            $table->boolean('pago')->default(false);
            $table->unsignedBigInteger('transacao_quitacao_id')->nullable();
            $table->timestamps();
            $table->foreign('despesa_lar_id')->references('id_despesa_lar')->on('despesas_lares')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('transacao_quitacao_id')->references('id_transacao')->on('transacoes')->onDelete('set null');
        });
    }
    public function down(): void { Schema::dropIfExists('participacoes_despesas'); }
};