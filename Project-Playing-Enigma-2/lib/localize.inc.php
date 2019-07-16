<?php
/**
 * Created by PhpStorm.
 * User: tesfami1
 * Date: 2018/06/19
 * Time: 4:00 PM
 */

/**
 * Function to localize our site
 * @param $site The Site object
 */
return function(Enigma\Site $site) {
    // Set the time zone
    date_default_timezone_set('America/Detroit');
    $site->setEmail('tesfami1@msu.edu');
    $site->setRoot('/~tesfami1/project2');
    $site->dbConfigure('mysql:host=mysql-user.cse.msu.edu;dbname=tesfami1',
        'tesfami1',       // Database user
        'password',     // Database password
        'p2_');            // Table prefix
};