<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('sessao_tokens', function (Blueprint $table) {
            $table->id('id_sessao_token');
            $table->unsignedBigInteger('usuario_id');
            $table->string('token')->unique();
            $table->timestamp('expira_em');
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('usuario_id')->references('id_usuario')->on('usuarios')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('sessao_tokens'); }
};