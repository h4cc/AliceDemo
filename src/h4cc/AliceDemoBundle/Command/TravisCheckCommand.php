<?php

/*
 * This file is part of the h4cc/AliceDemo package.
 *
 * (c) Julius Beckmann <github@h4cc.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace h4cc\AliceDemoBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TravisCheckCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('h4cc_alice_demo:travis:check')
            ->setDescription('Checks for created fixtures on travis.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->checkDoctrineORMFixtures();
        $this->checkMongoDBODMFixtures();
    }

    private function checkDoctrineORMFixtures()
    {
        /** @var \Doctrine\DBAL\Connection $doctrine */
        $doctrine = $this->getContainer()->get('doctrine.dbal.default_connection');

        $customers = $doctrine->fetchAll('SELECT * FROM Customer');
        $this->checkCustomers($customers);

        $users = $doctrine->fetchAll('SELECT * FROM User');
        $this->checkUsers($users);

        $posts = $doctrine->fetchAll('SELECT * FROM Post');
        $this->checkPosts($posts);
    }

    private function checkCustomers(array $customers)
    {
        if (5 !== count($customers)) {
            trigger_error('Invalid Number of Customers.', E_USER_ERROR);
        }

        $expectedId = 1;
        foreach ($customers as $customer) {
            if ($expectedId != $customer['id']) {
                trigger_error('Invalid Id for Customer.', E_USER_ERROR);
            }
            $expectedId++;
        }
    }

    private function checkUsers(array $users)
    {
        if (14 !== count($users)) {
            trigger_error('Invalid Number of Users.', E_USER_ERROR);
        }

        $expectedId = 1;
        foreach ($users as $customer) {
            if ($expectedId != $customer['id']) {
                trigger_error('Invalid Id for User.', E_USER_ERROR);
            }
            $expectedId++;
        }
    }

    private function checkPosts($posts)
    {
        if (100 !== count($posts)) {
            trigger_error('Invalid Number of Posts.', E_USER_ERROR);
        }

        $expectedId = 1;
        foreach ($posts as $post) {
            if ($expectedId != $post['id']) {
                trigger_error('Invalid Id for Post.', E_USER_ERROR);
            }
            $expectedId++;
        }
    }

    private function checkMongoDBODMFixtures()
    {
        $productsRepository = $this->getContainer()->get('doctrine_mongodb')->getManager()->getRepository('h4ccAliceDemoBundle:Product');

        $products = $productsRepository->findAll();
        if (100 !== count($products)) {
            trigger_error('Invalid Number of Products.', E_USER_ERROR);
        }
    }
} 