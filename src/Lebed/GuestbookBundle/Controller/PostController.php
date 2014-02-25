<?php

namespace Lebed\GuestbookBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PostController extends Controller
{
    public function indexAction()
    {
        $posts = $this->getDoctrine()->getRepository('LebedGuestbookBundle:Post')
            ->findAll();

        if (!$posts) {
            throw $this->createNotFoundException('No posts found');
        }

        return $this->render('LebedGuestbookBundle:Post:index.html.twig', array('posts'=>$posts));
    }


    public function showAction($slug)
    {
        $post = $this->getDoctrine()->getRepository('LebedGuestbookBundle:Post')
            ->findOneBySlug($slug);

        return $this->render('LebedGuestbookBundle:Post:show.html.twig', array('post'=>$post));
    }


    public function viewPostsOfCategoryAction($id)
    {
        $posts = $this->getDoctrine()->getRepository('LebedGuestbookBundle:Post')
            ->findByCategory($id);

        if (!$posts) {
            throw $this->createNotFoundException('No posts found');
        }

        return $this->render('LebedGuestbookBundle:Post:index.html.twig', array('posts'=>$posts));
    }


    public function lastPostsAction($limit = 3)
    {
        $repository = $this->getDoctrine()->getRepository('LebedGuestbookBundle:Post');
        $posts = $repository->findLatestPostsLimit($limit);

        return $this->render('LebedGuestbookBundle::lastPosts.html.twig', array('posts' => $posts));
    }
}
