<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('destinies', function (Blueprint $table) {
            $table->renameColumn('photo', 'photo_1');
            $table->string('photo_2')->nullable()->default(null);
            $table->string('meta', 160)->default('');
            $table->text('description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('destinies', function (Blueprint $table) {
            $table->renameColumn('photo_1', 'photo');
            $table->dropColumn(['photo_2', 'meta', 'description']);
        });
    }
};
