<?php

require_once "BaseClassTwigController.php";

class TypeObjectCreateController extends BaseClassTwigController {
    public $template = "type_create.twig";

    public function getContext(): array
    {
        $context = parent::getContext();
        $query = $this->pdo->query("SELECT * FROM types");
        $context['new_types'] = $query->fetchAll();
        return $context;
    }

    public function get(array $context)
    {
        
        parent::get($context);
    }

    public function post(array $context) { 
        $title = $_POST['title'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $name =  $_FILES['image']['name'];
        move_uploaded_file($tmp_name, "../public/media/$name");
        $image_url = "/media/$name"; 


        $sql = <<<EOL
INSERT INTO types(title, image)
VALUES(:title, :image_url)
EOL;

        $query = $this->pdo->prepare($sql);
        $query->bindValue("title", $title);
        $query->bindValue("image_url", $image_url);
        
        $query->execute();
        $context['message'] = 'Вы успешно создали тип'; 
        $context['id'] = $this->pdo->lastInsertId(); 

        $this->get($context);
        
    }
}