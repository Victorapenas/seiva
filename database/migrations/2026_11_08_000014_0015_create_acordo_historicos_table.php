<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('acordo_historicos', function (Blueprint $table) {
            $table->id('id_historico');
            $table->unsignedBigInteger('acordo_id');
            $table->string('acao');
            $table->json('detalhes_antigos')->nullable();
            $table->json('detalhes_novos')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->foreign('acordo_id')->references('id_acordo')->on('acordos')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('acordo_historicos'); }
};