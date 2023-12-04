<?php

namespace App\Bundle\SettingBundle\Repository;

use App\Bundle\SettingBundle\Entity\SmtpEmail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;use function Symfony\Component\String\u;

/**
 * @extends ServiceEntityRepository<SmtpEmail>
 *
 * @method SmtpEmail|null find($id, $lockMode = null, $lockVersion = null)
 * @method SmtpEmail|null findOneBy(array $criteria, array $orderBy = null)
 * @method SmtpEmail[]    findAll()
 * @method SmtpEmail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SmtpEmail::class);
    }

}
