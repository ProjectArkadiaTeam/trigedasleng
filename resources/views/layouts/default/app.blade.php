<html>
<head>
    @if(config('site.gapp_analytics_id') !== '')
         <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('site.gapp_analytics_id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ config('site.gapp_analytics_id') }}');
        </script>
    @endif
    <title>@section('title')@show @hasSection('title') - @endif{{ config('app.title') }}</title>
    <meta charset="UTF-8">
    <meta name="description" content="Trigedasleng is a conlang created bt David J. Peterson for The TV-Show The100">
    <meta name="keywords" content="The100,Dictionary,Unoffical,Trigedasleng">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
    <link rel="stylesheet" type="text/css" href="/css/main.css?v=13513.11" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/583b09e947.js"></script>
    <script src="/js/main.js"></script>
</head>
<body>
@section('head')
    @include('layouts.default.head')
@show
@section('sidebar')
    @include('layouts.default.sidebar')
@show

<div id="content">
    @yield('content')
</div>
@section('footer')
    <div id="footer">
        <a href="..">Home</a> | <a href="https://github.com/projectarkadiateam/trigedasleng">Github</a> <!--| <a href="contact.php">Contact</a>-->
    </div>
@show
</body>
</html>
