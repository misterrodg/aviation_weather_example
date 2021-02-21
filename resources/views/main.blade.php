<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @if(isset($translate) && $translate == false)<meta name="google" content="notranslate" />@endif
  <title>Aviation Data Center</title>
  <!-- Scripts -->
  <!-- Fonts -->
  <script src="https://kit.fontawesome.com/1d4c03e01a.js" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
  <!-- Styles -->
  {!! Html::style('/css/main.css') !!}
  {!! Html::style('/css/helper.css') !!}
  {!! Html::style('/css/app.css') !!}
  {!! Html::script('/js/app.js') !!}
  <!-- Style Overrides -->
</head>
<body class="col-12 d-flex justify-content-center">
  <div class="col-8 mt50 rounded">
    <div class="mb10">
      <h1>Aviation Data Center
        @if(isset($title)): {{$title}}@endif
      </h1>
    </div>
    <div class="rounded p10 content">
      @yield('content')
    </div>
    <div class="footer mt20">
      @if(!isset($title))
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
      @else
        <a href="/">HOME</a>
      @endif
    </div>
  </div>
</body>
</html>
