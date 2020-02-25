<?php

namespace App\DataFixtures;

use App\Entity\Tree as TreeEntity;
use App\Repository\TreeRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private TreeRepository $treeRepo;
    private ObjectManager $manager;
    private const MAX_LEVEL = 3;

    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->treeRepo = $manager->getRepository(TreeEntity::class);
        $this->loadTree();
    }

    private function loadTree()
    {
        $root = new TreeEntity();
        $root->setTitle($this->getTitleByLevelAndPosition(0, 0));
        $this->treeRepo->persistAsFirstChild($root);
        $this->manager->flush();
        $this->addChilders($root, true);
    }

    private function addChilders(&$parent, $isFirst = false)
    {
        $curLevel = $parent->getLevel() + 1;
        if ($curLevel > self::MAX_LEVEL) {
            return;
        }

        $nodesCount = $isFirst ? 3 : rand(0, 3);
        for ($i = 0; $i <= $nodesCount; $i++) {
            $node = new TreeEntity();
            $node->setTitle($this->getTitleByLevelAndPosition($curLevel, $i));
            $node->setParent($parent);
            $this->treeRepo->persistAsLastChildOf($node, $parent);
            $this->manager->flush();
            $this->addChilders($node);
        }

    }

    private function getTitleByLevelAndPosition($level, $position)
    {
        $result = 'Title of node';
        for ($i = 0; $i < $level; $i++) {
            $result .= "_$i";
        }
        return $result .= "_$position";
    }
}
