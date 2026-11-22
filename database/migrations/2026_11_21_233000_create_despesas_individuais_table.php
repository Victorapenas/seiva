<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('despesas_individuais', function (Blueprint $table) {
            $table->id('id_despesa_individual');
            $table->unsignedBigInteger('usuario_id');
            $table->string('titulo');
            $table->decimal('valor', 12, 2);
            $table->integer('dia_vencimento')->default(10);
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->string('icone', 50)->default('receipt');
            $table->string('status', 20)->default('pendente'); // pendente, pago
            $table->date('pago_em')->nullable();
            $table->boolean('recorrente')->default(true);
            $table->string('detalhe')->nullable();
            $table->timestamps();

            $table->foreign('usuario_id')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id_categoria')->on('categorias')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('despesas_individuais');
    }
};
