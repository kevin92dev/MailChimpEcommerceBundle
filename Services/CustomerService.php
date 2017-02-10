<?php
/*
 * This file is part of the Mascoteros package.
 *
 * Copyright (c) 2016-2017 Mascoteros.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * Feel free to edit as you please, and have fun.
 *
 * @author Kevin Murillo <kevin92dev@gmail.com>
 */

namespace Atresmediahf\MailChimpEcommerceBundle\Services;

use Atresmediahf\MailChimpEcommerceBundle\Entities\Customer;
use Atresmediahf\MailChimpEcommerceBundle\Entities\Address;
use Atresmediahf\MailChimpEcommerceBundle\Exceptions\CustomerNotFoundException;
use Atresmediahf\MailChimpEcommerceBundle\RequestTypes;

/**
 * CustomerService
 *
 * @author Kevin Murillo <kevin92dev@gmail.com>
 */
class CustomerService
{
    /**
     * @var MailChimp
     */
    private $mailChimp;

    /**
     * Initializes CustomerService
     *
     * @param MailChimp $mailChimp
     */
    public function __construct(MailChimp $mailChimp)
    {
        $this->mailChimp = $mailChimp;
    }

    /**
     * Create a new customer in MailChimp
     *
     * @var Customer $customer
     */
    public function create(Customer $customer)
    {
        $method = RequestTypes::$POST;
        $resource = '/customers';

        $body = [
            'id' => strval($customer->getId()),
            'email_address' => strval($customer->getEmail()),
            'opt_in_status' => boolval($customer->isOptInStatus()),
            'company' => strval($customer->getCompany()),
            'first_name' => strval($customer->getFirstname()),
            'last_name' => strval($customer->getLastname()),
            'orders_count' => intval($customer->getOrdersCount()),
            'total_spent' => floatval($customer->getTotalSpent()),
        ];

        if ($customer->getAddress() instanceof Address) {
            $this->addAddress($customer, $body);
        }

        $this->mailChimp->doRequest($method, $body, $resource);
    }

    /**
     * Edit a customer in MailChimp
     *
     * @var Customer $customer
     */
    public function edit(Customer $customer)
    {
        $method = RequestTypes::$PATCH;
        $resource = '/customers/'.$customer->getId();

        $body = [
            'opt_in_status' => boolval($customer->isOptInStatus()),
            'company' => strval($customer->getCompany()),
            'first_name' => strval($customer->getFirstname()),
            'last_name' => strval($customer->getLastname()),
            'orders_count' => intval($customer->getOrdersCount()),
            'total_spent' => floatval($customer->getTotalSpent())
        ];

        if ($customer->getAddress() instanceof Address) {
            $this->addAddress($customer, $body);
        }

        $this->mailChimp->doRequest($method, $body, $resource);
    }

    /**
     * Read customers from MailChimp
     *
     * @param Customer $customer
     * @param int $count
     * @param int $offset
     *
     * @return null|string
     */
    public function read(Customer $customer = null, $count = 50, $offset = 0)
    {
        $method = RequestTypes::$GET;

        if ($customer instanceof Customer) {
            $resource = '/customers/'.$customer->getId();
        } else {
            $resource = '/customers';
        }

        $resource .= '?count='.$count.'&offset='.$offset;

        $data = [];

        try {
            $request = $this->mailChimp->doRequest($method, $data, $resource);
        } catch (CustomerNotFoundException $e) {
            return null;
        }

        return $request->getBody()->getContents();
    }

    /**
     * Delete a customer from MailChimp
     *
     * @var Customer $customer
     */
    public function delete(Customer $customer)
    {
        $method = RequestTypes::$DELETE;
        $resource = '/customers/'.$customer->getId();

        $this->mailChimp->doRequest($method, null, $resource);
    }

    /**
     * Add address to a customer
     *
     * @param Customer $customer
     * @param array    $body
     */
    public function addAddress(Customer $customer, &$body)
    {
        $address = $customer->getAddress();

        $body['address'] = [
            'address1' => strval($address->getAddress1()),
            'address2' => strval($address->getAddress2()),
            'city' => strval($address->getCity()),
            'province' => strval($address->getProvince()),
            'province_code' => strval($address->getProvinceCode()),
            'postal_code' => strval($address->getPostalCode()),
            'country' => strval($address->getCountry()),
            'country_code' => strval($address->getCountryCode())
        ];
    }
}