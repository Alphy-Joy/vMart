<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MobileApiController extends AbstractController
{
    /**
     * @Route("/mobile/api", name="app_mobile_api")
     */
    public function index(): Response
    {
        return $this->render('mobile_api/index.html.twig', [
            'controller_name' => 'MobileApiController',
        ]);
    }
}
