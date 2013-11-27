<?php
/**
 * Created by PhpStorm.
 * User: vir-mir
 * Date: 20.11.13
 * Time: 13:45
 */


return array(
    'template' => array(
        'folder' => 'template',
        'head' => 'site/head.html',
        'footer' => 'site/footer.html',
    ),

    'helpers' => 'debug,fn',

    '_database' => array( // для работы измените _database на database
        'hostname' => 'komtender.local',
        'username' => 'root',
        'pwd' => '',
        'dbname' => 'holiday_holiday',
    ),

);