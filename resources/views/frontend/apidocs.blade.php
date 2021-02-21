@extends('main')
@section('content')
<div class="col-12">
  <div class="col-12 mt20">
    <h2>Fetching data from our API is very simple:</h2>
    <div class="row">
      <div class="col-4"><h5>Data Type</h5></div>
      <div class="col-8"><h5>URL</h5></div>
    </div>
    <div class="row">
      <div class="col-4">METAR:</div>
      <div class="col-8">/api/metar/{FACILITY ICAO CODE}</div>
    </div>
    <div class="row">
      <div class="col-4">TAF:</div>
      <div class="col-8">/api/taf/{FACILITY ICAO CODE}</div>
    </div>
    <div class="row">
      <div class="col-4">ATIS:</div>
      <div class="col-8">/api/atis/{FACILITY ICAO CODE}</div>
    </div>
  </div>
  <div class="col-12 mt20">
    <h2>Examples:</h2>
    <div class="row">
      <div class="col-4">Example for EDDF:</div>
      <div class="col-8">/api/metar/EDDF</div>
    </div>
    <div class="row">
      <div class="col-4">Response (JSON):</div>
      <div class="col-8">{"metar":"EDDF 160920Z 34003KT 300V030 9999 FEW025 BKN035 M00\/M07 Q1028 NOSIG"}</div>
    </div>
  </div>
  <div class="col-12 mt20">
    <h2>Try It Out!</h2>
    <div class="row">
      <div class="col-4">Example for EDDF:</div>
      <div class="col-8"><a href="/api/metar/EDDF" target="_blank">Link Opens in New Window</a></div>
    </div>
  </div>
  <div class="col-12 mt20">
    <h2>Note</h2>
    <div class="col-12">
      <span style="color:#FF0000;">ATIS</span>-type requests are sent to VATSIM, a volunteer online network.<br/>
      If someone is not logged in for that airport, {"error":"No Data"} is the expected return.<br/>
      All online positions are shown via <a href="/api/whosonline" target="_blank">/api/whosonline <i class="fas fa-external-link-alt"></i></a>.
    </div>
  </div>
</div>
@stop
