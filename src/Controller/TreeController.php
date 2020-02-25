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
        $repo = $this->getTreeRepo();

        $options = array(
            'decorate' => true,
            'representationField' => 'slug',
            'html' => true
        );
        $arrayTree = $repo->childrenHierarchy(null, false, $options);
        
        return $this->render('tree/index.html.twig', [
            'arrayTree' => $arrayTree,
        ]);
    }

    /**
     * @Route("/ajax", name="tree_ajax")
     */
    public function ajax(): JsonResponse
    {
        return new JsonResponse(['data' => []]);
    }

    private function getTreeRepo(): TreeRepository
    {
        $entityManager = $this->getDoctrine()->getManager();
        return $entityManager->getRepository(TreeEntity::class);
    }
}
