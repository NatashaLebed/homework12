<?php

namespace Lebed\GuestbookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Lebed\GuestbookBundle\Entity\Message;
use Lebed\GuestbookBundle\Form\Type\MessageType;

class MessageController extends Controller
{
    public  function viewMessagesAction(Request $request)
    {
        $message = new Message();

        $form = $this->createForm(new MessageType(), $message);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($message);
            $em->flush();

            return $this->redirect($this->generateUrl('lebed_guestbook_viewMessages'));
        }

        $messages = $this->getDoctrine()->getRepository('LebedGuestbookBundle:Message')
            ->findAll();

        if (!$messages) {
            throw $this->createNotFoundException('No messages found');
        }

        return $this->render('LebedGuestbookBundle:Message:viewMessages.html.twig',
            array('messages' => $messages, 'form' => $form->createView(),));
    }
}