<?php

namespace App\Controller;

use App\Entity\Tree as TreeEntity;
use App\Repository\TreeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/tree")
 */
class TreeController extends AbstractController
{
    /**
     * @Route("/index", name="tree_index")
     */
    public function index(): Response
    {
        $options = array(
            'decorate' => true,
            'html' => true
        );
        $arrayTree = $this->getTreeRepo()->childrenHierarchy(null, false, $options);
        
        return $this->render('tree/index.html.twig', [
            'arrayTree' => $arrayTree,
        ]);
    }

    /**
     * @Route("/ajax/{id}", name="tree_ajax")
     */
    public function ajax($id): Response
    {
        $childs = $this->getTreeRepo()->getArrayOfChildsById($id);
        return $this->render('tree/ajax.html.twig', [
            'nodes' => $childs,
        ]);
    }

    private function getTreeRepo(): TreeRepository
    {
        $entityManager = $this->getDoctrine()->getManager();
        return $entityManager->getRepository(TreeEntity::class);
    }
}
