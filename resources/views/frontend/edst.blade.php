<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Flight Track</title>
  {!! Html::style('/css/helper.css') !!}
  {!! Html::style('/css/app.css') !!}
  {!! Html::script('/js/app.js') !!}

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=PT+Mono&display=swap" rel="stylesheet">

  <style>
  html,body {
    height:100%;
    width:100%;
    margin: 0;
    padding: 0;
    background-color: #000000;
    overflow: hidden;
    color: #CCCCCC;
    font-family: 'PT Mono', monospace;
    font-size: 14px;
    font-weight: bold;
    line-height: 20px;
  }
  .footer {
    color:#CCCCCC;
  }
  .edstcontainer {
    padding: 5px;
  }
  .edstcontent {
    border:1px solid #CCCCCC;
    margin-bottom: 50px;
  }
  .edstcontent .header {
    width:100%;
    color:#000000;
    background-color: #00FFFF;
  }
  .edstmodal {
    border:1px solid #CCCCCC;
    width:fit-content;
  }
  .edstmodal .header{
    width:100%;
    color:#FFFFFF;
    background-color: #999999;
  }
  .button{
    height:20px;
    width:20px;
    border:1px solid #FFFFFF;
    text-align:center;
    color: #FFFFFF;
  }
  .button a {
    color: #FFFFFF;
  }
  .spacer{
    width:10px;
    height:100%;
  }
  .bottomline{
    border-bottom: 1px solid #666666;
  }
  .unk {
    color: #FF9933;
  }
  .trianglewifi {
    width: 0;
    height: 0;
    border-bottom: 20px solid #00FF99;
    border-right: 20px solid transparent;
  }
  .trianglewifidark {
    width: 0;
    height: 0;
    border-bottom: 20px solid #00CC99;
    border-right: 20px solid transparent;
  }
  .blackbox {
    width:20px;
    height:20px;
    border:1px solid #CCCCCC;
  }
  .linkbox {
    width:15px;
    height:20px;
    border:1px solid #CCCCCC;
  }
  .green {
    background-color: #00CC99;
  }
  .redbox {
    width:20px;
    height:20px;
    border:1px solid #CCCCCC;
    background-color: #FF0000;
  }
  .yelbox {
    width:20px;
    height:20px;
    border:1px solid #CCCCCC;
    background-color: #FFCC00;
  }
  .aspbox {
    width:20px;
    height:20px;
    border:1px solid #CCCCCC;
    background-color: #00CCFF;
  }
  .triangleopen {
    width: 0;
    height: 0;
    border-bottom: 10px solid #CCCCCC;
    border-left: 10px solid transparent;
  }
  .square {
    margin-top: 6px;
    width: 10px;
    height: 10px;
    background: #FFFFFF;
  }
  .squareopen {
    margin-top: 6px;
    width:10px;
    height:10px;
    background: #666666;
  }
  .handoff {
    margin-top: 6px;
    width: 0;
    height: 0;
    border-top: 5px solid transparent;
    border-left: 10px solid #FFFFFF;
    border-bottom: 5px solid transparent;
  }
  </style>
  <script>
  function pad (num, len) {
    num = num.toString();
    return num.length < len ? pad("0" + num, len) : num;
  }

  function openqueue(){
    $("#edstmodal").show();
  }

  function closequeue(){
    $("#edstmodal").hide();
  }

  function fetchRecords(cid,acid){
    $.ajax({
      url: '/getMessages/'+cid,
      type: 'get',
      dataType: 'json',
      success: function(response){
        $('#messages').empty(); // Empty <tbody>
        if(response['data'] != null && response['data'].length>0){
          for(var i=0; i<response['data'].length; i++){
            var r_cid = pad(response['data'][i].cid,3);
            var r_acid = response['data'][i].acid;
            var r_msg = response['data'][i].msg;
            var r_resp = response['data'][i].resp;
            var r_ztime = response['data'][i].ztime;
            var r_sector = response['data'][i].sector;

            var str = "<div class='row ml0 mr0' style='width:100%;'>" +
              "<div style='width:05%;'>" + r_cid + "</div>" +
              "<div style='width:10%;'>" + r_acid + "</div>" +
              "<div style='width:60%;'>" + r_msg + "</div>" +
              "<div style='width:08%;'>" + r_resp + "</div>" +
              "<div style='width:09%;'>" + r_ztime + "</div>" +
              "<div style='width:08%;'>" + r_sector + "</div>" +
            "</div>";

            $("#messages").append(str);
          }
        }else{
          var str = "<div class='row ml0 mr0' style='width:100%;'>" +
            "<div style='width:100%;text-align:center;'>Message queue empty.</td>" +
          "</div>";
          $("#messages").append(str);

        }
        $('#foracid').html('HISTORY ' + acid);
        openqueue();
      },
      error: function(){

      }
    });
  }
  </script>

</head>
<body>
  <?php
    //In a full simulation, the sector value would be set by the user logged in.
    $sectorValue = 'D20';
    //In a full simulaiton, the iterator would not be present.
    //Used here to match the reference image originally provided by client.
    $iterator = 3;
  ?>
  <div class="edstcontainer">
    <div class="edstcontent">
      <div class="row ml0 mr0 header">
        <div class="col-4"></div>
        <div class="col-2">Aircraft List</div>
        <div class="col-2">Sector {{$sectorValue}}</div>
        <div class="col-4"></div>
      </div>
      <div class="col-12 mt3 pb1">
        @foreach($aircraftList as $item)
          <div class="row ml0 mr0">
            <div class="row">
              <div class="p1 pb0">
                <?php
                  //Comment in PHP to be sure that it doesn't show up on the live page.
                  //A lot of these @ifs could be consolidated into:
                  //<div class="@if($item->connect == 2) trianglewifi @else trianglewifidark @endif"></div>
                  //Using the longer form in many cases for readability.
                ?>
                @if($item->connect == 2)
                  <div class="trianglewifi"></div>
                @elseif($item->connect == 1)
                  <div class="trianglewifidark"></div>
                @else
                  <div style="width:20px;height:20px;"></div>
                @endif
              </div>
              <div class="p1 pb0">
                @if($item->redalert == 1)
                  <div class="redbox"></div>
                @else
                  <div class="blackbox"></div>
                @endif
              </div>
              <div class="p1 pb0">
                @if($item->yelalert == 1)
                  <div class="yelbox"></div>
                @else
                  <div class="blackbox"></div>
                @endif
              </div>
              <div class="p1 pb0">
                @if($item->aspalert == 1)
                  <div class="aspbox"></div>
                @else
                  <div class="blackbox"></div>
                @endif
              </div>
              <div class="p1 pb0 spacer"></div>
              <div class="p1 pb0 @if($iterator%3==0) bottomline @endif @if($item->sector == 'UNK') unk @endif">
                {{str_pad($item->cid, 3, '0', STR_PAD_LEFT)}}
              </div>
              <div class="p1 pb0 spacer @if($iterator%3==0) bottomline @endif"></div>
              <div class="p1 pb0 @if($iterator%3==0) bottomline @endif">
                @if($item->dalevel == 3)
                  <div class="square"></div>
                @elseif($item->dalevel == 2)
                  <div class="squareopen"></div>
                @elseif($item->dalevel == 1)
                  <div class="triangleopen"></div>
                @else
                  <div style="width:10px;height:10px;"></div>
                @endif
              </div>
              <div class="row p1 pb0 ml0 mr0 @if($iterator%3==0) bottomline @endif @if($item->sector == 'UNK') unk @endif" style="width:200px;">
                <div>
                  {{$item->acid}}@if($sectorValue != $item->sector && $item->handoff == 0)({{$item->sector}})@elseif($item->handoff == 1)
                  <div style="display:inline-flex;">
                    <div class="handoff" style="display:inline;"></div>
                  </div>
                  ({{$item->sector}})@endif
                </div>
              </div>
              <div class="linkbox @if($iterator==3 || $iterator == 12) green @endif @if($iterator%3==0) bottomline @endif">
                <a href="Javascript:void(0)" onclick="fetchRecords('{{$item->cid}}','{{$item->acid}}')" style="display:block;height:100%;"></a>
              </div>
              <div class="p1 pb0 spacer @if($iterator%3==0) bottomline @endif"></div>
              <div class="p1 pb0 @if($iterator%3==0) bottomline @endif" style="width:150px;">{{$item->atype}}/{{$item->etype}}</div>
              <div class="p1 pb0 @if($iterator%3==0) bottomline @endif" style="width:150px;">{{$item->alt}}</div>
              <div class="p1 pb0 @if($iterator%3==0) bottomline @endif" style="width:150px;">{{$item->ztime}}</div>
            </div>
          </div>
          <?php $iterator++ ?>
        @endforeach
      </div>
    </div>
    <div class="edstmodal" id="edstmodal" style="display:none;">
      <div>
        <div class="row ml0 mr0 header clearfix">
          <div class="ml0 mr0 p0 col-1"><div class="button">M</div></div>
          <div class="col-10" style="text-align:center;" id="foracid"></div>
          <div class="ml0 mr0 p0 col-1" ><div class="button FR"><a href="Javascript:void(0)" onclick="closequeue()">-</a></div></div>
        </div>
        <div class="row ml0 mr0 clearfix">
          <div class="ml0 mr0 p3 col-2">
            <div class="FL">FLID</div>
            <div class="FR" style="border:1px solid #CCCCCC;width:80px;height:18px;"></div>
          </div>
          <div class="ml0 mr0 p3 col-10">
            <div class="FR" style="background-color:#00CCFF;border:1px solid #FFFFFF;width:100px;text-align:center;">DEL ALL</div>
          </div>
        </div>
      </div>
      <div class="col-12 row ml0 mr0" style="border-top:1px solid #CCCCCC;border-bottom:1px solid #CCCCCC;min-width:750px;">
        <div style="width:05%;">CID</div>
        <div style="width:10%;">ACID</div>
        <div style="width:60%;">MSG CONTENT</div>
        <div style="width:08%;">STAT</div>
        <div style="width:09%;">TIME</div>
        <div style="width:08%;">ORG</div>
      </div>
      <div class="col-12 row ml0 mr0 mt3 mb3" id="messages">
        <!-- Messages Go Here -->
      </div>
    </div>
    <div class="col-12 row ml0 mr0 mt50 mb3 footer">
      NOTE:
      <ul>
        <li>Final line shows all three alert types as an example</li>
        <li>Narrow boxes filled by green show flights with messages in queue</li>
        <li>Click on the green box to display the message queue</li>
        <li>Any modal boxes can be closed by clicking the <span class="button">-</span> at the top right</li>
      </ul>
    </div>
  </div>
</body>
</html>
