<?php
/**
 * Created by PhpStorm.
 * User: Edwin Villegas
 * Date: 18/02/2024
 * Time: 10:25
 */

namespace LaravelWebApp\Services;


class ManifestService
{
    public function generate()
    {
        $basicManifest =  [
            'name' => trans(config('laravelwebapp.manifest.name')),
            'short_name' => trans(config('laravelwebapp.manifest.short_name')),
            'start_url' => asset(config('laravelwebapp.manifest.start_url')),
            'description' => trans(config('laravelwebapp.manifest.description')),
            'display' => config('laravelwebapp.manifest.display'),
            'theme_color' => config('laravelwebapp.manifest.theme_color'),
            'background_color' => config('laravelwebapp.manifest.background_color'),
            'orientation' =>  config('laravelwebapp.manifest.orientation'),
            'status_bar' =>  config('laravelwebapp.manifest.status_bar'),
            'splash' =>  config('laravelwebapp.manifest.splash'),
            'lang' => config('laravelwebapp.manifest.lang')
        ];

        foreach (config('laravelwebapp.manifest.icons') as $size => $file) {
            $fileInfo = pathinfo($file['path']);
            $basicManifest['icons'][] = [
                'src' => $file['path'],
                'type' => 'image/' . $fileInfo['extension'],
                'sizes' => (isset($file['sizes']))?$file['sizes']:$size,
                'purpose' => $file['purpose']
            ];
        }

        if (config('laravelwebapp.manifest.shortcuts')) {
            foreach (config('laravelwebapp.manifest.shortcuts') as $shortcut) {

                if (array_key_exists("icons", $shortcut)) {
                    $fileInfo = pathinfo($shortcut['icons']['src']);
                    $icon = [
                        'src' => $shortcut['icons']['src'],
                        'type' => 'image/' . $fileInfo['extension'],
                        'purpose' => $shortcut['icons']['purpose']
                    ];
                    if(isset($shortcut['icons']['sizes'])) {
                        $icon['sizes'] = $shortcut['icons']['sizes'];
                    }
                } else {
                    $icon = [];
                }

                $basicManifest['shortcuts'][] = [
                    'name' => trans($shortcut['name']),
                    'description' => trans($shortcut['description']),
                    'url' => $shortcut['url'],
                    'icons' => [
                        $icon
                    ]
                ];
            }
        }

        if (config('laravelwebapp.manifest.custom')) {
            foreach (config('laravelwebapp.manifest.custom') as $tag => $value) {
                $basicManifest[$tag] = $value;
                if ($tag === 'description') {
                    $value = trans($value);
                }
                $basicManifest[$tag] = $value;
            }
        }

        return $basicManifest;
    }

}
