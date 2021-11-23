<?php
require_once "SpyController.php";

class SpyInfoController extends SpyController {
    public $template = "spyInfo.twig";
    
    public function getContext(): array
    {
        $context = parent::getContext(); 
        $context['is_info'] = true;

        return $context;
    }
}
