<?php

namespace Lebed\GuestbookBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SearcherController extends Controller
{
    public function searchAction(Request $request)
    {
        $searcher=$this->get('searcher');
        $result = $searcher->search($request->get('search'));
        $repository = $this->getDoctrine()->getRepository('LebedGuestbookBundle:Message');
        $query = $repository->createQueryBuilder('m')
            ->where('m.id IN (:ids)')
            ->setParameter('ids', $result)
            ->getQuery();
        $messages = $query->getResult();

        if (!$messages) {
            throw $this->createNotFoundException(
                'No messages found'
            );
        }

        return $this->render('LebedGuestbookBundle:Searcher:search.html.twig', array('messages' => $messages));
    }
}