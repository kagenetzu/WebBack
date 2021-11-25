<?php
require_once "BaseController.php";

class TwigBaseController extends BaseController {
    public $title = ""; // название страницы
    public $template = ""; // шаблон страницы
    protected \Twig\Environment $twig;
    public $url ="";
    
    public function setTwig($twig) {
        $this->twig = $twig;
    }
    
    
    public function getContext() : array
    {
        $context = parent::getContext(); // вызываем родительский метод
        $context['title'] = $this->title; // добавляем title в контекст
        $context['url'] = $this->url;

        return $context;
    }
    
    
    public function get() {
        $context = $this->getContext();
        echo $this->twig->render($this->getTemplate(),$context );
    }

    public function getTemplate(){
        return $this->template;
    }
}
