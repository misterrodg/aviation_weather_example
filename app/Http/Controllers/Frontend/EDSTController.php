<?php
namespace App\Http\Controllers\Frontend;
use DB;
use Hash;
use Session;
use Carbon;
use Cookie;
use File;
use App\Models\Aircraft;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EDSTController extends Controller
{

  public function aircraftListing(){
    $aircraftList = Aircraft::getAircraft();

    /*** SEO Array ***/
    $SEOArray = array(
      'title' => 'Aircraft List',
      'keywords' => '',
      'description' => ''
    );
    /*** SEO Array ***/
    $data['title']       = $SEOArray['title'];
    $data['keywords']    = $SEOArray['keywords'];
    $data['description'] = $SEOArray['description'];
    $data['aircraftList'] = $aircraftList;
    return view('frontend.edst', $data);
  }

  protected function getMessages($acid){
    $arr['data'] = Message::getMessages($acid);
    if (!$arr['data']) {
      $arr['error']    = 1;
      $arr['errormsg'] = 'Invalid ID';
      return response()->json($arr);
      exit();
    }
    $arr['success'] = 1;
    return response()->json($arr);
    exit();
  }
}
