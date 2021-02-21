<?php
namespace App\Http\Controllers\Frontend;
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
use App\Http\Controllers\ATSUController;

class FrontendController extends Controller
{
  protected $ATSUController;

  public function __construct(ATSUController $ATSUController){
    $this->ATSUController = $ATSUController;
  }

  public function apidocs(){
    $data['translate']    = false;
    $data['title']        = 'API Documentation';
    $data['description']  = 'Documentation for the Weather Center API.';
    return view('frontend.apidocs', $data);
  }

  public function weather(Request $request){
    $weatherdata = array();
    $icao = '';
    $type = '';
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['icao'])){
      $type = $_POST['type'];
      $icao = $_POST['icao'];
      $weatherdata = $this->ATSUController->fetchFileData($type,$icao);
      $weatherdata = json_decode($weatherdata,true);
    }
    $whoson = $this->ATSUController->whosOn();
    $whoson = json_decode($whoson,true);
    if(!empty($whoson) && is_array($whoson)){
      $whoson['stations'] = implode(", ",$whoson['stations']);
    }
    $data['weatherdata']  = $weatherdata;
    $data['whoson']       = $whoson;
    $data['icao']         = $icao;
    $data['type']         = $type;
    $data['title']        = 'Weather Data';
    $data['description']  = 'Weather data page to fetch data from airports around the world.';
    return view('frontend.weather',$data);
  }
}
