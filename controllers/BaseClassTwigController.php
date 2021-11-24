<?php

class BaseClassTwigController extends TwigBaseController{
    public function getContext(): array
    {
        $context = parent::getContext();

        $query = $this->pdo->query("SELECT DISTINCT type from heroes_tf ORDER by 1");
        $types = $query->fetchAll();
        $context['types'] = $types;
        
        return $context;
    }
}