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

        $post->setViewsNumber($post->getViewsNumber() + 1);
        $this->getDoctrine()->getManager()->flush();

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


    public function lastPostsAction($last_posts_limit = 3)
    {
        $repository = $this->getDoctrine()->getRepository('LebedGuestbookBundle:Post');
        $posts = $repository->findLatestPostsLimit($last_posts_limit);

        return $this->render('LebedGuestbookBundle:Post:lastPosts.html.twig', array('posts' => $posts));
    }


    public function mostViewedPostsAction($most_viewed_posts_limit = 5)
    {
        $repository = $this->getDoctrine()->getRepository('LebedGuestbookBundle:Post');
        $posts = $repository->findMostViewedtPosts($most_viewed_posts_limit);

        return $this->render('LebedGuestbookBundle:Post:mostViewedPosts.html.twig', array('posts' => $posts));
    }
}
