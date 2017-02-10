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

namespace MailChimpEcommerceBundle\Entities;

class Address
{
    /**
     * The mailing address of the customer.
     *
     * @var string
     */
    private $address1;

    /**
     * An additional field for the customer’s mailing address.
     *
     * @var string
     */
    private $address2;

    /**
     * The city the customer is located in.
     *
     * @var string
     */
    private $city;

    /**
     * The customer’s state name or normalized province.
     *
     * @var string
     */
    private $province;

    /**
     * The two-letter code for the customer’s province or state.
     *
     * @var string
     */
    private $provinceCode;

    /**
     * The customer’s postal or zip code.
     *
     * @var string
     */
    private $postalCode;

    /**
     * The customer’s country.
     *
     * @var string
     */
    private $country;

    /**
     * The two-letter code for the customer’s country.
     *
     * @var string
     */
    private $countryCode;

    /**
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * @param string $address1
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;
    }

    /**
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * @param string $address2
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getProvince()
    {
        return $this->province;
    }

    /**
     * @param string $province
     */
    public function setProvince($province)
    {
        $this->province = $province;
    }

    /**
     * @return string
     */
    public function getProvinceCode()
    {
        return $this->provinceCode;
    }

    /**
     * @param string $provinceCode
     */
    public function setProvinceCode($provinceCode)
    {
        $this->provinceCode = $provinceCode;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }
}