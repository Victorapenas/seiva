<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('lar_membros', function (Blueprint $table) {
            $table->id('id_lar_membro');
            $table->unsignedBigInteger('lar_id');
            $table->unsignedBigInteger('usuario_id');
            $table->enum('papel', ['administrador','membro'])->default('membro');
            $table->decimal('renda_declarada', 10, 2)->default(0);
            $table->decimal('percentual_contribuicao', 5, 2)->default(0);
            $table->timestamp('aceito_em')->nullable();
            $table->timestamps();
            $table->unique(['lar_id','usuario_id']);
            $table->foreign('lar_id')->references('id_lar')->on('lares')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id_usuario')->on('usuarios')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('lar_membros'); }
};