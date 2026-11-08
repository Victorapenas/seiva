<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('despesas_lares', function (Blueprint $table) {
            $table->id('id_despesa_lar');
            $table->unsignedBigInteger('lar_id');
            $table->unsignedBigInteger('registrada_por');
            $table->unsignedBigInteger('regra_divisao_id')->nullable();
            $table->string('titulo');
            $table->string('emoji', 50)->nullable();
            $table->decimal('valor_total', 12, 2);
            $table->date('data_vencimento')->nullable();
            $table->enum('tipo', ['fixa','variavel','emergencia'])->default('fixa');
            $table->enum('status', ['pendente','pago','parcial'])->default('pendente');
            $table->string('divisao', 20)->default('50/50');
            $table->boolean('comprovante')->default(false);
            $table->timestamps();
            $table->foreign('lar_id')->references('id_lar')->on('lares')->onDelete('cascade');
            $table->foreign('registrada_por')->references('id_usuario')->on('usuarios');
            $table->foreign('regra_divisao_id')->references('id_regra_divisao')->on('regras_divisao')->onDelete('set null');
        });
    }
    public function down(): void { Schema::dropIfExists('despesas_lares'); }
};