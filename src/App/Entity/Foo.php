<?php

// TODO: remove

namespace App\Entity;

class Foo
{
    protected $id;
    protected $title;

    public function __construct($title)
    {
        $this->id = spl_object_hash($this);
        $this->title = $title;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }
}