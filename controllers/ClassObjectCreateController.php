<?php
require_once "BaseClassTwigController.php";

class ClassObjectCreateController extends BaseClassTwigController {
    public $template = "object_create.twig";

    public function get(array $context) // добавили параметр
    {
        //echo $_SERVER['REQUEST_METHOD'];
        
        parent::get($context); // пробросили параметр
    }

    public function post(array $context) { // добавили параметр
        $title = $_POST['title'];
        $description = $_POST['description'];
        $info = $_POST['info'];
        $type = $_POST['type'];

        $tmp_name = $_FILES['image']['tmp_name'];
        $name =  $_FILES['image']['name'];
        move_uploaded_file($tmp_name, "../public/media/$name");
        $image_url = "/media/$name"; // формируем ссылку без адреса сервера

        // создаем текст запрос
        $sql = <<<EOL
INSERT INTO heroes_tf(name,image, description, info, type)
VALUES(:name, :image_url, :description, :info, :type)
EOL;

        // подготавливаем запрос к БД
        $query = $this->pdo->prepare($sql);
        // привязываем параметры
        $query->bindValue("name", $title);
        $query->bindValue("description", $description);
        $query->bindValue("info", $info);
        $query->bindValue("type", $type);

        $query->bindValue("image_url", $image_url); // подвязываем значение ссылки к переменной  image_url
        $query->execute();
        
        $context['message'] = 'Вы успешно создали объект';
        $context['id'] = $this->pdo->lastInsertId(); // получаем id нового добавленного объекта

        $this->get($context);
    }
}
