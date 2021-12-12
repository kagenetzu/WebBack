<?php
require_once "BaseClassTwigController.php"; // импортим BaseClassTwigController

class MainController extends BaseClassTwigController {
    public $template = "main.twig";
    public $title = "Главная";

    public function getContext(): array
    {
        $context = parent::getContext();

        if(isset($_GET['type'])){

        $query = $this->pdo->prepare("SELECT * FROM heroes_tf WHERE type = :type");
        $query->bindValue("type",$_GET['type']);
        $query->execute();

        }else{
            $query = $this->pdo->query("SELECT * FROM heroes_tf");
        }
        
        $context['team_f'] = $query->fetchAll();
        $context['viewed_pages'] = array_reverse($_SESSION['viewed_pages']);
        

        return $context;
    }
}
