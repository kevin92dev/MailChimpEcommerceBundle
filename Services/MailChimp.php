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

use Atresmediahf\MailChimpEcommerceBundle\Exceptions\CustomerNotFoundException;
use Atresmediahf\MailChimpEcommerceBundle\Exceptions\OrderNotFoundException;
use Atresmediahf\MailChimpEcommerceBundle\Exceptions\ProductNotFoundException;
use Atresmediahf\MailChimpEcommerceBundle\RequestTypes;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/**
 * Mailchimp
 *
 * @author Kevin Murillo <kevin92dev@gmail.com>
 */
class MailChimp
{
    /**
     * @var string
     */
    private $apiKey;

    /**
     * @var string
     */
    private $storeId;

    /**
     * @var Client
     */
    private $httpClient;

    /**
     * @var string
     */
    private $endPoint;

    /**
     * Initializes MailChimp
     *
     * @param string $apiKey Mailchimp api key
     * @param string $storeId
     * @param Client $httpClient The HTTP Guzzle Client
     * @param bool   $ssl Enable secure connectionss
     */
    public function __construct($apiKey, $storeId, Client $httpClient, $ssl = true)
    {
        $this->apiKey = $apiKey;
        $this->storeId = $storeId;
        $this->httpClient = $httpClient;

        $key = preg_split("/-/", $this->apiKey);

        if ($ssl) {
            $this->endPoint ='https://'.$key[1].'.api.mailchimp.com/3.0/ecommerce/stores/'.$storeId;
        } else {
            $this->endPoint ='http://'.$key[1].'.api.mailchimp.com/3.0/ecommerce/stores'.$storeId;
        }
    }

    /**
     * MailChimp Requests
     *
     * @param string $method
     * @param array $body
     * @param string $resource
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws CustomerNotFoundException
     * @throws ProductNotFoundException
     * @throws \Exception
     */
    public function doRequest($method, $body, $resource = '')
    {
        $url = $this->endPoint.$resource;

        // Set auth
        $data['auth'] = [
            'user', $this->apiKey
        ];

        // .. and body
        if ($method != RequestTypes::$GET) {
            $data['json'] = $body;
        }

        try {
            return $this->httpClient->request($method, $url, $data);
        } catch (RequestException $e) {
            $statusCode = $e->getResponse()->getStatusCode();

            switch ($statusCode) {
                case 404:
                    if (strpos($resource, 'products') !== false) {
                        throw new ProductNotFoundException();
                    } elseif (strpos($resource, 'customers') !== false) {
                        throw new CustomerNotFoundException();
                    } elseif (strpos($resource, 'orders') !== false) {
                        throw new OrderNotFoundException();
                    }
                    break;
                default:
                    throw new \Exception($e->getResponse()->getBody());
            }
        }
    }
}