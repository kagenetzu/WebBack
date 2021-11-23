<?php
require_once "SpyController.php";

class SpyImageController extends SpyController{
    public $template = "base_image.twig";


    public function getContext(): array
    {
        $context = parent::getContext();
        $context['is_image'] = true;
        

        return $context;
    }
}