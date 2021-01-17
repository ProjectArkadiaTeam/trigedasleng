<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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
    <meta name="theme-color" content="#212529"/>
    <link rel="manifest" href="/site.webmanifest" />
    <link rel="apple-touch-icon" sizes="180x180" href="/img/ios180x180.png" />
    <link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
    <link rel="preconnect" href="https://trigedasleng.net">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <script>
		// Check for browser support of service worker
		// if ('serviceWorker' in navigator) {
		// 	navigator.serviceWorker.register('/service-worker.js', {scope: '/'})
		// 		.then(function(registration) {
		// 			// Successful registration
		// 			console.log('Hooray. Registration successful, scope is:', registration.scope);
		// 		}).catch(function(error) {
		// 		// Failed registration, service worker won’t be installed
		// 		console.log('Whoops. Service worker registration failed, error:', error);
		// 	});
		// }
    </script>
</head>
<body>
    <div id="app"></div>
    <noscript>
        <p>This site does not work without Javascript enabled!</p>
    </noscript>
    <script src="{{ asset('js/app.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="/css/app.css" />
</body>
