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

class Message extends Model
{
  public static function getMessages($cid){
    $result = DB::table('messages')->where('cid',$cid)->get();
    return $result->toArray();
  }
}
