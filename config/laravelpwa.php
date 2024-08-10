<?php

return [
    'name' => 'LaravelPWA',
    'manifest' => [
        'name' => env('APP_NAME', 'BPB UNM'),
        'short_name' => 'BPB UNM',
        'start_url' => '/',
        'background_color' => '#EFFDF5',
        'theme_color' => '#00B98E',
        'display' => 'standalone',
        'orientation'=> 'any',
        'status_bar'=> '#00B98E',
        'icons' => [
		  '36x36' => [
                'path' => '/images/icons/icon-36x36.png',
                'purpose' => 'any'
            ],
            '72x72' => [
                'path' => '/images/icons/icon-72x72.png',
				'sizes' => '72x72',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => '/images/icons/icon-96x96.png',
                'purpose' => 'any'
            ],
            '120x120' => [
                'path' => '/images/icons/icon-120x120.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => '/images/icons/icon-144x144.png',
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => '/images/icons/icon-152x152.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => '/images/icons/icon-192x192.png',
                'purpose' => 'any'
            ],
          
         
        ],
        'splash' => [
            '640x1136' => '/images/icons/splash-640x1136.png',
            '750x1334' => '/images/icons/splash-750x1334.png',
            '828x1792' => '/images/icons/splash-828x1792.png',
            '1125x2436' => '/images/icons/splash-1125x2436.png',
            '1242x2208' => '/images/icons/splash-1242x2208.png',
            '1242x2688' => '/images/icons/splash-1242x2688.png',
            '1536x2048' => '/images/icons/splash-1536x2048.png',
            '1668x2224' => '/images/icons/splash-1668x2224.png',
            '1668x2388' => '/images/icons/splash-1668x2388.png',
            '2048x2732' => '/images/icons/splash-2048x2732.png',
        ],
        'shortcuts' => [
            [
                'name' => 'BPB UNM',
                'description' => 'Website Badan Pengembangan Bisnis Univeristas Negeri Makassar',
                'url' => '/register',
                'icons' => [
                    "src" => "/images/icons/icon-72x72.png",
                    "purpose" => "any"
                ]
            ],
        ],
        'custom' => []
    ]
];
