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
        'head' => '', // is template = html
        'footer' => '', // is template = html
        'template' => 'twig', // html, twig
    ),

    'helpers' => 'debug,fn',

    '_database' => array( // для работы измените _database на database
        'hostname' => 'komtender.local',
        'username' => 'root',
        'pwd' => '',
        'dbname' => 'holiday_holiday',
    ),

);