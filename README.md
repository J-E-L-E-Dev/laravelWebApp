# Laravel (WebApp) Web Application

[![Laravel 7.x](https://img.shields.io/badge/Laravel-7.x-red.svg)](https://laravel.com/docs/7.x)
[![Laravel 8.x](https://img.shields.io/badge/Laravel-8.x-red.svg)](https://laravel.com/docs/8.x)
[![Laravel 9.x](https://img.shields.io/badge/Laravel-9.x-red.svg)](https://laravel.com/docs/9.x)
[![Laravel 10.x](https://img.shields.io/badge/Laravel-10.x-red.svg)](https://laravel.com/docs/10.x)

[![Latest Stable Version](http://poser.pugx.org/edwinylil1/laravelwebapp/v)](https://packagist.org/packages/edwinylil1/laravelwebapp)
[![Total Downloads](http://poser.pugx.org/edwinylil1/laravelwebapp/downloads)](https://packagist.org/packages/edwinylil1/laravelwebapp)
[![License](http://poser.pugx.org/edwinylil1/laravelwebapp/license)](https://packagist.org/packages/edwinylil1/laravelwebapp)

[![en](https://img.shields.io/badge/lang-en-red.svg)](https://github.com/J-E-L-E-Dev/laravelWebApp)
[![es](https://img.shields.io/badge/lang-es-yellow.svg)](https://github.com/J-E-L-E-Dev/laravelWebApp/blob/main/README.es.md)

This Laravel package turns your website into a [web application](https://developers.google.com/web/progressive-web-apps). Accessing your site on a mobile or desktop device will prompt you to add the application to your home screen.

You will be able to see the launcher icon of your application from the home screen, and upon tapping it, your web application will be displayed. Therefore, it is crucial that your application provides all the navigation within the HTML (without relying on the browser's forward or backward buttons).

See too the [Laravel Web App Demo](https://github.com/J-E-L-E-Dev/laravelWebAppDemo)


Requirements
=====
This type of web applications requires HTTPS to enable installation functionality unless they are served from localhost. If you are not yet using HTTPS on your site, please refer to [Let's Encrypt](https://letsencrypt.org) and [ZeroSSL](https://zerossl.com).

## Installation

We can add the dependency in our `composer.json` file:

```json
"require": {
    "edwinylil1/laravelwebapp": "~1.0.0",
},
```

or execute

```bash
composer require edwinylil1/laravelwebapp --prefer-dist
```

### Publish

We need to make the package files public in the application:

```bash
php artisan vendor:publish --provider="LaravelWebApp\Providers\LaravelWebAppServiceProvider"
```

### Configuration

You can configure the name, description, icons, presentations, and more of your application in the file created at in `config/laravelwebapp.php`.

Example of the file:

```php
'manifest' => [
        'name' => env('APP_NAME_WA', 'My Web App'),
        'short_name' => env('APP_SN_WA', 'My Web App'),
        'description' => env('APP_DESCRIPTION_WA', 'Made with love by EVillegas'),
        'middleware' => ['web'],
        'start_url' => '/',
        'lang' => config('app.locale'),
        'background_color' => '#A1F188',
        'theme_color' => '#69F78C',
        'display' => 'standalone',
        'orientation'=> 'any',
        'status_bar'=> 'black',
        'icons' => [
            '72x72' => [
                'path' => '/images/icons/icon-72x72.png',
                'purpose' => 'any'
            ], ...
        ],
        'splash' => [
            '640x1136' => '/images/icons/splash-640x1136.png',
            '750x1334' => '/images/icons/splash-750x1334.png',
            '828x1792' => '/images/icons/splash-828x1792.png', ...
        ],
        'shortcuts' => [
            [
                'name' => 'Shortcut Link 1',
                'description' => 'Shortcut Link 1 Description',
                'url' => '/',
                'icons' => [
                    "src" => "/images/icons/icon-72x72.png",
                    "purpose" => "any"
                ]
            ]
        ],
        'custom' => []
    ]
```
You can specify the size of each icon as key of the array or specify it:
```
[
    'path' => '/images/icons/icon-512x512.png',
    'sizes' => '512x512',
    'purpose' => 'any'
],

```
Note: in the `custom` tag, you can insert custom tags in `manifest.json` like this, for example:

```php
...
'custom' => [
    'tag_name' => 'tag_value',
    'tag_name_2' => 'tag_value_2',
    ...
]
...
```   

We need to add the package's Blade directive `@laravelWebApp` to our headers `<head>`.

```html
<html>
<head>
    <title>@yield('title')</title>
    ...
    @laravelWebApp
</head>
<body>
    ...
    My content
    ...
</body>
</html>
```


This should include the appropriate meta tags, the link to `manifest.json` and the serviceworker script.

If you view the code from your browser, it will look like this example:

```html
<!-- Web Application Manifest -->
<link rel="manifest" href="/manifest.json">
<!-- Chrome for Android theme color -->
<meta name="theme-color" content="#000000">

<!-- Add to home screen for Chrome on Android -->
<meta name="mobile-web-app-capable" content="yes">
<meta name="application-name" content="PWA">
<link rel="icon" sizes="512x512" href="/images/icons/icon-512x512.png">

<!-- Add to home screen for Safari on iOS -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<meta name="apple-mobile-web-app-title" content="WebApp">
<link rel="apple-touch-icon" href="/images/icons/icon-512x512.png">

<link href="/images/icons/splash-640x1136.png" media="(device-width: 320px) and (device-height: 568px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-750x1334.png" media="(device-width: 375px) and (device-height: 667px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-1242x2208.png" media="(device-width: 621px) and (device-height: 1104px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-1125x2436.png" media="(device-width: 375px) and (device-height: 812px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-828x1792.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-1242x2688.png" media="(device-width: 414px) and (device-height: 896px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-1284x2778.png" media="(device-width: 428px) and (device-height: 926px) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-1536x2048.png" media="(device-width: 768px) and (device-height: 1024px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-1668x2224.png" media="(device-width: 834px) and (device-height: 1112px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-1668x2388.png" media="(device-width: 834px) and (device-height: 1194px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />
<link href="/images/icons/splash-2048x2732.png" media="(device-width: 1024px) and (device-height: 1366px) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image" />

<!-- Tile for Win8 -->
<meta name="msapplication-TileColor" content="#A1F188">
<meta name="msapplication-TileImage" content="/images/icons/icon-512x512.png">

<script type="text/javascript">
    // Initialize the service worker
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/serviceworker.js', {
            scope: '.'
        }).then(function (registration) {
            // Registration was successful
            console.log('Laravel WebApp: ServiceWorker registration successful with scope: ', registration.scope);
        }, function (err) {
            // registration failed :(
            console.log('Laravel WebApp: ServiceWorker registration failed: ', err);
        });
    }
</script>
```


Troubleshooting
=====
While running the Laravel test server:

1. Verify that `/manifest.json` is being served
1. Verify that `/serviceworker.js` is being served
1. Use the Application tab in the Chrome Developer Tools to verify the web app is configured correctly.
1. Use the "Add to home screen" link on the Application Tab to verify you can add the app successfully.

The Service Worker
=====
By default, the service worker implemented by this app is:

```js
var staticCacheName = "webapp-v" + new Date().getTime();
var filesToCache = [
    '/offline',
    '/css/app.css',
    '/js/app.js',
    '/images/icons/icon-72x72.png',
    '/images/icons/icon-96x96.png',
    '/images/icons/icon-128x128.png',
    '/images/icons/icon-144x144.png',
    '/images/icons/icon-152x152.png',
    '/images/icons/icon-192x192.png',
    '/images/icons/icon-384x384.png',
    '/images/icons/icon-512x512.png',
    '/images/icons/splash-640x1136.png',
    '/images/icons/splash-750x1334.png',
    '/images/icons/splash-828x1792.png',
    '/images/icons/splash-1125x2436.png',
    '/images/icons/splash-1242x2208.png',
    '/images/icons/splash-1242x2688.png',
    '/images/icons/splash-1284x2778.png',
    '/images/icons/splash-1536x2048.png',
    '/images/icons/splash-1668x2224.png',
    '/images/icons/splash-1668x2388.png',
    '/images/icons/splash-2048x2732.png',
];

// Cache on install
self.addEventListener("install", event => {
    this.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName)
            .then(cache => {
                return cache.addAll(filesToCache);
            })
    )
});

// Clear cache on activate
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                    .filter(cacheName => (cacheName.startsWith("webapp-")))
                    .filter(cacheName => (cacheName !== staticCacheName))
                    .map(cacheName => caches.delete(cacheName))
            );
        })
    );
});

// Serve from Cache
self.addEventListener("fetch", event => {
    event.respondWith(
        caches.match(event.request)
            .then(response => {
                return response || fetch(event.request);
            })
            .catch(() => {
                return caches.match('offline');
            })
    )
});
```
To customize service worker functionality, update the `public_path/serviceworker.js`.

The offline view
=====
By default, the offline view is implemented in `resources/views/vendor/laravelwebapp/offline.blade.php`

```html
@extends('layouts.app')

@section('content')

    <h1>Connect to the internet to continue.</h1>

@endsection
```
To customize update this file.

## Contributing

Contributing is easy! Just fork the repo, make your changes then send a pull request on GitHub. If your PR is languishing in the queue and nothing seems to be happening, then send EVillegas an [email](mailto:devvillegas@proton.me).

## Donations
#### by paypal: [Donate](https://www.paypal.com/donate/?hosted_button_id=6BYWC3V29GXLE)
#### by Id Binance: 359233003
