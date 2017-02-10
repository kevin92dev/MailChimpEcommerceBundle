<?php

namespace Atresmediahf\MailChimpEcommerceBundle\Entities;

class Order
{
    /**
     * A unique identifier for the order.
     *
     * @var string
     */
    private $id;

    /**
     * Information about a specific customer. This information will update any existing customer.
     * If the customer doesn’t exist in the store, a new customer will be created.
     *
     * @var Customer
     */
    private $customer;

    /**
     * A string that uniquely identifies the campaign for an order.
     *
     * @var string
     */
    private $campaignId;

    /**
     * The URL for the page where the buyer landed when entering the shop.
     *
     * @var string
     */
    private $landingSite;

    /**
     * The order status. For example: refunded, processing, cancelled, etc.
     *
     * @var string
     */
    private $financialStatus;

    /**
     * The fulfillment status for the order. For example: partial, fulfilled, etc.
     *
     * @var string
     */
    private $fulfillmentStatus;

    /**
     * The three-letter ISO 4217 code for the currency that the store accepts.
     *
     * @var string
     */
    private $currencyCode;

    /**
     * The total for the order.
     *
     * @var float
     */
    private $orderTotal;

    /**
     * The tax total for the order.
     *
     * @var float
     */
    private $taxTotal;

    /**
     * The shipping total for the order.
     *
     * @var float
     */
    private $shippingTotal;

    /**
     * The MailChimp tracking code for the order. Uses the ‘mc_tc’ parameter in E-Commerce tracking URLs.
     *
     * @var string
     */
    private $trackingCode;

    /**
     * The date and time the order was processed.
     *
     * @var string
     */
    private $processedAtForeign;

    /**
     * The date and time the order was cancelled.
     *
     * @var string
     */
    private $cancelledAtForeign;

    /**
     * The date and time the order was updated.
     *
     * @var string
     */
    private $updatedAtForeign;

    /**
     * The shipping address for the order.
     *
     * @var Address
     */
    private $shippingAddress;

    /**
     * The billing address for the order.
     *
     * @var Address
     */
    private $billingAddress;

    /**
     * An array of the order’s line items.
     *
     * @var array
     */
    private $orderLines;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Customer
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param Customer $customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    /**
     * @return string
     */
    public function getCampaignId()
    {
        return $this->campaignId;
    }

    /**
     * @param string $campaignId
     */
    public function setCampaignId($campaignId)
    {
        $this->campaignId = $campaignId;
    }

    /**
     * @return string
     */
    public function getLandingSite()
    {
        return $this->landingSite;
    }

    /**
     * @param string $landingSite
     */
    public function setLandingSite($landingSite)
    {
        $this->landingSite = $landingSite;
    }

    /**
     * @return string
     */
    public function getFinancialStatus()
    {
        return $this->financialStatus;
    }

    /**
     * @param string $financialStatus
     */
    public function setFinancialStatus($financialStatus)
    {
        $this->financialStatus = $financialStatus;
    }

    /**
     * @return string
     */
    public function getFulfillmentStatus()
    {
        return $this->fulfillmentStatus;
    }

    /**
     * @param string $fulfillmentStatus
     */
    public function setFulfillmentStatus($fulfillmentStatus)
    {
        $this->fulfillmentStatus = $fulfillmentStatus;
    }

    /**
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * @param string $currencyCode
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;
    }

    /**
     * @return float
     */
    public function getOrderTotal()
    {
        return $this->orderTotal;
    }

    /**
     * @param float $orderTotal
     */
    public function setOrderTotal($orderTotal)
    {
        $this->orderTotal = $orderTotal;
    }

    /**
     * @return float
     */
    public function getTaxTotal()
    {
        return $this->taxTotal;
    }

    /**
     * @param float $taxTotal
     */
    public function setTaxTotal($taxTotal)
    {
        $this->taxTotal = $taxTotal;
    }

    /**
     * @return float
     */
    public function getShippingTotal()
    {
        return $this->shippingTotal;
    }

    /**
     * @param float $shippingTotal
     */
    public function setShippingTotal($shippingTotal)
    {
        $this->shippingTotal = $shippingTotal;
    }

    /**
     * @return string
     */
    public function getTrackingCode()
    {
        return $this->trackingCode;
    }

    /**
     * @param string $trackingCode
     */
    public function setTrackingCode($trackingCode)
    {
        $this->trackingCode = $trackingCode;
    }

    /**
     * @return string
     */
    public function getProcessedAtForeign()
    {
        return $this->processedAtForeign;
    }

    /**
     * @param string $processedAtForeign
     */
    public function setProcessedAtForeign($processedAtForeign)
    {
        $this->processedAtForeign = $processedAtForeign;
    }

    /**
     * @return string
     */
    public function getCancelledAtForeign()
    {
        return $this->cancelledAtForeign;
    }

    /**
     * @param string $cancelledAtForeign
     */
    public function setCancelledAtForeign($cancelledAtForeign)
    {
        $this->cancelledAtForeign = $cancelledAtForeign;
    }

    /**
     * @return string
     */
    public function getUpdatedAtForeign()
    {
        return $this->updatedAtForeign;
    }

    /**
     * @param string $updatedAtForeign
     */
    public function setUpdatedAtForeign($updatedAtForeign)
    {
        $this->updatedAtForeign = $updatedAtForeign;
    }

    /**
     * @return Address
     */
    public function getShippingAddress()
    {
        return $this->shippingAddress;
    }

    /**
     * @param Address $shippingAddress
     */
    public function setShippingAddress($shippingAddress)
    {
        $this->shippingAddress = $shippingAddress;
    }

    /**
     * @return Address
     */
    public function getBillingAddress()
    {
        return $this->billingAddress;
    }

    /**
     * @param Address $billingAddress
     */
    public function setBillingAddress($billingAddress)
    {
        $this->billingAddress = $billingAddress;
    }

    /**
     * @return array
     */
    public function getOrderLines()
    {
        return $this->orderLines;
    }

    /**
     * @param array $orderLines
     */
    public function setOrderLines($orderLines)
    {
        $this->orderLines = $orderLines;
    }
}