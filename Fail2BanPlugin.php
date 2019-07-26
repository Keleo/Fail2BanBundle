<?php

/*
 * This file is part of the Kimai Fail2BanBundle.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace KimaiPlugin\Fail2BanBundle;

use App\Plugin\PluginInterface;

class Fail2BanPlugin implements PluginInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return 'Fail2Ban plugin';
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return __DIR__;
    }
}
