<?php

namespace AppBundle\Controller;

use AppBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function loginAction()
    {
        return $this->render('AppBundle:Default:index.html.twig');
    }

    public function contactAction(Request $request)
    {
        $contactForm =  $this->createForm(ContactType::class);
        $contactForm->handleRequest($request);

        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $formData = $contactForm->getData();
            $lastName = $formData['lastName'];
            $firstName = $formData['firstName'];
            $email = $formData['email'];
            $phoneNumber = $formData['phoneNumber'];
            $message = $formData['message'];
            $to = $this->container->getParameter('mail_contact');
            $this->get('mailer.service')->sendContactMail($to, $lastName, $firstName, $email, $phoneNumber, $message);

            return $this->redirectToRoute('app_validation');
        }

        return $this->render('AppBundle:Default:contact.html.twig', [
            'contactForm' => $contactForm->createView(),
        ]);
    }
}
