<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('consignees')) {
            return;
        }

        Schema::table('consignees', function (Blueprint $table) {
            if (!Schema::hasColumn('consignees', 'industry')) {
                $table->string('industry')->nullable()->after('user_id');
            }

            if (!Schema::hasColumn('consignees', 'city')) {
                $table->string('city')->nullable()->after('consignee_name');
            }
        });
    }

    public function down(): void
    {
        Schema::table('consignees', function (Blueprint $table) {
            if (Schema::hasColumn('consignees', 'industry')) {
                $table->dropColumn('industry');
            }

            if (Schema::hasColumn('consignees', 'city')) {
                $table->dropColumn('city');
            }
        });
    }
};
