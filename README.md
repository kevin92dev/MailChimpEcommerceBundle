# MailChimpEcommerceBundle

[![Build Status](https://scrutinizer-ci.com/g/kevin92dev/MailChimpEcommerceBundle/badges/build.png?b=master)](https://scrutinizer-ci.com/g/kevin92dev/MailChimpEcommerceBundle/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/kevin92dev/MailChimpEcommerceBundle/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/kevin92dev/MailChimpEcommerceBundle/?branch=master)

## About ##

This bundle integrates [MailChimp E-commerce Stores](http://developer.mailchimp.com/documentation/mailchimp/reference/ecommerce/stores/) into your Symfony 2 application.

## Requirements ##

This bundle use [Guzzle](https://github.com/guzzle/guzzle) for perform MailChimp requests. You need to add the 
`guzzlehttp/guzzle` package to your `composer.json` file.

``` bash
$ composer require guzzlehttp/guzzle
```

## Installation ##

Add the `kevin92dev/mailchimp-ecommerce-bundle` package to your `require` section in the `composer.json` file.

``` bash
$ composer require kevin92dev/mailchimp-ecommerce-bundle
```

Add the MailChimpEcommerceBundle to your application's kernel:

``` php
<?php
public function registerBundles()
{
    $bundles = array(
        // ...
        new Kevin92dev\MailChimpEcommerceBundle\MailChimpEcommerceBundle(),
        // ...
    );
    ...
}
```

## Configuration ##

Configure the `MailChimp E-commerce Stores` client(s) in your `config.yml`:

``` yaml
parameters:
    mc_ecommerce.api_key: <YOUR-API-KEY>
    mc_ecommerce.store_id: 'YOUR-STORE-ID' # It can be any string
```

Define a new `Guzzle client` service in your `services.yml`:

``` yaml
services:
    mailchimp_ecommerce.guzzle_client:
        class: GuzzleHttp\Client
```

## Usage ##

Example usage for create a product with a single variant:

``` php
<?php
$manager = $this->get('mc_ecommerce.product');

// Create variant
$variant = new ProductVariant();
$variant->setId('amazing-blue-jeans-variant');
$variant->setTitle('Amazing blue jeans');
$variant->setUrl('http://www.domain.es/amazing-blue-jeans');
$variant->setPrice(70.5);
$variant->setImageUrl('http://www.domain.es/images/amazing-blue-jeans.jpg');

// Create product
$product = new Product();
$product->setId('amazing-blue-jeans');
$product->setTitle('Amazing blue jeans');
$product->setProductVariants([$variant]);

$manager->create($product);
```

Example usage for edit a product:

``` php
<?php
$manager = $this->get('mc_ecommerce.product');
...
// Set new product price
$product->setPrice(65);

$manager->edit($product);
```

Example usage for delete a product:

``` php
<?php
$manager = $this->get('mc_ecommerce.product');
...
$manager->delete($product);
```

## License ##
See [LICENSE](LICENSE)
