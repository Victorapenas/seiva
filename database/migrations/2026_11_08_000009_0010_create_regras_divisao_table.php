<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('regras_divisao', function (Blueprint $table) {
            $table->id('id_regra_divisao');
            $table->unsignedBigInteger('lar_id');
            $table->enum('tipo', ['igualitaria','proporcional','customizada'])->default('igualitaria');
            $table->boolean('ativa')->default(true);
            $table->timestamps();
            $table->foreign('lar_id')->references('id_lar')->on('lares')->onDelete('cascade');
        });

        Schema::create('regras_divisao_detalhes', function (Blueprint $table) {
            $table->id('id_detalhe');
            $table->unsignedBigInteger('regra_id');
            $table->unsignedBigInteger('usuario_id');
            $table->decimal('percentual', 5, 2);
            $table->timestamps();
            $table->foreign('regra_id')->references('id_regra_divisao')->on('regras_divisao')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id_usuario')->on('usuarios')->onDelete('cascade');
        });
    }
    public function down(): void {
        Schema::dropIfExists('regras_divisao_detalhes');
        Schema::dropIfExists('regras_divisao');
    }
};