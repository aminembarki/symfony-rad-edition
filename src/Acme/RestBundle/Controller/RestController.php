<?php

namespace Acme\RestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\RestBundle\View\RouteRedirectView;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Controller\Annotations\QueryParam;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Acme\RestBundle\Entity\ArticleCollection;
use Acme\RestBundle\Entity\Article;
use Acme\RestBundle\Form\ArticleType;

class RestController extends Controller
{
    /**
     * Get the list of articles
     *
     * @param ParamFetcherInterface $paramFetcher
     * @param string $page integer with the page number (requires param_fetcher_listener: force)
     * @return array data
     *
     * @QueryParam(name="page", requirements="\d+", default="1", description="Page of the overview.")
     * @ApiDoc()
     */
    public function getArticlesAction(ParamFetcherInterface $paramFetcher)
    {
        $data = new ArticleCollection();
        $data->setPage($paramFetcher->get('page'));
        $data->addArticle(new Article('bim'));
        $data->addArticle(new Article('bam'));
        $data->addArticle(new Article('bingo'));

        $view = new View($data);
        $view->setTemplate('AcmeRestBundle:Rest:getArticles.html.twig');

        return $view;
    }

    /**
     * Display the form
     *
     * @return Form form instance
     *
     * @ApiDoc()
     */
    public function newArticleAction()
    {
        $data = $this->getForm();
        $view = new View($data);
        $view->setTemplate('AcmeRestBundle:Rest:newArticle.html.twig');

        return $view;
    }

    /**
     * Display the edit form
     *
     * @param string $article path
     * @return Form form instance
     *
     * @ApiDoc()
     */
    public function editArticleAction($article)
    {
        $article = $this->createArticle($article);
        $data = $this->getForm($article);
        $view = new View($data);
        $view->setTemplate('AcmeRestBundle:Rest:newArticle.html.twig');

        return $view;
    }

    private function createArticle($article)
    {
        $article = new Article($article);
        $article->id = 1;
        $article->content = "This article is about '{$article->name}' and its really great and all";

        return $article;
    }

    /**
     * Get the article
     *
     * @param string $article path
     * @return View view instance
     *
     * @ApiDoc()
     */
    public function getArticleAction($article)
    {
        $data = $this->createArticle($article);

        // using explicit View creation
        $view = new View($data);

        // since we override the default handling for JSON, this will only affect XML
        //$view->setSerializerVersion('2.0');
        //$view->setSerializerGroups(array('data'));
        // via a callback its possible to dynamically set anything on the serializer
        // the following example is essentially the same as $view->setSerializerGroups(array('data'));
        //$view->setSerializerCallback(function ($viewHandler, $serializer) { $serializer->setGroups(array('data')); } );

        $view->setTemplate('AcmeRestBundle:Rest:getArticle.html.twig');

        return $view;
    }

    /**
     * @param Article|null $article
     * @return Form
     */
    protected function getForm(Article $article = null)
    {
        return $this->createForm(new ArticleType(), $article);
    }

    /**
     * Create a new resource
     *
     * @param Request $request
     * @return View view instance
     *
     * @ApiDoc()
     */
    public function postArticlesAction(Request $request)
    {
        $form = $this->getForm();

        $form->handleRequest($request);
        if ($form->isValid()) {
            // Note: normally one would likely create/update something in the database
            // and/or send an email and finally redirect to the newly created or updated resource url
            $view = RouteRedirectView::create('edit_article', array('article' => $form->getData()->name));
        } else {
            $view = View::create($form);
            $view->setTemplate('AcmeRestBundle:Rest:postArticles.html.twig');
        }

        return $view;
    }
}
