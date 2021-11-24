<?php

class ObjectController extends TwigBaseController {
    public $template = "__object.twig"; // указываем шаблон
    public $title = "";

    public function getContext(): array
    {
        $context = parent::getContext();
        
        
        $query = $this->pdo->prepare("SELECT image,description,name, info,id FROM heroes_tf WHERE id= :my_id");
        
        // стягиваем одну строчку из базы
        $query->bindValue("my_id", $this->params['id']);
        $query->execute();
        $data = $query->fetch();
    
        $context['description'] = $data['description'];
        $context['id'] = $data['id'];
        $context['info'] = $data['info'];
        $context['image'] = $data['image'];

        return $context;
    }
}
