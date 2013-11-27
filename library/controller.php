<?php
/**
 * Created by PhpStorm.
 * User: vir-mir
 * Date: 20.11.13
 * Time: 13:39
 */

namespace library;

use library\Singleton;
use library\DB;


class Controller {

    public function __construct() {
        new DB();
    }

    public function load($fn, $param) {
        if ($fn == 'load' || $fn == 'loadTemplate') {
            $this->load404();
        } else {
            $this->$fn($param);
        }
    }

    public function load404() {
        $this->loadTemplate('site/404.html', array());
    }

    public function load403() {
        $this->loadTemplate('site/403.html', array());
    }

    protected function loadTemplate($templateName, $paramExternal = array(), $head=null, $footer=null) {

        if ($paramExternal) {
            foreach ($paramExternal as $kExternal=>$vExternal) $$kExternal = $vExternal;
        }

        $template = & Singleton::getKernel()->getConfig('template');

        $folder = $template['folder'];
        $head = $head?$head:__MAINROOT__ . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $template['head'];
        $footer = $footer?$footer:__MAINROOT__ . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $template['footer'];
        $templateName = __MAINROOT__ . DIRECTORY_SEPARATOR . $folder . DIRECTORY_SEPARATOR . $templateName;

        if (file_exists($head))
            include $head;
        else
            echo $head;

        if (file_exists($templateName))
            include $templateName;
        else
            echo $template;

        if (file_exists($footer))
            include $footer;
        else
            echo $footer;

    }

} 