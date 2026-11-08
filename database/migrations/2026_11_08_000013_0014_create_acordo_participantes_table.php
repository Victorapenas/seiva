<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('acordo_participantes', function (Blueprint $table) {
            $table->id('id_participacao');
            $table->unsignedBigInteger('acordo_id');
            $table->unsignedBigInteger('usuario_id');
            $table->decimal('contribuicao_mensal', 12, 2)->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('acordo_id')->references('id_acordo')->on('acordos')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id_usuario')->on('usuarios')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('acordo_participantes'); }
};