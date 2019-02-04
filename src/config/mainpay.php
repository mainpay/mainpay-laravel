<?php

return [

    /*
    |--------------------------------------------------------------------------
    | MainPay Production Mode
    |--------------------------------------------------------------------------
    |
    | This value determines the MainPay "environment" mode that you want to run.
    | If disabled, you will be running it in "sandbox" mode, meaning that all of
    | your transactions won't be real.
    |
    */

    'production' => env('MAINPAY_PRODUCTION', true),

    /*
    |--------------------------------------------------------------------------
    | MainPay Server Key
    |--------------------------------------------------------------------------
    |
    | Here you may provide your MainPay server key. You can get it in your
    | MainPay dashboard. We recommend setting this in your ".env" file.
    |
    */

    'server_key' => env('MAINPAY_SERVER_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | MainPay Client Key
    |--------------------------------------------------------------------------
    |
    | Here you may provide your MainPay client key. You can get it in your
    | MainPay dashboard. We recommend setting this in your ".env" file.
    |
    */

    'client_key' => env('MAINPAY_CLIENT_KEY', ''),

];
