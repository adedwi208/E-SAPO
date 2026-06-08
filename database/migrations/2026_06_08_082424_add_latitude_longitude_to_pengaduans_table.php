<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            if (!Schema::hasColumn('pengaduans', 'latitude')) {
                $table->decimal('latitude', 10, 7)->nullable()->after('desa_id');
            }

            if (!Schema::hasColumn('pengaduans', 'longitude')) {
                $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pengaduans', function (Blueprint $table) {
            if (Schema::hasColumn('pengaduans', 'latitude')) {
                $table->dropColumn('latitude');
            }

            if (Schema::hasColumn('pengaduans', 'longitude')) {
                $table->dropColumn('longitude');
            }
        });
    }
};