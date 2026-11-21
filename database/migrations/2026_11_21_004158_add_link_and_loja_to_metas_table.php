<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('metas', function (Blueprint $table) {
            $table->string('link_referencia', 1000)->nullable()->after('imagem');
            $table->string('loja', 100)->nullable()->after('link_referencia');
            $table->boolean('monitorar_promocao')->default(true)->after('loja');
        });
    }

    public function down(): void
    {
        Schema::table('metas', function (Blueprint $table) {
            $table->dropColumn(['link_referencia', 'loja', 'monitorar_promocao']);
        });
    }
};
