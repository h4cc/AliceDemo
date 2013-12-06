<?php

/*
 * This file is part of the h4cc/AliceDemo package.
 *
 * (c) Julius Beckmann <github@h4cc.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace h4cc\AliceDemoBundle\Controller;

use h4cc\AliceDemoBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * Class UserController
 *
 * @author Julius Beckmann <github@h4cc.de>
 */
class UserController extends Controller
{
    /**
     * @Route("/user")
     * @Template()
     */
    public function listAction()
    {
        $users = $this->getDoctrine()->getRepository('h4ccAliceDemoBundle:User')->findAll();

        return array('users' => $users);
    }

    /**
     * @Route("/user/{id}")
     * @ParamConverter("id", class="h4ccAliceDemoBundle:User")
     * @Template()
     */
    public function showAction(User $user)
    {
        return array('user' => $user);
    }
}
