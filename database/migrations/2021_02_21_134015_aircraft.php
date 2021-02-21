<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Aircraft extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      //Initial
      Schema::create('flights', function (Blueprint $table) {
        DB::statement('CREATE TABLE `ft_aircraft` (
          `cid` int(11) DEFAULT NULL,
          `acid` varchar(10) DEFAULT NULL,
          `atype` varchar(4) DEFAULT NULL,
          `etype` char(1) DEFAULT NULL,
          `alt` varchar(7) DEFAULT NULL,
          `ztime` char(4) DEFAULT NULL,
          `sector` varchar(4) DEFAULT NULL,
          `dalevel` int(11) DEFAULT NULL,
          `connect` int(11) DEFAULT NULL,
          `redalert` tinyint(4) DEFAULT NULL,
          `yelalert` tinyint(4) DEFAULT NULL,
          `aspalert` tinyint(4) DEFAULT NULL,
          `handoff` tinyint(4) DEFAULT NULL
        )');
        DB::statement('INSERT INTO `aircraft` VALUES (1,`AAL34`,`A321`,`L`,`220`,`0004`,`D20`,3,2,0,0,0,0),
          (0,`AAA0000`,`A321`,`L`,`220`,`0041`,`D20`,3,0,0,0,0,0),
          (0,`AAA0000`,`B752`,`L`,`210T110`,`0054`,`D20`,3,0,0,0,0,0),
          (0,`AAA0000`,`A321`,`L`,`220`,`0042`,`D20`,3,0,0,0,0,0),
          (121,`DAL2747`,`B738`,`L`,`210`,`2213`,`D20`,3,2,0,0,0,0),
          (18,`DAL10`,`B738`,`L`,`210`,`2211`,`D20`,3,2,0,0,0,0),
          (9,`SKW2261`,`CRJ2`,`L`,`220`,`0033`,`D20`,0,0,0,0,0,0),
          (22,`SKW4523`,`MD90`,`L`,`230`,`0034`,`D20`,0,0,0,0,0,0),
          (17,`ASQ1580`,`E170`,`L`,`250T160`,`0015`,`D20`,0,2,0,0,0,0),
          (51,`DAL1368`,`B738`,`L`,`220`,`0017`,`D19`,3,1,0,0,0,1),
          (20,`DAL1533`,`B738`,`L`,`210`,`2214`,`D19`,2,0,0,0,0,0),
          (21,`DAL210`,`B738`,`L`,`210`,`2212`,`D19`,2,0,0,0,0,0),
          (26,`DAL1689`,`B738`,`L`,`220`,`0020`,`UNK`,0,0,0,0,0,0),
          (27,`UAL2384`,`A321`,`L`,`220`,`0043`,`UNK`,0,0,1,1,1,0)
        ');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('flights');
    }
}
