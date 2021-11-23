<?php
//require_once "TwigBaseController.php"; // импортим TwigBaseController

class SpyController extends TwigBaseController {
    public $template = "__object.twig";
    public $title = "Шпион";


    public function getContext(): array
    {
        $context = parent::getContext(); 
        $context['image'] = "/images/spy.jpg";
        $context['url'] = "/spy";
        


        return $context;
    }
}