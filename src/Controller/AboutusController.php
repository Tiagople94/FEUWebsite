<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AboutusController extends AbstractController
{
    /**
     * @Route("/about", name="aboutus")
     */
    public function index()
    {
        return $this->render('aboutus/aboutus.html.twig', [
            'controller_name' => 'AboutusController',
        ]);
    }
}
