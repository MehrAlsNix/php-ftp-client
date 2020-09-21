<?php

class Observer implements SplObserver
{
    private $id;

    public function getId()
    {
        return $this->id;
    }
    
    public function update(SplSubject $subject)
    {
        
    }
}
