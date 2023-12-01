<?php

namespace App\Bundle\SecurityBundle\Repository;

use App\Bundle\SecurityBundle\Entity\GroupAdministrator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GroupAdministrator>
 *
 * @method GroupAdministrator|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupAdministrator|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupAdministrator[]    findAll()
 * @method GroupAdministrator[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupAdministratorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GroupAdministrator::class);
    }

}
