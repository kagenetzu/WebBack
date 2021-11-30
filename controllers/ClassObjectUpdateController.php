<?php
require_once "BaseClassTwigController.php";

class ClassObjectUpdateController extends BaseClassTwigController {
    public $template = "update.twig";
    public $title = "Редактирование";

    public function getContext(): array
    {
        $context = parent::getContext();
        return $context;
    }

    public function get(array $context)
    {
    $id = $this->params['id'];

        $sql =<<<EOL
SELECT * FROM heroes_tf  WHERE id = :id
EOL; 
        $query = $this->pdo->prepare($sql);
        $query->bindValue("id", $id);
        $query->execute();
        $data = $query->fetch();

        $context['object'] = $data;
        parent::get($context);

    }

    public function post(array $context) { 
        $id = $_POST['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $info = $_POST['info'];

        $tmp_name = $_FILES['image']['tmp_name'];
        $name =  $_FILES['image']['name'];
        move_uploaded_file($tmp_name, "../public/media/$name");
        $image_url = "/media/$name"; 

        if (empty($name)) {
            $sql = <<<EOL
            UPDATE heroes_tf 
SET name = :title, description = :description,info = :info, type = :type
WHERE id = :id
EOL;
            $query = $this->pdo->prepare($sql);
            $query->bindValue("id", $id);
            $query->bindValue("title", $title);
            $query->bindValue("description", $description);
            $query->bindValue("type", $type);
            $query->bindValue("info", $info);
        }else{
            $sql = <<<EOL
            UPDATE heroes_tf 
SET name = :title, image = :image_url, description = :description, info = :info, type = :type  
WHERE id = :id
EOL; 
            $query = $this->pdo->prepare($sql);
            $query->bindValue("id", $id);
            $query->bindValue("title", $title);
            $query->bindValue("description", $description);
            $query->bindValue("type", $type);
            $query->bindValue("info", $info);

            $query->bindValue("image_url", $image_url);
        }

        $query->execute();
        $context['message'] = 'Вы успешно отредактировали объект'; 
        $context['id'] = $id; 
        
        $this->get($context);
    }
}