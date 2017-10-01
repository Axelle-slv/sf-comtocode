<?php
/**
 * Created by PhpStorm.
 * User: axelle
 * Date: 01/10/17
 * Time: 15:00
 */

namespace AppBundle\Services;


use Swift_Mailer;
use Symfony\Component\Templating\EngineInterface;

class MailerService
{
    /** @var Swift_Mailer */
    protected $mailer;

    /** @var EngineInterface */
    protected $templating;


    /**
     * MailerService constructor
     * @param Swift_Mailer $mailer
     * @param EngineInterface $templating
     */
    public function __construct(Swift_Mailer $mailer, EngineInterface $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    /**
     * @param $to
     * @param $subject
     * @param $body
     */
    protected function sendMessage($to, $subject, $body)
    {
        $mail = \Swift_Message::newInstance();
        $mail
            ->setTo($to)
            ->setSubject($subject)
            ->setBody($body)
            ->setContentType('text/html');
        $this->mailer->send($mail);
    }

    /**
     * @param $to
     * @param $firstName
     * @param $lastName
     * @param $email
     * @param $phoneNumber
     * @param $message
     */
    public function sendContactMail($to, $firstName, $lastName, $email, $phoneNumber, $message)
    {
        $template = 'Emails/contact.html.twig';
        $subject = 'Nouvelle demande de contact';
        $body = $this->templating->render($template, [
            'firstName'     => $firstName,
            'lastName'      => $lastName,
            'email'         => $email,
            'phoneNumber'   => $phoneNumber,
            'message'       => $message,
        ]);

        $this->sendMessage($to, $subject, $body);
    }



}