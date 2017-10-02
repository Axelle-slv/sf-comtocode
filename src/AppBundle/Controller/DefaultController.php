<?php

namespace AppBundle\Controller;

use AppBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function indexAction() {
        return $this->redirectToRoute('fos_user_security_login');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
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

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function validationAction()
    {
        return $this->render('AppBundle:Default:validation.html.twig');
    }
}
