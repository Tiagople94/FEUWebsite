<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }

    /**
     * @Route("/changeLocale/{local}", name="change_locale")
     * @param $local
     * @param Request $request
     * @return Response
     */
    public function changeLocale($local, Request $request)
    {
        $request->getSession()->set('_locale', $local);

        return $this->redirect($request->headers->get('referer'));
    }
}
