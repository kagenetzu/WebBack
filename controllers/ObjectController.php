<?php
require_once "BaseClassTwigController.php";
class ObjectController extends BaseClassTwigController {
    public $template = "__object.twig"; // указываем шаблон
    public $title = "";

    public function getTemplate()
    {
        if (isset($_GET['show'])){
            if(($_GET['show'])=="image"){
                return "base_image.twig";                
            }
            if(($_GET['show'])=="info"){
                return "Info.twig";
            }
        }else{
            return parent::getTemplate();
        }
    }
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

        if (isset($_GET['show'])){
            if(($_GET['show'])=="image"){
                $context['is_image'] = true;
                $context['image'] = $data['image'];
                
            }
            if(($_GET['show'])=="info"){
                $context['is_info'] = true;
                $context['info'] = $data['info'];
            }
        }


        

        return $context;
    }
}
