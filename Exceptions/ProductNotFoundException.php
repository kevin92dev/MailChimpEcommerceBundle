<?php
/*
 * This file is part of the MailChimpEcommerceBundle package.
 *
 * Copyright (c) 2017 kevin92dev.es
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Kevin Murillo <kevin92dev@gmail.com>
 */

namespace Kevin92dev\MailChimpEcommerceBundle\Exceptions;

class ProductNotFoundException extends \Exception
{
    protected $message = 'The requested product does not exist.';
}