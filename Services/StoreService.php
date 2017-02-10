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

namespace MailChimpEcommerceBundle\Services;

use MailChimpEcommerceBundle\Entities\Store;
use MailChimpEcommerceBundle\RequestTypes;
use MailChimpEcommerceBundle\Services\MailChimp;

/**
 * StoreService
 *
 * @author Kevin Murillo <kevin92dev@gmail.com>
 */
class StoreService
{
    /**
     * @var MailChimp
     */
    private $mailChimp;

    /**
     * Initializes Store
     *
     * @param MailChimp $mailChimp
     */
    public function __construct(MailChimp $mailChimp)
    {
        $this->mailChimp = $mailChimp;
    }

    /**
     * Create a new Store in MailChimp
     *
     * @var Store $store
     */
    public function create($store)
    {
        $method = RequestTypes::$POST;

        $data = [
            'id'            => $store->getId(),
            'list_id'       => $store->getListId(),
            'name'          => $store->getName(),
            'domain'        => $store->getDomain(),
            'email_address' => $store->getEmailAddress(),
            'currency_code' => $store->getCurrencyCode()
        ];

        $this->mailChimp->doRequest($method, json_encode($data));
    }
}