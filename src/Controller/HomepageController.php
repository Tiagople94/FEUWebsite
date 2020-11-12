<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index()
    {
        $contact = new Contact();
        $form = $this->createForm(ContactFormType::class, $contact);

        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
            'contactForm'     => $form->createView(),
        ]);
    }
}
