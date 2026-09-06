<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('shipping_instructions') && !Schema::hasColumn('shipping_instructions', 'upload_file_si')) {
            Schema::table('shipping_instructions', function (Blueprint $table) {
                $table->string('upload_file_si')->nullable()->after('status');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('shipping_instructions') && Schema::hasColumn('shipping_instructions', 'upload_file_si')) {
            Schema::table('shipping_instructions', function (Blueprint $table) {
                $table->dropColumn('upload_file_si');
            });
        }
    }
};
