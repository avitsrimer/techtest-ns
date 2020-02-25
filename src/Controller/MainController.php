<?php

namespace App\Controller;

use App\Entity\Tree as TreeEntity;
use App\Repository\TreeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="base")
     */
    public function index(): Response
    {
        $nodes = $this->getTreeRepo()->getArrayRootNodes();

        return $this->render('main/index.html.twig', ['nodes' => $nodes]);
    }

    private function getTreeRepo(): TreeRepository
    {
        $entityManager = $this->getDoctrine()->getManager();
        return $entityManager->getRepository(TreeEntity::class);
    }
}
