<?php
/**
 * scanlogin extention config file
 */

return [

    /*
     |--------------------------------------------------------------------------
     | scanlogin Settings
     |--------------------------------------------------------------------------
     | scanlogin laravel extention
     | exten config
     |
     */

    'appid' => '',
    'agentid' => '',
    'redirect_uri' => 'http://'.$_SERVER["HTTP_HOST"].'/userinfo',
    'state' => '',
    'href' => '',
];
