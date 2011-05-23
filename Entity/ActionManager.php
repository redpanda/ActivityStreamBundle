<?php
namespace Bundle\ActivityStreamBundle\Entity;

use Bundle\ActivityStreamBundle\Model\ActionInterface;
use Bundle\ActivityStreamBundle\Model\ActionManager as BaseActionManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Symfony\Component\Security\Core\SecurityContext;

class ActionManager extends BaseActionManager
{
    protected $em;
    protected $class;
    protected $repository;

    public function __construct(EntityManager $em, $class, SecurityContext $securityContext)
    {
        $this->em = $em;
        $this->repository = $em->getRepository($class);

        $metadata = $em->getClassMetadata($class);
        $this->class = $metadata->name;
        
        parent::__construct($securityContext);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getClass()
    {
        return $this->class;
    }
    
    /**
     * {@inheritDoc}
     */
    public function findOneStreamBy(array $criteria)
    {
        $val = $this->repository->findOneBy($criteria);
    }
    
    /**
     * {@inheritDoc}
     */
    public function findStreamBy(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }
}