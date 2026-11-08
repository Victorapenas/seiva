<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('convites_lar', function (Blueprint $table) {
            $table->id('id_convite_lar');
            $table->unsignedBigInteger('lar_id');
            $table->unsignedBigInteger('convidado_por');
            $table->string('email_convidado')->nullable();
            $table->string('token_convite', 100)->unique();
            $table->enum('status', ['pendente','aceito','expirado'])->default('pendente');
            $table->timestamp('expira_em');
            $table->timestamps();
            $table->foreign('lar_id')->references('id_lar')->on('lares')->onDelete('cascade');
            $table->foreign('convidado_por')->references('id_usuario')->on('usuarios');
        });
    }
    public function down(): void { Schema::dropIfExists('convites_lar'); }
};