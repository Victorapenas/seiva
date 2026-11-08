<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('metas', function (Blueprint $table) {
            $table->id('id_meta');
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->unsignedBigInteger('lar_id')->nullable();
            $table->unsignedBigInteger('responsavel_id')->nullable();
            $table->string('titulo');
            $table->string('emoji', 50)->nullable();
            $table->enum('categoria', ['produto','viagem','poupanca','reserva','curso'])->default('poupanca');
            $table->decimal('valor_alvo', 12, 2);
            $table->decimal('valor_atual', 12, 2)->default(0);
            $table->decimal('contribuicao_mensal', 12, 2)->default(0);
            $table->date('data_limite')->nullable();
            $table->string('onde_guardado')->nullable();
            $table->string('conta_destino')->nullable();
            $table->string('pix_destino')->nullable();
            $table->string('imagem')->nullable();
            $table->enum('status', ['ativa','concluida','pausada','cancelada'])->default('ativa');
            $table->timestamps();
            $table->foreign('usuario_id')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('lar_id')->references('id_lar')->on('lares')->onDelete('set null');
            $table->foreign('responsavel_id')->references('id_usuario')->on('usuarios')->onDelete('set null');
        });
    }
    public function down(): void { Schema::dropIfExists('metas'); }
};