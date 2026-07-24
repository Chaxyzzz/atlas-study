<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductionUserFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'provider')) {
                $table->string('provider')->default('local')->after('google_id');
            }
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->default('student')->after('provider');
            }
            if (!Schema::hasColumn('users', 'status')) {
                $table->string('status')->default('active')->after('role');
            }
            if (!Schema::hasColumn('users', 'last_login_at')) {
                $table->timestamp('last_login_at')->nullable()->after('status');
            }
            if (!Schema::hasColumn('users', 'last_login_ip')) {
                $table->string('last_login_ip')->nullable()->after('last_login_at');
            }
            if (!Schema::hasColumn('users', 'device')) {
                $table->string('device')->nullable()->after('last_login_ip');
            }
            if (!Schema::hasColumn('users', 'browser')) {
                $table->string('browser')->nullable()->after('device');
            }
            if (!Schema::hasColumn('users', 'operating_system')) {
                $table->string('operating_system')->nullable()->after('browser');
            }
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
            $columnsToDrop = [];
            foreach (['provider', 'role', 'status', 'last_login_at', 'last_login_ip', 'device', 'browser', 'operating_system'] as $col) {
                if (Schema::hasColumn('users', $col)) {
                    $columnsToDrop[] = $col;
                }
            }
            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
}
