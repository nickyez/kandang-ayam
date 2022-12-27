<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        // * TRIGGER FOR LAMP STATUS
        DB::unprepared('
            CREATE TRIGGER `tr_insert_lamp_status` AFTER INSERT ON `devices` FOR EACH ROW BEGIN INSERT INTO lamp_status (`id`,`status`,`mode`) VALUES (NEW.id, 0, 0); END;
        ');
        DB::unprepared('
            CREATE TRIGGER `tr_delete_lamp_status` BEFORE DELETE ON `devices` FOR EACH ROW BEGIN DELETE FROM lamp_status WHERE `id`=OLD.id; END;
        ');
        DB::unprepared('
            CREATE TRIGGER `tr_update_lamp_status_before` BEFORE UPDATE ON `devices` FOR EACH ROW BEGIN DELETE FROM lamp_status WHERE `id`=OLD.id; END;
        ');
        DB::unprepared('
        CREATE TRIGGER `tr_update_lamp_status_after` AFTER UPDATE ON `devices` FOR EACH ROW BEGIN INSERT INTO lamp_status (`id`,`status`,`mode`) VALUES (NEW.id, 0, 0);  END;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //!! DROP TRIGGER ABOUT LAMP STATUS
        DB::unprepared('
            DROP TRIGGER IF EXISTS `tr_insert_lamp_status`;
            DROP TRIGGER IF EXISTS `tr_delete_lamp_status`;
            DROP TRIGGER IF EXISTS `tr_update_lamp_status_before`;
            DROP TRIGGER IF EXISTS `tr_update_lamp_status_after`;
        ');
    }
}
