<?php

namespace App\Controller;

class Errors {

    public static function show_error_page()
    {
        $view = new \App\View\Errors\NotFound();
        $view->render();
    }
}