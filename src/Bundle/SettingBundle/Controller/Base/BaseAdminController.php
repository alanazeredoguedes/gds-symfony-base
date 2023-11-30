<?php

namespace App\Bundle\SettingBundle\Controller\Base;

use Doctrine\Persistence\ManagerRegistry;
use Sonata\AdminBundle\Controller\CRUDController;

class BaseAdminController extends CRUDController
{

    public function __construct(
        protected ManagerRegistry $managerRegistry,
    )
    {}





}