<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('produtos_watchlist', function (Blueprint $table) {
            $table->id('id_produto');
            $table->unsignedBigInteger('usuario_id');
            $table->string('nome');
            $table->string('emoji', 50)->nullable();
            $table->string('link_referencia', 1000)->nullable();
            $table->decimal('preco_alvo', 12, 2)->nullable();
            $table->string('loja')->nullable();
            $table->string('imagem')->nullable();
            $table->timestamps();
            $table->foreign('usuario_id')->references('id_usuario')->on('usuarios')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('produtos_watchlist'); }
};