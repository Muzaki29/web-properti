<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Supports common home / listing queries: active + featured + order by recency.
     */
    public function up(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->index(
                ['is_active', 'is_featured', 'created_at'],
                'properties_active_featured_created_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropIndex('properties_active_featured_created_idx');
        });
    }
};
