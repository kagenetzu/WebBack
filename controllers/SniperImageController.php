<?php
require_once "SniperController.php";

class SniperImageController extends SniperController{
    public $template = "base_image.twig";


    public function getContext(): array
    {
        $context = parent::getContext();
        $context['is_image'] = true;
        

        return $context;
    }
}