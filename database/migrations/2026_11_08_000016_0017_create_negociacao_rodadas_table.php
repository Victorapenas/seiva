<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('negociacao_rodadas', function (Blueprint $table) {
            $table->id('id_rodada');
            $table->unsignedBigInteger('proposta_id');
            $table->unsignedBigInteger('autor_id');
            $table->text('mensagem')->nullable();
            $table->decimal('contraproposta_valor', 12, 2)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('proposta_id')->references('id_proposta')->on('propostas')->onDelete('cascade');
            $table->foreign('autor_id')->references('id_usuario')->on('usuarios');
        });
    }
    public function down(): void { Schema::dropIfExists('negociacao_rodadas'); }
};