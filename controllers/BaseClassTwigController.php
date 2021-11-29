<?php

class BaseClassTwigController extends TwigBaseController{
    public function getContext(): array
    {
        $context = parent::getContext();

        $query = $this->pdo->query("SELECT DISTINCT title from types ORDER by 1");
        $types = $query->fetchAll();
        $context['new_types'] = $types;
        
        return $context;
    }
}