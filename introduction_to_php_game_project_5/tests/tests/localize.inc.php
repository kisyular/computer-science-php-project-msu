<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/12
 * Time: 4:05 PM
 */
/**
 * Function to localize our site
 * @param $site The Site object
 */
return function(Felis\Site $site) {
    // Set the time zone
    date_default_timezone_set('America/Detroit');
    $site->setEmail('tesfami1@cse.msu.edu');
    $site->setRoot('/~tesfami1/step8');
    $site->dbConfigure('mysql:host=mysql-user.cse.msu.edu;dbname=tesfami1',
        'tesfami1',       // Database user
        'password',     // Database password
        'test8_');            // Table prefix
};