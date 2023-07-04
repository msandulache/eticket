<?php

namespace App\Controller;

use App\Entity\ContactMessage;
use App\Repository\ContactMessageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, ContactMessageRepository $contactMessageRepository): Response
    {
        $contact = new ContactMessage();

        $form = $this->createFormBuilder($contact)
            ->add('email', TextType::class, array('label'=> 'email','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('subject', TextType::class, array('label'=> 'subject','attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')))
            ->add('message', TextareaType::class, array('label'=> 'message','attr' => array('class' => 'form-control')))
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() &&  $form->isValid()){
            $contact = $form->getData();
            $contactMessageRepository->save($contact, true);

            $this->addFlash('success', 'Your message has been sent successfully.');

            return $this->redirectToRoute('app_contact');
        }

        return $this->renderForm('contact/index.html.twig',
        [
            'form' => $form
        ]);
    }

}
