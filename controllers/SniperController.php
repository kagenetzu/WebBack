<?php
//require_once "TwigBaseController.php"; // импортим TwigBaseController

class SniperController extends TwigBaseController {
    public $template = "__object.twig";
    public $title = "Снайпер";


    public function getContext(): array
    {
        $context = parent::getContext(); 
        $context['image'] = "/images/sniper.jpg";
        $context['url'] = "/sniper";
        


        return $context;
    }
}