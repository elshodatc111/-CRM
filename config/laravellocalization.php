<?php

return [

    'supportedLocales' => [
        'uz' => ['name' => 'Uzbek', 'script' => 'Latn', 'native' => 'O\'zbekcha'],
        'ru' => ['name' => 'Russian', 'script' => 'Cyrl', 'native' => 'Русский'],
        'en' => ['name' => 'English', 'script' => 'Latn', 'native' => 'English'],
    ],

    'useAcceptLanguageHeader' => true,

    'hideDefaultLocaleInURL' => false,

    'localesOrder' => [],

    'localesMapping' => [],

    'utf8suffix' => env('LARAVELLOCALIZATION_UTF8SUFFIX', '.UTF-8'),

    'urlsIgnored' => ['/skipped'],

    'httpMethodsIgnored' => ['POST', 'PUT', 'PATCH', 'DELETE'],
];
