<?php

$path = 'http://www.99projects.in/bitcoin_new/public/';

return [



    /*

    |--------------------------------------------------------------------------

    | Third Party Services

    |--------------------------------------------------------------------------

    |

    | This file is for storing the credentials for third party services such

    | as Stripe, Mailgun, SparkPost and others. This file provides a sane

    | default location for this type of information, allowing packages

    | to have a conventional place to find your various credentials.

    |

    */



    'mailgun' => [

        'domain' => env('MAILGUN_DOMAIN'),

        'secret' => env('MAILGUN_SECRET'),

    ],



    'ses' => [

        'key' => env('SES_KEY'),

        'secret' => env('SES_SECRET'),

        'region' => 'us-east-1',

    ],



    'sparkpost' => [

        'secret' => env('SPARKPOST_SECRET'),

    ],



    

    

    'facebook' => [

    'client_id' => '440702536331215',

    'client_secret' => '2f5d9681eaf55a22bbddda38ac7b174a',

    'redirect' => 'http://www.99projects.in/bitcoin_new/public/login/facebook/callback',

    

],



  'twitter' => [

    'client_id' => 'I6Txyrdgm2D1UC5XLSJXtD8zp',

    'client_secret' => 'qHgPlzxvf52sd1oIqxZXrOfyr7daoGZWq4f9c1D5tCBiBfJwsz',

    'redirect' => 'http://www.99projects.in/bitcoin_new/public/login/twitter/callback',

    

],



];

