<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerForPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // insert status into quote after quote inserted
        DB::unprepared('
            CREATE TRIGGER update_balance_in_users_table AFTER INSERT ON `user_payments` FOR EACH ROW
            BEGIN
                UPDATE users SET balance = NEW.balance_after  WHERE users.id = NEW.user_id;
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `update_balance_in_users_table`');
    }
}
