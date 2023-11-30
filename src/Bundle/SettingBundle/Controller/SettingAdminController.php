<?php

namespace App\Bundle\SettingBundle\Controller;

use App\Bundle\SettingBundle\Controller\Base\BaseAdminController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SettingAdminController extends BaseAdminController
{
    protected string $baseTemplate = "@BundleSetting/setting/";

    /**
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function loginAction(AuthenticationUtils $authenticationUtils): Response
    {
        if($this->getUser())
            return $this->redirectToRoute('sonata_admin_dashboard');

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render($this->baseTemplate . 'auth/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    public function logoutAction(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    /** @return Response */
    public function accessDeniedAction(): Response
    {
        return $this->render($this->baseTemplate . 'error/error_403.html.twig');
    }

}