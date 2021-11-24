<?php
require_once "BaseClassTwigController.php";

class Controller404 extends BaseClassTwigController {
    public $template = "404.twig"; 
    public $title = "Страница не найдена";
}
