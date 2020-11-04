<?php

namespace App\Controller;

use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactFormType;

class ContactFormController extends AbstractController
{
    /**
     * @Route("/contact/form", name="contact_form")
     */
    public function index()
    {
        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class, $contact);

        return $this->render('contact_form/index.html.twig', [
            'controller_name' => 'ContactFormController',
            'contactForm'     => $form->createView()
        ]);
    }
}
