<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @if(app()->enviroment('production'))
            <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=UA-144521349-3"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', 'UA-144521349-3');
            </script>
        @endif
        <!-- COMPULSORY META TAGS -->
        <meta charset="utf-8">
        <meta name="_token" content="{{ csrf_token() }}" />
        <meta http-equiv='cache-control' content='no-cache'>
        <meta http-equiv='expires' content='0'>
        <meta http-equiv='pragma' content='no-cache'>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @if(config('app.env') !== 'review')
            {!! SEO::generate(true) !!}
        @endif

        <!-- SITE TITLE -->
        {{-- <meta name="keywords" content="Buy, Sell, Shop, Explore products and services, properties, Advertize, Lands, Houses, Rent, Lease" />
        <meta name="image" content="/images/assets/logo.png" />

        <meta name="og:site_name" content="{{ env('APP_NAME') }}" />
        <meta name="og:locale" content="en_US" />
        <meta name="article:section" content="Buy, Sell, Shop, Explore products and services, properties, Advertize, Lands, Houses, Rent, Lease" />
        <meta name="description" content="Buy, Sell, Shop, Explore products and services, properties, Advertize, Lands, Houses, Rent, Lease" /> --}}
        <!--Facebook Open Graph-->
        {{-- <meta name="framework" content="Redux 4.3.3">
        <meta name='robots' content='max-image-preview:large'> --}}

        <!-- Facebook Open Graph -->
        {{-- <meta property="og:image" content="/images/assets/logo.png" />
        <meta property="og:url" content="https://geohomesgroup.com//" />
        <meta property="og:type" content="Real Estate" />
        <meta property="og:title" content="Geohomes Services Limited" />
        <meta property="og:description" content="Buy, Sell, Shop, Explore products and services, properties, Advertize, Lands, Houses, Rent, Lease" /> --}}

        <!--Twitter Share-->
        {{-- <meta name="twitter:image:src" content="/images/assets/logo.png" />
        <meta property="twitter:image" content="/images/assets/logo.png" />
        <meta property="twitter:title" content="{{ env('APP_NAME') }}" />
        <meta property="twitter:card" content="summary_large_card" />
        <meta property="twitter:site" content="{{ env('APP_URL') }}" />
        <meta property="twitter:site_name" content="{{ env('APP_NAME') }}"/>
        <meta property="twitter:description" content="Buy, Sell, Shop, Explore products and services, properties, Advertize, Lands, Houses, Rent, Lease" /> --}}

        <meta charset="utf-8" name="google-site-verification" content="=8kf5mgYQhvdaG83hokZpIDyISEeWEEa6Jib6s1pjZdM">
        <meta name="msvalidate.01" content="E54BD83E87BAF1B6D2813C397CB5771D" />
        
        <link rel="https://api.w.org/" href="assets/json/index.htm.json">
        <link rel="EditURI" type="application/rsd+xml" title="RSD" href="../xmlrpc.php.xml?rsd">
        <link rel="wlwmanifest" type="application/wlwmanifest+xml" href="public/assets/wlwmanifest.xml">

        <link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
        <link rel="manifest" href="/favicon/site.webmanifest">

        {{-- Google fonts --}}
        @if(app()->enviroment('production'))
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@500&display=swap" rel="stylesheet">
        @endif

        {{-- File Pond CSS --}}
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css" rel="stylesheet" />
        <link href="https://unpkg.com/filepond/dist/filepond.min.css" rel="stylesheet" />

        <!-- Bootstrap CSS CDN -->
        <link rel="stylesheet" type="text/css" href="/bootstrap/bootstrap.min.css">
        <!-- utility CSS -->
        <link rel="stylesheet" type="text/css" href="/css/utility.css">
        <!-- index CSS -->
        <link rel="stylesheet" type="text/css" href="/css/index.css">
        <!-- dealers CSS -->
        <link rel="stylesheet" type="text/css" href="/css/dealers.css">
        <!-- ico font css -->
        <link rel="stylesheet" type="text/css" href="/icofont/icofont.min.css">
        <!-- fontawesome css -->
        <link rel="stylesheet" type="text/css" href="/fontawesome/css/all.min.css">
        <!-- summernote CSS -->
        <link rel="stylesheet" type="text/css" href="/summernote/summernote-lite.min.css">
    </head>
    <body>