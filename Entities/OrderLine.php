<?php

namespace Atresmediahf\MailChimpEcommerceBundle\Entities;

class OrderLine
{
    /**
     * A unique identifier for the order line item.
     *
     * @var string
     */
    private $id;

    /**
     * A unique identifier for the product associated with the order line item.
     *
     * @var Product
     */
    private $product;

    /**
     * A unique identifier for the product variant associated with the order line item.
     *
     * @var ProductVariant
     */
    private $productVariant;

    /**
     * The quantity of an order line item.
     *
     * @var integer
     */
    private $quantity;

    /**
     * The price of an order line item.
     *
     * @var float
     */
    private $price;

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
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct($product)
    {
        $this->product = $product;
    }

    /**
     * @return ProductVariant
     */
    public function getProductVariant()
    {
        return $this->productVariant;
    }

    /**
     * @param ProductVariant $productVariant
     */
    public function setProductVariant($productVariant)
    {
        $this->productVariant = $productVariant;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }
}