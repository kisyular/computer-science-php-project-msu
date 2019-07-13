<?php
/**
 * Created by PhpStorm.
 * User: Rellika Kisyula
 * Date: 2018/05/24
 * Time: 5:05 PM
 */
/**
 * Create an array that represents the cave
 * @returns Array
 */
function cave_array() {
    $cave = array ( 1 => array(5, 6, 2), 2 => array(1, 8, 3),
                    3 => array(2,4,10), 4 => array(3,5,12),
                    5  => array(4,1,14), 6  => array(1,7,15),
                    7  => array(6,8,16), 8  => array(7,9,2),
                    9  => array(8,10,17), 10  => array(9,11,3),
                    11  => array(10,12,18), 12  => array(11,13,4),
                    13  => array(12,14,19), 14  => array(13,15,5),
                    15  => array(14,6,20), 16  => array(20,17,7),
                    17  => array(16,18,9), 18  => array(17,19,11),
                    19  => array(18,20,13), 20  => array(19,16,15));

    return $cave;
}