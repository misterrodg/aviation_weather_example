@extends('main')
@section('content')
<script type="text/javascript">

$(document).ready(function () {
  $('#weatherform').validate({
    rules : {
      icao : {
        required : true,
        regex: "[a-zA-Z]{4}",
        minlength: 4,
        maxlength: 4
      },
      type : { required : true }
    },
    messages : {
      icao : 'Please enter a 4 letter airport code.',
      type : 'Please select a type.'
    },
    errorPlacement: function (error, element) {
      var name = $(element).attr("name");
      error.appendTo($("#" + name + "_validate"));
    }
  });
});

function submitClick(){
  if( $("#weatherform").valid()){
    $("#btndisable").prop('disabled',true);
    $("#weatherform").submit();
  }else{
    $("#btndisable").removeAttr( "disabled" );
  }
}
</script>
<div class="col-12 p0">
  {!! Form::open(['url' => '/weather', 'method' => 'POST', 'role' => 'form' ,'id' => 'weatherform', 'autocomplete' => 'off']) !!}
    <div class="col-12 p0">
      <div><label><sup>*</sup>Airport ICAO Code</label></div>
      <div><input type="text" name="icao" id="icaoid"
        placeholder="EDDF" value="@if($icao!=''){{$icao}}@endif">
      </div>
    </div>
    <div id="icao_validate" class="validate"></div>
    <div class="col-12 mt20 p0">
      <div><sup>*</sup>Type</div>
      <input class="ml20" type="radio" id="metar" name="type" value="metar" @if($type=='metar' || $type == '') checked @endif>
      <label class="ml5" for="metar">METAR (METeorological Aerodrome Report)</label><br>
      <input class="ml20" type="radio" id="taf" name="type" value="taf" @if($type=='taf') checked @endif>
      <label class="ml5" for="taf">TAF (Terminal Aerodrome Forecast)</label><br>
      <input class="ml20" type="radio" id="atis" name="type" value="atis" @if($type=='atis') checked @endif>
      <label class="ml5" for="atis">ATIS (Automated Terminal Information Service)</label>
    </div>
    <div id="type_validate" class="validate"></div>
    <div class="col-12 mt20 p0">
      <button type="button" id="btndisable" onclick="submitClick()">Submit</button>
    </div>
  {!! Form::close() !!}
  @if(!empty($weatherdata))
    <div class="col-12 mt20 p0 output">
      @foreach($weatherdata as $wd)
        {{$wd}}
        @if($wd=="No Data" && $type=="atis")
        <div style="font-weight:normal;font-size:12px;">
          ATIS requests are sent to a volunteer simulator network.<br/>
          Since someone is not logged in as {{$icao}}, no data is available for that airport.<br/>
          Try one of these:<br/>
          {{$whoson['stations']}}
        </div>
        @endif
      @endforeach
    </div>
  @endif
</div>
@stop
