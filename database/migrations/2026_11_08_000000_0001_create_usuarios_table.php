<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('telefone', 20)->nullable();
            $table->string('senha_hash');
            $table->enum('tipo_renda', ['clt','pj','autonomo','outro'])->default('clt');
            $table->decimal('renda_mensal', 10, 2)->default(0);
            $table->integer('dia_recebimento')->nullable();
            $table->boolean('tem_renda_extra')->default(false);
            $table->decimal('renda_extra', 10, 2)->default(0);
            $table->string('banco_principal', 100)->nullable();
            $table->string('avatar')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('usuarios'); }
};