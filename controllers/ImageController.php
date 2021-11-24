<?php
require_once "ObjectController.php";

class ImageController extends ObjectController {
    public $template = "base_image.twig";
    
    public function getContext(): array
    {
        $context = parent::getContext(); 
        $context['is_image'] = true;

        return $context;
    }
}