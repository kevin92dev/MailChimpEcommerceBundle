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

use MailChimpEcommerceBundle\Entities\Product;
use MailChimpEcommerceBundle\Entities\ProductVariant;
use MailChimpEcommerceBundle\Exceptions\ProductNotFoundException;
use MailChimpEcommerceBundle\RequestTypes;

/**
 * ProductService
 *
 * @author Kevin Murillo <kevin92dev@gmail.com>
 */
class ProductService
{
    /**
     * @var MailChimp
     */
    private $mailChimp;

    /**
     * Initializes ProductService
     *
     * @param MailChimp $mailChimp
     */
    public function __construct(MailChimp $mailChimp)
    {
        $this->mailChimp = $mailChimp;
    }

    /**
     * Create a new product in MailChimp
     *
     * @var Product $product
     */
    public function create(Product $product)
    {
        $method = RequestTypes::$POST;
        $resource = '/products';

        $body = [
            'id' => strval($product->getId()),
            'title' => strval($product->getTitle()),
            'handle' => strval($product->getHandle()),
            'url' => strval($product->getUrl()),
            'description' => strval($product->getDescription()),
            'type' => strval($product->getType()),
            'vendor' => strval($product->getVendor()),
            'image_url' => strval($product->getImageUrl())
        ];

        $this->addProductVariants($product, $body);

        $this->mailChimp->doRequest($method, $body, $resource);
    }

    /**
     * Edit a product in MailChimp
     *
     * @var Product $product
     */
    public function edit(Product $product)
    {
        $method = RequestTypes::$PATCH;
        $resource = '/products/'.$product->getId();

        $body = [
            'title' => strval($product->getTitle()),
            'handle' => strval($product->getHandle()),
            'url' => strval($product->getUrl()),
            'description' => strval($product->getDescription()),
            'type' => strval($product->getType()),
            'vendor' => strval($product->getVendor()),
            'image_url' => strval($product->getImageUrl())
        ];

        $this->addProductVariants($product, $body);

        $this->mailChimp->doRequest($method, $body, $resource);
    }

    /**
     * Read products from MailChimp
     *
     * @param Product $product
     * @param int $count
     * @param int $offset
     *
     * @return null|string
     */
    public function read(Product $product = null, $count = 50, $offset = 0)
    {
        $method = RequestTypes::$GET;

        if ($product instanceof Product) {
            $resource = '/products/'.$product->getId();
        } else {
            $resource = '/products';
        }

        $resource .= '?count='.$count.'&offset='.$offset;

        $data = [];

        try {
            $request = $this->mailChimp->doRequest($method, $data, $resource);
        } catch (ProductNotFoundException $e) {
            return null;
        }

        return $request->getBody()->getContents();
    }

    /**
     * Delete product from MailChimp
     *
     * @var Product $product
     */
    public function delete(Product $product)
    {
        $method = RequestTypes::$DELETE;
        $resource = '/products/'.$product->getId();

        $this->mailChimp->doRequest($method, null, $resource);
    }

    /**
     * Add product variants to array
     *
     * @param Product $product
     * @param array   $body
     */
    public function addProductVariants(Product $product, &$body)
    {
        /**
         * @var ProductVariant $productVariant
         */
        foreach ($product->getProductVariants() as $productVariant) {
            $body['variants'][] = [
                'id' => strval($productVariant->getId()),
                'title' => strval($productVariant->getTitle()),
                'url' => strval($productVariant->getUrl()),
                'sku' => strval($productVariant->getSku()),
                'price' => floatval($productVariant->getPrice()),
                'inventory_quantity' => intval($productVariant->getInventoryQuantity()),
                'image_url' => strval($productVariant->getImageUrl()),
                'backorders' => strval($productVariant->getBackorders()),
                'visibility' => strval($productVariant->getVisibility())
            ];
        }
    }
}