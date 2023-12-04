<?php

namespace App\Bundle\SettingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SettingController extends AbstractController
{
    #[Route('/', name: 'app_setting')]
    public function index(): Response
    {
        return $this->redirectToRoute('sonata_admin_dashboard');
    }
}
