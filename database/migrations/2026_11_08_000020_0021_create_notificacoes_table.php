<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('notificacoes', function (Blueprint $table) {
            $table->id('id_notificacao');
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('lar_id')->nullable();
            $table->string('titulo');
            $table->text('mensagem')->nullable();
            $table->enum('tipo', ['sucesso','atencao','lar','info'])->default('info');
            $table->boolean('lida')->default(false);
            $table->string('tempo')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('usuario_id')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('lar_id')->references('id_lar')->on('lares')->onDelete('set null');
        });
    }
    public function down(): void { Schema::dropIfExists('notificacoes'); }
};