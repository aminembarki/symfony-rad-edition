<?php

// TODO: remove

namespace App\Controller;

use App\Entity\Foo;

class FooController
{
    public function indexAction()
    {
        return ['blogPosts' => array(new Foo('post1'), new Foo('post2'))];
    }
}