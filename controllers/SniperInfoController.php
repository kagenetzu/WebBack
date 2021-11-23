<?php
require_once "SniperController.php";

class SniperInfoController extends SniperController {
    public $template = "sniperInfo.twig";
    
    public function getContext(): array
    {
        $context = parent::getContext(); 
        $context['is_info'] = true;

        return $context;
    }
}
