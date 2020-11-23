<?php

namespace App\Controller;

use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ContactFormType;
use Symfony\Component\Routing\Annotation\Route;

class ContactFormController extends AbstractController
{
    /**
     * @Route("/contact/form", name="contact_form")
     * @return Response
     */
    public function index()
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
     * @Route("/contact/formSent", name="form_received", methods={"GET","POST"})
     * @param Request $request
     * @param MailerInterface $mailer
     * @return array|JsonResponse
     * @throws TransportExceptionInterface
     */
    public function receivingForm(Request $request, MailerInterface $mailer) {

        if (!$request->isXmlHttpRequest()) {
            return dump($request->request);
        }
        //We send an email here.
        $this->sendEmail($mailer);

        return $this->json(['code' => 200, 'message' => $request->request->get('contact_form')],200);
    }

    /**
     * @Route("/contact/sendEmail")
     * @param MailerInterface $mailer
     * @return bool
     * @throws TransportExceptionInterface
     */
    public function sendEmail(MailerInterface $mailer)
    {
        $email = (new Email())
            ->from('tiagople94@gmail.com')
            ->to('tiagople9asdasdasdas4@gmail.com')
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        if(!$mailer->send($email)) {
            return false;
        }

        return true;
    }
}
