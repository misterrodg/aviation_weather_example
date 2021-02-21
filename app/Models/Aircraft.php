<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use DB;
use PDO;
use Hash;
use Session;
use Carbon;

class Aircraft extends Model
{
  public static function getAircraft(){
    $result = DB::table('aircraft')->get();
    return $result->toArray();
  }
}
