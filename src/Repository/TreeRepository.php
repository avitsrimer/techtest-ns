<?php

namespace App\Repository;

use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

class TreeRepository extends NestedTreeRepository
{
    public function getArrayRootNodes()
    {
        return $this->getRootNodesQuery()->getArrayResult();
    }

    public function getArrayOfChildsById($id)
    {
        return $this->getChildrenQuery($this->find($id), true)->getArrayResult();
    }
    
}
