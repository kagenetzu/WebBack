<?php

class BaseClassTwigController extends TwigBaseController{
    public function getContext(): array
    {
        $context = parent::getContext();

        $query = $this->pdo->query("SELECT title from types ");
        $types = $query->fetchAll();
        $context['new_types'] = $types;
        
        return $context;
    }
}