<html>
<head>
    @if(config('app.gapp_analytics_id') !== '')
         <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ config('app.gapp_analytics_id') }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', '{{ config('app.gapp_analytics_id') }}');
        </script>
    @endif
    <title>@section('title')@show @hasSection('title') - @endif{{ config('app.title') }}</title>
    <meta charset="UTF-8">
    <meta name="description" content="{{ config('app.meta_desc') }}">
    <meta name="keywords" content="{{ config('app.meta_keywords') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="apple-touch-icon" sizes="180x180" href="/img/ios180x180.png">
    <link rel="shortcut icon" type="image/png" href="/favicon.png"/>
    <link rel="stylesheet" type="text/css" href="/css/app.css?v=1" />
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/583b09e947.js"></script> --}}
    {{-- <script async src="/js/main.js?v=1"></script> --}}
    <link rel="stylesheet" type="text/css" href="/css/main.css?v=13514.15" />
</head>
<body>
    <div id="app"></div>

    <script src="{{ asset('js/app.js')}}"></script>
</body>
