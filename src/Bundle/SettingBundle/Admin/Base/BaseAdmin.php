<?php

namespace App\Bundle\SettingBundle\Admin\Base;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Route\RouteCollectionInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

class BaseAdmin extends AbstractAdmin
{
    protected UserPasswordHasherInterface $passwordHasher;
    protected ?UserInterface $user = null;

    public function __construct(
        UserPasswordHasherInterface $passwordHasher,
        Security $security,
        ContainerBagInterface $containerInterface,
    )
    {
        parent::__construct();

        /** Não Remove chamada */
        //$this->removeAclCacheSonataAdmin($containerInterface->get('kernel.project_dir'));

        $this->user = $security->getUser();
        $this->passwordHasher = $passwordHasher;
    }

    protected function configureRoutes(RouteCollectionInterface $collection): void
    {
        //parent::configureRoutes($collection);

        /** Não Remove chamada - Faz controle de acesso painel admin */
       // $this->removeRoutesByPermission($this->getBaseControllerName(), $collection);
    }

}