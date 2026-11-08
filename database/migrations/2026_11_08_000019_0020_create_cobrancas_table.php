<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('cobrancas', function (Blueprint $table) {
            $table->id('id_cobranca');
            $table->unsignedBigInteger('lar_id');
            $table->unsignedBigInteger('criada_por');
            $table->unsignedBigInteger('destinatario_id');
            $table->string('titulo');
            $table->decimal('valor', 12, 2);
            $table->date('data_vencimento')->nullable();
            $table->text('mensagem')->nullable();
            $table->enum('estado', ['pendente','enviada','agendada','confirmada'])->default('pendente');
            $table->string('quando')->nullable();
            $table->timestamps();
            $table->foreign('lar_id')->references('id_lar')->on('lares')->onDelete('cascade');
            $table->foreign('criada_por')->references('id_usuario')->on('usuarios');
            $table->foreign('destinatario_id')->references('id_usuario')->on('usuarios');
        });
    }
    public function down(): void { Schema::dropIfExists('cobrancas'); }
};