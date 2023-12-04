<?php

namespace App\Bundle\SecurityBundle\Controller;

use App\Bundle\SettingBundle\Controller\Base\BaseAdminController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdministratorController extends BaseAdminController
{
    protected string $baseTemplate = "@BundleSecurity/administrator/";

}