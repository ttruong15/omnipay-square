# Omnipay: Square

**Square driver for the Omnipay PHP payment processing library**

[![Build Status](https://travis-ci.org/Transportersio/omnipay-square.png?branch=master)](https://travis-ci.org/Transportersio/omnipay-square)
[![Latest Stable Version](https://poser.pugx.org/transportersio/omnipay-square/version.png)](https://packagist.org/packages/transportersio/omnipay-square)
[![Total Downloads](https://poser.pugx.org/transportersio/omnipay-square/d/total.png)](https://packagist.org/packages/transportersio/omnipay-square)
[![License](https://poser.pugx.org/transportersio/omnipay-square/license)](https://packagist.org/packages/transportersio/omnipay-square)

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements Square support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "transportersio/omnipay-square": "~1.0.7"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Basic Usage

The following gateways are provided by this package:

* Square

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

## Example

```
use Omnipay\Omnipay;

$gateway = Omnipay::create('Square');
$gateway->setAccessToken("YOUR-ACCESS-TOKEN-HERE");
$gateway->setParameter("testMode", true);  // enable sandbox testing

## Take a payment example

$purchase = [
    'amount' => 10,
    'currency' => 'AUD',
    'nonce' => 'ccof:kIjiG3WZhEblEdYj3GB',    // either a secure token (cnon:***) or card on file token (ccof:**)
    'note' => 'my testing payment',
    'referenceId' => 'abc',
    'customerReference' => '9E9X4YNDYH53VFZ32JD5EBFFFF'
];

try {
    $resp = $gateway->purchase($purchase)->send();
    $responseData = $resp->getData();
} catch(\Exception $e) {
    echo $e->getMessage();
}

## Refund example

$refundPayment = [
    'idempotencyKey' => uniqid(),
    'amount' => 1,
    'currency' => 'AUD',
    'transactionId' => 'XbeDoYcBcukcQNSgnX82go5LzwAZY',
    'reason' => 'test refund'
];

try {
    $resp = $gateway->refund($refundPayment)->send();
    $responseData = $resp->getData();
} catch(\Exception $e) {
    echo $e->getMessage();
}

## Create a customer example

$newCustomer = [
    'firstName' => 'test',
    'lastName' => 'test',
    'email' => 'test+01@testxample.com',
    'companyName' => 'test company pty ltd',
    'nickname' => 'test nick',
    'address' => [
	'address_line_1' => '22 test st',
	'locality' => 'brisbane',
	'administrative_district_level_1' => 'QLD',
	'postal_code' => '4000',
	'country' => 'AU'
    ],
    'phoneNumber' => '0733222222',
    'referenceId' => 'testref123',
    'note' => 'test note',
    'birthday' => '1970-01-30T00:00:00'
];

try {
    $resp = $gateway->createCustomer($newCustomer)->send();
    $responseData = $resp->getData();
} catch(\Exception $e) {
    echo $e->getMessage();
}

## Update customer example

$updateCustomer = [
    'customerReference' => 'DQ5ADHPB8GWKF6AEBP44Q8AZP4',
    'firstName' => 'test',
    'lastName' => 'test',
    'email' => 'test+01@testxample.com',
    'companyName' => 'test company pty ltd',
    'nickname' => 'test nick',
    'address' => [
	'address_line_1' => '22 test st',
	'locality' => 'brisbane',
	'administrative_district_level_1' => 'QLD',
	'postal_code' => '4000',
	'country' => 'AU'
    ],
    'phoneNumber' => '0733222222',
    'referenceId' => 'testref123',
    'note' => 'test note',
    'birthday' => '1970-01-30T00:00:00'
];

try {
    $resp = $gateway->updateCustomer($updateCustomer)->send();
    $responseData = $resp->getData();
} catch(\Exception $e) {
    echo $e->getMessage();
}

## Create a card for customer example

$customerCard = [
    "customerReference" => "Y2QP0W93PWYWNBT3PTX5CAMKXC",
    "card" => "cnon:CBASEIP-9iU6Y9hLwvbKlU9mkcM",
    "cardholderName" => "Amelia Earhart"
];

try {
    $resp = $gateway->createCard($customerCard)->send();
    $responseData = $resp->getData();
} catch(\Exception $e) {
    echo $e->getMessage();
}

## Delete customer example

$deleteCustomer = [
    'customerReference' => '9E9X4YNDYH53VFZ32JD5EB55PG',
];

try {
    $resp = $gateway->deleteCustomer($deleteCustomer)->send();
    $responseData = $resp->getData();
} catch(\Exception $e) {
    echo $e->getMessage();
}

## Delete customer card example

$deleteCustomerCard = [
    'customerReference' => '9E9X4YNDYH53VFZ32JD5EB55PG',
    'cardReference' => 'ccof:yZmvTQ2YfslSRKHi4GB'
];

try {
    $resp = $gateway->deleteCard($deleteCustomerCard)->send();
    $responseData = $resp->getData();
} catch(\Exception $e) {
    echo $e->getMessage();
}

## Retrieve customer example

$fetchCustomer = [
	'customerReference' => 'DQ5ADHPB8GWKF6AEBP44Q8AZP4',
];

try {
    $resp = $gateway->fetchCustomer($fetchCustomer)->send();
    $responseData = $resp->getData();
} catch(\Exception $e) {
    echo $e->getMessage();
}

## Retrieve customer cards example

$fetchCustomerCard = [
	'customerReference' => 'DQ5ADHPB8GWKF6AEBP44Q8AZP4',
	'card' => 'ccof:eTAtmHpmpE8kfshh3GB'
];
try {
    $resp = $gateway->fetchCard($fetchCustomerCard)->send();
    $responseData = $resp->getData();
} catch(\Exception $e) {
    echo $e->getMessage();
}

## Retrieve payment refunds example

$listPaymentRefunds = [
    'beginTime' => '2020-01-12T01:06:23.798Z',
    'endTime' => '2020-03-12T01:06:23.798Z',
    'sortOrder' => 'ASC',
    'cursor' => null,
    'locationId' => null,
    'status' => 'PENDING',
    'sourceType' => 'CARD'
];

try {
    $resp = $gateway->listRefunds($listPaymentRefunds)->send();
    $responseData = $resp->getData();
} catch(\Exception $e) {
    echo $e->getMessage();
}

## Retrieve payments example

$listPayments = [
    'beginTime' => '2020-01-12T01:06:23.798Z',
    'endTime' => '2020-03-12T01:06:23.798Z',
    'sortOrder' => 'ASC',
    'cursor' => null,
    'total' => '100',
    'last4' => '1111',
    'card_brand' => 'VISA'
];

try {
    $resp = $gateway->listRefunds($listPayments)->send();
    $responseData = $resp->getData();
} catch(\Exception $e) {
    echo $e->getMessage();
}

## Refund payment example

$refundPayment = [
	'idempotencyKey' => uniqid(),
	'amount' => 1,
	'currency' => 'AUD',
	'transactionId' => 'XbeDoYcBcukcQNSgnX82go5LzwAZY',
	'reason' => 'test refund'
];

try {
    $resp = $gateway->refund($refundPayment)->send();
    $responseData = $resp->getData();
} catch(\Exception $e) {
    echo $e->getMessage();
}

```

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/Transportersio/omnipay-square/issues),
or better yet, fork the library and submit a pull request.
