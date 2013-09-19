<?php

namespace Acme\RestBundle\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use JMS\Serializer\Annotation as Serializer;

class Article
{
    /**
     * @Serializer\Groups({"data"})
     * @Serializer\Until("1.x")
     */
    public $id;

    /**
     * @Assert\Length(min = 3)
     * @Assert\Length(max = 30)
     * @Serializer\Groups({"data"})
     * @Serializer\Since("2.0")
     */
    public $name;

    /**
     * @Assert\NotBlank
     * @Serializer\Groups({"data"})
     */
    public $content;

    public function __construct($name = null)
    {
        $this->name = $name;
    }

    public function __toString()
    {
        return (string) $this->name;
    }
}