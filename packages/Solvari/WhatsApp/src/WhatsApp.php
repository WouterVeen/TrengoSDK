<?php


namespace Solvari\WhatsApp;


class WhatsApp
{
    protected $hsm_id = '';
    private $tags = [];
    
    public function getData(){
        return $this->tags;
    }
    
    public function addTag(string $name, $value)
    {
        $this->tags[$name] = $value;
    }
    
    public function getHSMId()
    {
        return $this->hsm_id;
    }
}
