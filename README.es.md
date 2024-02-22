# Laravel (WebApp) Aplicaci&oacute;n Web

[![Laravel 7.x](https://img.shields.io/badge/Laravel-7.x-red.svg)](https://laravel.com/docs/7.x)
[![Laravel 8.x](https://img.shields.io/badge/Laravel-8.x-red.svg)](https://laravel.com/docs/8.x)
[![Laravel 9.x](https://img.shields.io/badge/Laravel-9.x-red.svg)](https://laravel.com/docs/9.x)
[![Laravel 10.x](https://img.shields.io/badge/Laravel-10.x-red.svg)](https://laravel.com/docs/10.x)

[![Latest Stable Version](http://poser.pugx.org/edwinylil1/laravelwebapp/v)](https://packagist.org/packages/edwinylil1/laravelwebapp)
[![Total Downloads](http://poser.pugx.org/edwinylil1/laravelwebapp/downloads)](https://packagist.org/packages/edwinylil1/laravelwebapp)
[![License](http://poser.pugx.org/edwinylil1/laravelwebapp/license)](https://packagist.org/packages/edwinylil1/laravelwebapp)

[![en](https://img.shields.io/badge/lang-en-red.svg)](https://github.com/edwinylil1/readmeML)
[![es](https://img.shields.io/badge/lang-es-yellow.svg)](https://github.com/edwinylil1/readmeML/blob/main/README.es.md)

Este paquete de Laravel convierte su sitio web en una [aplicaci&oacute;n web](https://developers.google.com/web/progressive-web-apps). Navegar a su sitio en un dispositivo m&oacute;vil o de escritorio le pedir&aacute; que agregue la aplicaci&oacute;n a su pantalla de inicio.

Podr&aacute; ver el icono lanzador de su aplicaci&oacute;n desde la pantalla de inicio, al pulsar se mostrar&aacute; su aplicaci&oacute;n web. Como tal, es fundamental que su aplicaci&oacute;n proporcione toda la navegaci&oacute;n dentro del HTML (sin depender del bot&oacute;n de avance o retroceso del navegador). 

Puedes ver tambi&eacute;n el [Laravel Web App Demo](https://github.com/edwinylil1/laravelWebAppDemo)

Requisitos
=====
Este tipo de aplicaciones web requieren HTTPS para activar la funcionalidad de instalaci&oacute;n, a menos que se proporcionen desde localhost. Si a&uacute;n no est&aacute;s usando HTTPS en tu sitio, consulta Let's Encrypt y ZeroSSL 

## Instalaci&oacute;n

Puedes agregar lo siguiente a tu archivo compositor.json:

```json
"require": {
    "edwinylil1/laravelwebapp": "~1.0.0",
},
```

o ejecutar:

```bash
composer require edwinylil1/laravelwebapp --prefer-dist
```

### Publicar

Debemos hacer p&uacute;blicos los archivos del paquete en la aplicaci&oacute;n :

```bash
php artisan vendor:publish --provider="LaravelWebApp\Providers\LaravelWebAppServiceProvider"
```

### Configuraci&oacute;n

Puede configurar el nombre, la descripci&oacute;n, los &iacute;conos, las presentaciones y m&aacute;s de su aplicaci&oacute;n en el archivo creado en `config/laravelwebapp.php`.

Ejemplo del archivo:

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
Puede especificar el tama&ntilde;o de cada icono como clave de la matriz o especificarlo:

```
[
    'path' => '/images/icons/icon-512x512.png',
    'sizes' => '512x512',
    'purpose' => 'any'
],

```

Observaci&oacute;n: en la etiqueta `custom` puede insertar etiquetas personalizadas en `manifest.json`, por ejemplo:

```php
...
'custom' => [
    'tag_name' => 'tag_value',
    'tag_name_2' => 'tag_value_2',
    ...
]
...
```

Necesitamos agregar la directiva Blade del paquete `@laravelWebApp` a nuestros encabezados `<head>`.

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

Esto debe incluir las metaetiquetas apropiadas, el enlace a `manifest.json` y el script del serviceworker.


si ven el c&oacute;digo desde su navegador quedara como este ejemplo:

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


Soluci&oacute;n de problemas
=====
Mientras ejecuta el servidor de prueba Laravel:

1. Verifique que se esté entregando el `/manifest.json`
1. Verifique que se esté entregando el `/serviceworker.js`
1. Utilice la pesta&ntildea Aplicaci&oacute;n en las Herramientas para desarrolladores de Chrome para verificar que la aplicaci&oacute;n web est&eacute; configurada correctamente.
1. Utilice el enlace "Agregar a la pantalla de inicio" en la pesta&ntilde;a Aplicaci&oacute;n para verificar que puede agregar la aplicaci&oacute;n correctamente.

El trabajador de servicio
=====
De forma predeterminada, el trabajador de servicio implementado por esta aplicaci&oacute;n es:

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

Para personalizar la funcionalidad del trabajador del servicio, en el archivo `public_path/serviceworker.js`.

La vista fuera de l&iacute;nea

=====
De forma predeterminada, la vista sin conexi&oacute;n se encuentra en `resources/views/vendor/laravelwebapp/offline.blade.php`
Para personalizar, actualice este archivo

```html
@extends('layouts.app')

@section('content')

    <h1>Connect to the internet to continue.</h1>

@endsection
```

## Contribuir

¡Contribuir es f&aacute;cil! Simplemente bifurque el repositorio, realice los cambios y luego env&iacute;e una solicitud de extracci&oacute;n en GitHub. Si su RP languidece en la cola y parece que no sucede nada, env&iacute;e a EVillegas un [email](mailto:devvillegas@proton.me).

## Donaciones
#### Por paypal: para devvillegas@proton.me
#### Por Id Binance: 359233003