<?php

namespace App\Controller;

use App\Entity\Tree as TreeEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class TreeController extends AbstractController
{
    /**
     * @Route("/tree/index", name="tree")
     */
    public function index()
    {
        $repo = $this->getDoctrine()->getManager()->getRepository(TreeEntity::class);
        $arrayTree = $repo->childrenHierarchy(
            null, /* starting from root nodes */
            false, /* true: load all children, false: only direct */
            array(
                'decorate' => true,
                'representationField' => 'slug',
                'html' => true
            ));
        dump($arrayTree);
        return $this->render('tree/index.html.twig', [
            'arrayTree' => $arrayTree,
        ]);
    }

    /**
     * @Route("/tree/ajax", name="tree-ajax")
     */
    public function ajax()
    {
        return new JsonResponse(['data' => []]);
    }
}
