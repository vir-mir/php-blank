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
        $this->loadTemplate(Singleton::getKernel()->getConfig(404), array());
    }

    public function load403() {
        $this->loadTemplate(Singleton::getKernel()->getConfig(403), array());
    }

    protected function loadTemplate($templateName, $paramExternal = array(), $head=null, $footer=null) {

        $template = & Singleton::getKernel()->getConfig('template');
        if ($template['template'] == 'twig') {

            require_once __MAINROOT__ . DIRECTORY_SEPARATOR . 'library/Twig/Autoloader.php';

            \Twig_Autoloader::register();

            if ($head===true) {
                $loader = new \Twig_Loader_String();
            } else {
                $loader = new \Twig_Loader_Filesystem(__MAINROOT__ . DIRECTORY_SEPARATOR . $template['folder']);
            }
            $twig = new \Twig_Environment($loader);

            echo $twig->render($templateName, $paramExternal);

            return ;
        }


        if ($paramExternal) {
            foreach ($paramExternal as $kExternal=>$vExternal) $$kExternal = $vExternal;
        }


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