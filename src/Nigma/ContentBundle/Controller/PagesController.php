<?php

namespace Nigma\ContentBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PagesController extends Controller {

    public function dbAction($name) {
        $repository = $this->getDoctrine()
                ->getRepository('NigmaCommonBundle:Page');
        $page = $repository->findOneByName($name);
        if ($page == NULL) {
            throw new NotFoundHttpException("Page not found");
        }
        return $this->render('NigmaContentBundle:Pages:template.html.twig', array(
                    'page' => $page,
                    'description' => $page->getDescription(),
                    'keywords' => $page->getKeywords(),
                    'title' => $page->getTitle(),
                    'ogImage' => $page->getImage()
        ));
    }

    public function staticPageAction($name) {
        return $this->render("NigmaContentBundle:Pages:${name}.html.twig");
    }

}
