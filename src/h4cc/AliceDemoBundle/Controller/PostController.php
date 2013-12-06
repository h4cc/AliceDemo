<?php

namespace h4cc\AliceDemoBundle\Controller;

use h4cc\AliceDemoBundle\Entity\Post;
use h4cc\AliceDemoBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class PostController extends Controller
{
    /**
     * @Route("/user/{id}/posts")
     * @ParamConverter("id", class="h4ccAliceDemoBundle:User")
     * @Template()
     */
    public function listForUserAction(User $user)
    {
        return array('user' => $user, 'posts' => $user->getPosts());
    }

    /**
     * @Route("/post/{id}")
     * @ParamConverter("id", class="h4ccAliceDemoBundle:Post")
     * @Template()
     */
    public function showAction(Post $post)
    {
        return array('post' => $post);
    }
}
