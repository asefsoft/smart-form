<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => '',
        'secret' => '',
    ],

    'mandrill' => [
        'secret' => '',
    ],

    'ses' => [
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => MyApp\User::class,
        'key' => '',
        'secret' => '',
    ],

    'github' => [
        'client_id' => 'efa23cc2b1bae03b8276',
        'client_secret' => 'f8b5606965ba99844cde7fb67d3aa38024140458',
        'redirect' => 'http://localhost/lv51/public/login',
    ]

];
