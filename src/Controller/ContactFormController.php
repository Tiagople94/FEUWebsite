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
     * @return Response
     * @throws TransportExceptionInterface
     */
    public function receivingForm(Request $request, MailerInterface $mailer) {

        if (!$request->isXmlHttpRequest()) {
            return new Response('Error no HTTP REQUEST', 400);
        }

        //We send an email here.
        $mailBody = $request->request->get('contact_form');
        $this->sendEmail($mailer, $mailBody);
        dump($this->sendEmail($mailer, $mailBody));

        $template = $this->render('contact_form/confirmationContact.html.twig',[
                'responseMailer' => $this->sendEmail($mailer, $mailBody)
        ])->getContent();
        $json = json_encode($template);
        $response = new Response($json, 200);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/contact/sendEmail")
     * @param MailerInterface $mailer
     * @param $mailBody
     * @return bool
     * @throws TransportExceptionInterface
     */
    public function sendEmail(MailerInterface $mailer, array $mailBody)
    {
        $email = (new Email())
            ->from($mailBody['email'])
            ->to('Tiagople94@gmail.com')
            ->subject('Message de Contact')
            ->text('Sending emails is fun again!')
            ->html('<p>$mailBody[\'message\']</p>');

        if(!$mailer->send($email)) {
            return false;
        }

        return true;
    }
}
