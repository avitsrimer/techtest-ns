<?php

namespace App\Controller;

use App\Repository\TreeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TreeController extends AbstractController
{
    /**
     * @Route("/tree/index", name="tree")
     */
    public function index(TreeRepository $repo): Response
    {
        $arrayTree = $repo->childrenHierarchy(
            null, /* starting from root nodes */
            false, /* true: load all children, false: only direct */
            array(
                'decorate' => true,
                'representationField' => 'slug',
                'html' => true
            ));
        
        return $this->render('tree/index.html.twig', [
            'arrayTree' => $arrayTree,
        ]);
    }

    /**
     * @Route("/tree/ajax", name="tree-ajax")
     */
    public function ajax(): JsonResponse
    {
        return new JsonResponse(['data' => []]);
    }
}
