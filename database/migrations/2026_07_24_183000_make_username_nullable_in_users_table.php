<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MakeUsernameNullableInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        try {
            DB::statement("ALTER TABLE users MODIFY username VARCHAR(255) NULL;");
        } catch (\Exception $e) {
            // Ignore if DB driver doesn't support raw ALTER or if already nullable
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        try {
            DB::statement("ALTER TABLE users MODIFY username VARCHAR(255) NOT NULL;");
        } catch (\Exception $e) {
            // Reverse
        }
    }
}
