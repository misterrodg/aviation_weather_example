<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Messages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::statement('CREATE TABLE `ft_messages` (
        `cid` int(11) DEFAULT NULL,
        `acid` varchar(10) DEFAULT NULL,
        `msg` varchar(255) DEFAULT NULL,
        `resp` varchar(255) DEFAULT NULL,
        `ztime` char(4) DEFAULT NULL,
        `sector` varchar(4) DEFAULT NULL
      )');
      DB::statement('INSERT INTO `messages` VALUES (1,`AAL34`,`CLRD TO DTA VIA LNK313025..OBH151010`,`WIL`,`1814`,`D26`),
        (1,`AAL34`,`26 128.750 CAA 220`,`WIL`,`1809`,`R27`),
        (51,`DAL1368`,`26 128.750 CAA 220`,`WIL`,`1801`,`R27`)
      ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('messages');
    }
}
