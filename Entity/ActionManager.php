<?php
namespace Redpanda\Bundle\ActivityStreamBundle\Entity;

use Redpanda\Bundle\ActivityStreamBundle\Model\ActionInterface;
use Redpanda\Bundle\ActivityStreamBundle\Model\ActionManager as BaseActionManager;
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
        return $this->repository->findOneBy($criteria);
    }
    
    /**
     * {@inheritDoc}
     */
    public function findStreamBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return $this->repository->findBy($criteria, $orderBy, $limit, $offset);
    }

    public function updateAction(ActionInterface $action, $andFlush = true)
    {
        $this->em->persist($action);
        if ($andFlush) {
            $this->em->flush();
        }
    }
}