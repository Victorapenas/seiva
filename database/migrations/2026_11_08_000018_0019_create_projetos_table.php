<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('projetos', function (Blueprint $table) {
            $table->id('id_projeto');
            $table->unsignedBigInteger('usuario_id')->nullable();
            $table->unsignedBigInteger('lar_id')->nullable();
            $table->string('titulo');
            $table->decimal('orcamento_total', 12, 2)->default(0);
            $table->enum('status', ['planejamento','em_andamento','concluido','cancelado'])->default('planejamento');
            $table->timestamps();
            $table->foreign('usuario_id')->references('id_usuario')->on('usuarios')->onDelete('cascade');
            $table->foreign('lar_id')->references('id_lar')->on('lares')->onDelete('set null');
        });

        Schema::create('projeto_itens', function (Blueprint $table) {
            $table->id('id_item');
            $table->unsignedBigInteger('projeto_id');
            $table->unsignedBigInteger('categoria_id')->nullable();
            $table->string('descricao');
            $table->decimal('custo_estimado', 12, 2)->default(0);
            $table->decimal('custo_real', 12, 2)->nullable();
            $table->boolean('comprado')->default(false);
            $table->timestamps();
            $table->foreign('projeto_id')->references('id_projeto')->on('projetos')->onDelete('cascade');
            $table->foreign('categoria_id')->references('id_categoria')->on('categorias')->onDelete('set null');
        });
    }
    public function down(): void {
        Schema::dropIfExists('projeto_itens');
        Schema::dropIfExists('projetos');
    }
};