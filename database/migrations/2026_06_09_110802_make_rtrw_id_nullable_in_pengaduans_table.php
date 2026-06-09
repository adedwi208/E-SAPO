<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            // Mengubah kolom rtrw_id agar boleh bernilai null
            $table->foreignId('rtrw_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            $table->foreignId('rtrw_id')->nullable(false)->change();
        });
    }
};