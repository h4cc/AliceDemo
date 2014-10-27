<?php

/*
 * This file is part of the h4cc/AliceDemo package.
 *
 * (c) Julius Beckmann <github@h4cc.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace h4cc\AliceDemoBundle\DataFixtures\Alice\Provider;

/**
 * Class CategoryProvider
 *
 * @author Julius Beckmann <github@h4cc.de>
 */
class CategoryProvider
{
    /**
     * Returning a random category name.
     *
     * @return string
     */
    public function categoryName() {
        $categories = array(
            'Fantasy',
            'Technology',
            'Thriller',
            'Documentation',
        );

        return $categories[array_rand($categories)];
    }
}
 