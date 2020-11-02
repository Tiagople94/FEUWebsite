<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ContactFormController extends AbstractController
{
    /**
     * @Route("/contact/form", name="contact_form")
     */
    public function index(Request $request)
    {
        $form = $this->createFormBuilder()
                     ->add('email')
                     ->add('nom')
                     ->add('contenuMsg')
                     ->getForm();
            return $this->render('contact_form/index.html.twig', [
            'controller_name' => 'ContactFormController',
                'contactForm' => $form->createView(),
        ]);
    }
}
