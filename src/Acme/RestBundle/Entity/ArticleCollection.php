<?php

namespace Acme\RestBundle\Entity;

use JMS\Serializer\Annotation as Serializer;

use Doctrine\Common\Collections\ArrayCollection,
    Doctrine\Common\Collections\Collection;

/**
 * JMS serializer really wants you to work with object graphs
 * This class here just provides this for a simple example
 * but the implementation here isn't really meant to be used
 * as an example of how to best do this but rather to be the
 * most simple way to enable the controller to provide a proper
 * example.
 */
class ArticleCollection
{
    /**
     * @var Collection
     * @Serializer\XmlList(inline = true, entry = "article")
     */
    protected $articles;

    /**
     * @var int
     * @Serializer\XmlAttribute()
     */
    protected $page;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getArticles()
    {
        return $this->articles;
    }

    public function addArticle(Article $article)
    {
        $this->articles[] = $article;
    }

    public function setPage($page)
    {
        $this->page = $page;
    }

    public function getPage()
    {
        return $this->page;
    }
}
