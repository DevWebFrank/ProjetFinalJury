<?php

namespace App\Controller;

use App\Form\ContactFormType;
use App\Form\ContactSupportType;
use Symfony\Component\Mime\Email;
use App\Services\Mail\SendPreparedMail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    #public function index(): Response
    #{
    #return $this->render('contact.html.twig', [
    #    'controller_name' => 'ContactController',
    # ]);
    #} 
    public function contactSupport(SendPreparedMail $sendPreparedMail, Request $request)
    {
        $form = $this->createForm(ContactSupportType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contentMessage =  $form->get('contentMessage')->getData();
            $subjectMessage =  $form->get('subjectMessage')->getData();
            $email =  $form->get('email')->getData();

            $sendPreparedMail->sendMailToSupport($email, $contentMessage, $subjectMessage);

            $this->addFlash("success", "Votre mail à bien été envoyé");
            return $this->redirectToRoute("home");
        }

        return $this->render("customer/profile/contact_support.html.twig", [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/customer/contact', name: 'customer_contact')]
    public function index(SendPreparedMail $sendPreparedMail, Request $request)
    {
        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $nom = $form->get('nom')->getData();
            $prenom = $form->get('prenom')->getData();
            $email = $form->get('email')->getData();
            $message = $form->get('message')->getData();

            $sendPreparedMail->sendMailToContact($nom, $prenom, $email, $message);

            $this->addFlash('success', 'Votre message a été envoyé');
            return $this->redirectToRoute('home');
        }

        return $this->render('/customer/contact/indexTop.html.twig', [
            'formContact' => $form->createView()
        ]);
    }
}
