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

namespace Kevin92dev\MailChimpEcommerceBundle\Services;

use Kevin92dev\MailChimpEcommerceBundle\Entities\Address;
use Kevin92dev\MailChimpEcommerceBundle\Entities\Customer;
use Kevin92dev\MailChimpEcommerceBundle\Entities\Order;
use Kevin92dev\MailChimpEcommerceBundle\Entities\OrderLine;
use Kevin92dev\MailChimpEcommerceBundle\Exceptions\OrderNotFoundException;
use Kevin92dev\MailChimpEcommerceBundle\RequestTypes;

/**
 * OrderService
 *
 * @author Kevin Murillo <kevin92dev@gmail.com>
 */
class OrderService
{
    /**
     * @var MailChimp
     */
    private $mailChimp;

    /**
     * @var array
     */
    private $body;

    /**
     * Initializes OrderService
     *
     * @param MailChimp $mailChimp
     */
    public function __construct(MailChimp $mailChimp)
    {
        $this->mailChimp = $mailChimp;
    }

    /**
     * Create a new order in MailChimp
     *
     * @var Order $order
     * @throws \Exception
     */
    public function create(Order $order)
    {
        $method = RequestTypes::$POST;
        $resource = '/orders';

        $this->generateBody($order);
        $this->addCustomer($order);
        $this->addAddress($order->getCustomer(), $order->getShippingAddress(), 'shipping_address');
        $this->addAddress($order->getCustomer(), $order->getBillingAddress(), 'billing_address');
        $this->addOrderLines($order);

        try {
            $this->mailChimp->doRequest($method, $this->body, $resource);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Edit an order in MailChimp
     *
     * @var Order $order
     * @throws \Exception
     */
    public function edit(Order $order)
    {
        $method = RequestTypes::$PATCH;
        $resource = '/orders/'.$order->getId();

        $this->generateBody($order, false);
        $this->addCustomer($order);
        $this->addAddress($order->getCustomer(), $order->getShippingAddress(), 'shipping_address');
        $this->addAddress($order->getCustomer(), $order->getBillingAddress(), 'billing_address');
        $this->addOrderLines($order);

        try {
            $this->mailChimp->doRequest($method, $this->body, $resource);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Read orders from MailChimp
     *
     * @param Order $order
     * @param int $count
     * @param int $offset
     *
     * @return string
     * @throws OrderNotFoundException|\Exception
     */
    public function read(Order $order = null, $count = 50, $offset = 0)
    {
        $method = RequestTypes::$GET;

        if ($order instanceof Order) {
            $resource = '/orders/'.$order->getId();
        } else {
            $resource = '/orders';
        }

        $resource .= '?count='.$count.'&offset='.$offset;

        $data = [];

        try {
            $request = $this->mailChimp->doRequest($method, $data, $resource);
        } catch (OrderNotFoundException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw $e;
        }

        return $request->getBody()->getContents();
    }

    /**
     * Delete order from MailChimp
     *
     * @var Order $order
     */
    public function delete(Order $order)
    {
        $method = RequestTypes::$DELETE;
        $resource = '/orders/'.$order->getId();

        $this->mailChimp->doRequest($method, null, $resource);
    }

    /**
     * Generate body array
     *
     * @param  Order $order
     * @param  bool  $addId
     */
    public function generateBody(Order $order, $addId = true)
    {
        $this->body = [
            'landing_site' => strval($order->getLandingSite()),
            'financial_status' => strval($order->getFinancialStatus()),
            'fulfillment_status' => strval($order->getFulfillmentStatus()),
            'currency_code' => strval($order->getCurrencyCode()),
            'order_total' => floatval($order->getOrderTotal()),
            'tax_total' => floatval($order->getTaxTotal()),
            'shipping_total' => floatval($order->getShippingTotal()),
            'tracking_code' => strval($order->getTrackingCode()),
            'processed_at_foreign' => strval($order->getProcessedAtForeign()),
            'cancelled_at_foreign' => strval($order->getCancelledAtForeign()),
            'updated_at_foreign' => strval($order->getUpdatedAtForeign()),
        ];

        if ($addId === true) {
            $this->body['id'] = strval($order->getId());
        }

        if (!is_null($order->getCampaignId())) {
            $this->body['campaign_id'] = strval($order->getCampaignId());
        }
    }

    /**
     * Add customer to array
     *
     * @param Order $order
     */
    public function addCustomer(Order $order)
    {
        $customer = $order->getCustomer();

        $this->body['customer'] = [
            'id' => strval($customer->getId()),
            'email_address' => strval($customer->getEmail()),
            'opt_in_status' => boolval($customer->isOptInStatus()),
            'company' => strval($customer->getCompany()),
            'first_name' => strval($customer->getFirstname()),
            'last_name' => strval($customer->getLastname()),
            'orders_count' => intval($customer->getOrdersCount()),
            'total_spent' => floatval($customer->getTotalSpent()),
        ];

        $this->addCustomerAddress($customer);
    }

    /**
     * Add address to a array
     *
     * @param Customer $customer
     * @param Address  $address
     * @param string   $type
     */
    public function addAddress(Customer $customer, Address $address, $type)
    {
        $this->body[$type] = [
            'name' => $type.' address for '.$customer->getEmail(),
            'address1' => strval($address->getAddress1()),
            'address2' => strval($address->getAddress2()),
            'city' => strval($address->getCity()),
            'province' => strval($address->getProvince()),
            'province_code' => strval($address->getProvinceCode()),
            'postal_code' => strval($address->getPostalCode()),
            'country' => strval($address->getCountry()),
            'country_code' => strval($address->getCountryCode()),
        ];
    }

    /**
     * Add address to a customer
     *
     * @param Customer $customer
     */
    public function addCustomerAddress(Customer $customer)
    {
        $address = $customer->getAddress();

        $this->body['customer']['address'] = [
            'address1' => strval($address->getAddress1()),
            'address2' => strval($address->getAddress2()),
            'city' => strval($address->getCity()),
            'province' => strval($address->getProvince()),
            'province_code' => strval($address->getProvinceCode()),
            'postal_code' => strval($address->getPostalCode()),
            'country' => strval($address->getCountry()),
            'country_code' => strval($address->getCountryCode()),
        ];
    }

    /**
     * Add order lines to array
     *
     * @param Order $order
     */
    public function addOrderLines(Order $order)
    {
        /**
         * @var OrderLine $orderLine
         */
        foreach ($order->getOrderLines() as $orderLine) {
            $this->body['lines'][] = [
                'id' => strval($orderLine->getId()),
                'product_id' => strval($orderLine->getProduct()->getId()),
                'product_variant_id' => strval($orderLine->getProductVariant()->getId()),
                'quantity' => intval($orderLine->getQuantity()),
                'price' => floatval($orderLine->getPrice()),
            ];
        }
    }
}
