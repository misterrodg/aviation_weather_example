<?php
namespace App\Http\Controllers;
use Hash;
use Carbon;
use File;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CronController extends Controller
{
  public function getDataFile($type){
    if($type == 'aircraftreports'){
      $remotepath = 'https://www.aviationweather.gov/adds/dataserver_current/current/aircraftreports.cache.xml';
    } else if($type == 'metar'){
      $remotepath = 'https://www.aviationweather.gov/adds/dataserver_current/current/metars.cache.xml';
    } else if($type == 'taf'){
      $remotepath = 'https://www.aviationweather.gov/adds/dataserver_current/current/tafs.cache.xml';
    } else if($type == 'atis'){
      $remotepath = 'https://data.vatsim.net/v3/vatsim-data.json';
    }
    $filedir  = $_SERVER['DOCUMENT_ROOT'].'/cache'.'/';
    $filename = basename($remotepath);
    $filepath = $filedir.$filename;

    if(file_exists($filepath)){
      unlink($filepath);
    }

    $ci = curl_init($remotepath);
    $fp = fopen($filepath,'wb');

    curl_setopt($ci,CURLOPT_FILE,$fp);
    curl_setopt($ci, CURLOPT_HEADER, 0);
    curl_exec($ci);
    curl_close($ci);
    fclose($fp);
  }
}
