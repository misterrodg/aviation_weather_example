@extends('main')
@section('content')
<div class="row col-12">
  <div class="col-6">
    <div class="row title">
      <span class="icon"><i class="fas fa-sun"></i></span>
      <div class="pl15">
        <h2><a href="/weather">Weather Data</a></h2>
      </div>
    </div>
    <div>
      <div>
        Aviation runs on being able to understand the weather around the world.
        Find the latest weather using our easy-to-use interface.
      </div>
      <div class="mt10">
        Developer? Easily fetch data using our API.
      </div>
      <div class="mt10">
        Read the documentation <a href="/apidocs" class="underline">here</a>.
      </div>
    </div>
  </div>
  <div class="col-6">
    <div class="row title">
      <span class="icon"><i class="far fa-circle"></i></span>
      <div class="pl15">
        <h2><a href="/edst" target="_blank">EDST Mockup <i class="fas fa-external-link-alt"></i></a></h2>
      </div>
    </div>
    <div>
      <div>
        Air Traffic Control is an important link in effectively managing the
        number of aircraft flying our skies.
      </div>
      <div class="mt10">
        An EDST is a display that helps a controller deliver textual data
        and instructions to aircraft, making radio frequencies more efficient.
      </div>
    </div>
  </div>
</div>
@stop
