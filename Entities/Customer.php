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

namespace Kevin92dev\MailChimpEcommerceBundle\Entities;

class Customer
{
    /**
     * A unique identifier for the customer.
     *
     * @var string
     */
    private $id;

    /**
     * The customer’s email address.
     *
     * @var string
     */
    private $email;

    /**
     * The customer’s opt-in status. This value will never overwrite the opt-in status of a pre-existing MailChimp
     * list member, but will apply to list members that are added through the e-commerce API endpoints.
     * Customers who don’t opt in to your MailChimp list will be added as Transactional members.
     *
     * @var bool
     */
    private $optInStatus;

    /**
     * The customer’s company.
     *
     * @var string
     */
    private $company;

    /**
     * The customer’s first name.
     *
     * @var string
     */
    private $firstname;

    /**
     * The customer’s last name.
     *
     * @var string
     */
    private $lastname;

    /**
     * The customer’s total order count.
     *
     * @var integer
     */
    private $ordersCount;

    /**
     * The total amount the customer has spent.
     *
     * @var float
     */
    private $totalSpent;

    /**
     * The customer’s address.
     *
     * @var Address
     */
    private $address;

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
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return bool
     */
    public function isOptInStatus()
    {
        return $this->optInStatus;
    }

    /**
     * @param bool $optInStatus
     */
    public function setOptInStatus($optInStatus)
    {
        $this->optInStatus = $optInStatus;
    }

    /**
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * @param string $company
     */
    public function setCompany($company)
    {
        $this->company = $company;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return int
     */
    public function getOrdersCount()
    {
        return $this->ordersCount;
    }

    /**
     * @param int $ordersCount
     */
    public function setOrdersCount($ordersCount)
    {
        $this->ordersCount = $ordersCount;
    }

    /**
     * @return float
     */
    public function getTotalSpent()
    {
        return $this->totalSpent;
    }

    /**
     * @param float $totalSpent
     */
    public function setTotalSpent($totalSpent)
    {
        $this->totalSpent = $totalSpent;
    }

    /**
     * @return Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param Address $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }
}