<?php
namespace App\Http\Controllers;
use DB;
use Hash;
use Session;
use Carbon;
use Cookie;
use File;
use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CronController;

class ATSUController extends Controller
{
  protected $CronController;

  public function __construct(CronController $CronController){
    $this->CronController = $CronController;
  }

  public function dataCheck($type,$path){
    if(!file_exists($path) || time()-filemtime($path) > 3600){
      //3600 is 1 hour in seconds
      $this->CronController->getDataFile($type);
    }
    return true;
  }

  public function fetchFileData($type,$icao){
    $validTypes = array('metar','taf','atis');
    $searchval = strtoupper($icao);
    $basepath = $_SERVER['DOCUMENT_ROOT'];
    $response = "";
    $arr = array('error' => 'No File');

    if(in_array($type,$validTypes)){
      if($type == "atis"){
        $searchval .= "_ATIS";
        $filepath = $basepath.'/cache/vatsim-data.json';
        $fileexists = $this->dataCheck($type,$filepath);
        $filedata = file_get_contents($filepath);
        $loadeddata = json_decode($filedata) or die("{\"error\":\"Malformed JSON\"}");

        foreach($loadeddata->atis as $atis){
          if($atis->callsign == $searchval){
            $response = $atis->text_atis;
          }
        }

        if(!empty($response) && is_array($response)){
          $response = implode(" ",$response);
        }

      } else {
        $filepath = $basepath.'/cache/'.$type.'s.cache.xml';
        $fileexists = $this->dataCheck($type,$filepath);
        $loadeddata  = simplexml_load_file($filepath) or die("{\"error\":\"Malformed XML\"}");
        $xpath = '//'.strtoupper($type).'[station_id="'.$searchval.'"]/raw_text';
        $response = $loadeddata->xpath($xpath);
        $response = reset($response[0][0]);
      }

      if(!empty($response)){
        $arr = array($type => $response);
      } else {
        $arr = array('error' => 'No Data');
      }
    }
    return json_encode($arr);
  }

  public function whosOn(){
    $basepath = $_SERVER['DOCUMENT_ROOT'];
    $filepath = $basepath.'/cache/vatsim-data.json';
    $fileexists = $this->dataCheck('atis',$filepath);
    $filedata = file_get_contents($filepath);
    $loadeddata = json_decode($filedata) or die("{\"error\":\"Malformed JSON\"}");
    $response = array();

    foreach($loadeddata->atis as $atis){
      if(substr($atis->callsign,-5,5)=="_ATIS" && !is_null($atis->text_atis)){
        array_push($response,substr($atis->callsign,0,4));
      }
      sort($response);
    }

    if(!empty($response)){
      $arr = array('stations' => $response);
    } else {
      $arr = array('error' => 'No Data');
    }

    return json_encode($arr);
  }
}
