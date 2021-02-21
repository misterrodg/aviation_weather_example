<?php
namespace App\Http\Controllers\api;
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

class apiController extends Controller
{
  protected $ATSUController;

  public function __construct(ATSUController $ATSUController){
    $this->ATSUController = $ATSUController;
  }

  public function fetchData($type,$icao){
    $response = $this->ATSUController->fetchFileData($type,$icao);
    echo $response;
  }

  public function whosOnline(){
    $response = $this->ATSUController->whoson();
    echo $response;
  }
}
