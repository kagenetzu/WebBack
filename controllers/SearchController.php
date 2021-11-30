<?php

require_once "BaseClassTwigController.php";

class SearchController extends BaseClassTwigController{
    public $template = "search.twig";
    public $title = "Поиск";

    public function getContext(): array
    {
        $context = parent::getContext();

        $type = isset($_GET['type']) ? $_GET['type'] : '';
        $title = isset($_GET['name']) ? $_GET['name'] : '';
        $info =isset($_GET['info']) ? $_GET['info'] : '';

        if (isset($_GET['type'])){
            if(($_GET['type'])=="Все"){
                $sql = <<< EOL
                SELECT id, name, info 
                FROM heroes_tf
                WHERE (:name = '' OR name like CONCAT('%', :name, '%'))
                AND (:info = '' OR info like CONCAT('%', :info, '%'))
                
                EOL;
            }else{
                $sql = <<< EOL
                SELECT id, name, info
                FROM heroes_tf
                WHERE (:name = '' OR name like CONCAT('%', :name, '%'))
                AND (type = :type)
                AND (:info = '' OR info like CONCAT('%', :info, '%'))
                EOL;
            }
        

            $query = $this->pdo->prepare($sql);
            $query->bindValue("name",$title);
            $query->bindValue("type",$type);
            $query->bindValue("info",$info);
            $query->execute();

            $context['objects'] = $query->fetchAll();
        }

        return $context;
    }
}