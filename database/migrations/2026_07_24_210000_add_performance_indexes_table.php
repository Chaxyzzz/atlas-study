<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPerformanceIndexesTable extends Migration
{
    /**
     * Run the migrations for high performance database queries.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->index('google_id', 'idx_users_google_id');
            $table->index('phone', 'idx_users_phone');
            $table->index('role', 'idx_users_role');
            $table->index('status', 'idx_users_status');
            $table->index('provider', 'idx_users_provider');
            $table->index('last_login_at', 'idx_users_last_login');
        });

        Schema::table('lessons', function (Blueprint $table) {
            $table->index(['is_published', 'category_id'], 'idx_lessons_published_category');
            $table->index(['is_published', 'views'], 'idx_lessons_published_views');
            $table->index(['is_published', 'created_at'], 'idx_lessons_published_created');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->index(['is_active', 'parent_id', 'order'], 'idx_categories_active_parent_order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex('idx_users_google_id');
            $table->dropIndex('idx_users_phone');
            $table->dropIndex('idx_users_role');
            $table->dropIndex('idx_users_status');
            $table->dropIndex('idx_users_provider');
            $table->dropIndex('idx_users_last_login');
        });

        Schema::table('lessons', function (Blueprint $table) {
            $table->dropIndex('idx_lessons_published_category');
            $table->dropIndex('idx_lessons_published_views');
            $table->dropIndex('idx_lessons_published_created');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex('idx_categories_active_parent_order');
        });
    }
}
