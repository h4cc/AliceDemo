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

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SeleniumController
 *
 * @author Julius Beckmann <github@h4cc.de>
 */
class SeleniumController extends Controller
{
    /**
     * Loading a set of fixtures.
     *
     * @Route("/_selenium/load_fixtures")
     */
    public function loadFixturesAction()
    {
        /** @var \h4cc\AliceFixturesBundle\Fixtures\FixtureManagerInterface $manager */
        $manager = $this->get('h4cc_alice_fixtures.manager');

        // Configure the needed fixture set and load it.
        $set = $manager->createFixtureSet();
        $set->addFile(__DIR__ . '/../DataFixtures/Alice/selenium.yml', 'yaml');
        $set->setDoDrop(true);
        $set->setDoPersist(true);
        $set->setSeed(1337 + 42);

        $manager->load($set);

        return new Response('success');
    }
}
