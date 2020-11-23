<?php

namespace App\Controller;

use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ContactFormType;

class ContactFormController extends AbstractController
{
    /**
     * @Route("/contact/form", name="contact_form", methods={"GET","POST"})
     */
    public function index(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(
            ContactFormType::class, 
            $contact,
            ['action' => $this->generateUrl('contact_form')]
        );

      

        return $this->render('contact_form/index.html.twig', [
            'controller_name' => 'ContactFormController',
            'contactForm'     => $form->createView()
        ]);
    }

    /**
     * @Route("/contact/formSent", name="send_email", methods={"GET","POST"})
     */
    public function sendEmail(Request $request) {

        if ($request->isXmlHttpRequest()) {
            return $this->json(['code' => 200, 'message' => $request->request->get('contact_form')],200);
        }
       return dump($request->request);
    }
}
