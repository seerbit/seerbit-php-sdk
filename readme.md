<div align="center">
 <img width="200" valign="top" src="https://res.cloudinary.com/dy2dagugp/image/upload/v1571249658/seerbit-logo_mdinom.png">
</div>


<h1 align="center">
  <img width="60" valign="bottom" src="https://www.php.net/images/logos/php-logo.svg">
  - SeerBit
</h1>


# SeerBit's API SDK for PHP (Version 2)

SeerBit PHP SDK for easy integration with SeerBit's API.

## Integration
The Library supports all APIs under the following services:

* Standard API Checkout
* Payment via API (card and account)
* Recurrent
* Pre-auth payment
* Order
* Mobile Money
* Transaction Status

## Requirements
PHP 5.5 or higher

## Installation ##
You can use Composer or simply Download the Release

### Composer ###

The preferred method is via [composer](https://getcomposer.org). Follow the composer
[installation instructions](https://getcomposer.org/doc/00-intro.md) if you do not already have
composer installed.


Once composer is installed, execute the following command in your project root to install this library:

```sh
composer require seerbit/seerbit-php-sdk
```

### Examples ###

Validate a transaction:

```php

try{
    $token = "1KWLzpZkWaoXO9AN4qweKwqLjGcQSNt8kjeVjsdTG4lPlwg6sTvpVAay2RA7hoCEzHPkIQa+MNfDepx4VBr5JMgLb5Q5anq9XoN2pXU850bumqBWFVw1T1ZW5w8N+Sq/";
    //Instantiate SeerBit Client
    $client = new Client();
    $client->setToken($token);
    //Configure SeerBit Client
    $client->setEnvironment(\Seerbit\Environment::LIVE);
    $client->setAuthType(\Seerbit\AuthType::BEARER);

    //SETUP CREDENTIALS
    $client->setPublicKey("SBTESTPUBK_p8GqvFSFNCBahSJinczKd9aIPoRUZfda");
    $client->setSecretKey("SBTESTSECK_kFgKytQK1KSvbR616rUMqNYOUedK3Btm5igZgxaZ");

    //Instantiate Resource Service
    $standard_service =  New StandardService($client);
    $uuid = bin2hex(random_bytes(6));
    $transaction_ref = strtoupper(trim($uuid));

    //the order of placement is important
    $payload = [
        "amount" => "1000",
        "callbackUrl" => "http:yourwebsite.com",
        "country" => "NG",
        "currency" => "NGN",
        "email" => "customer@email.com",
        "paymentReference" => $transaction_ref,
        "productDescription" => "product_description",
        "productId" => "64310880-2708933-427"
    ];

    $transaction = $standard_service->Initialize($payload);

    echo($transaction->toJson());

}catch (\Exception $exception){
    echo $exception->getMessage();
}


```
Find more examples [**here**](./src/Examples) 

## Configure Logger ##
````php
//Set Logger path
$client->setLoggerPath(dirname(__FILE__));

//Set custom Logger
$client->setLogger = $->CustomLoggerService();
````

## Documentation ##
* https://doc.seerbit.com/

## Support
If you have any problems, questions or suggestions, create an issue here or send your inquiry to care@seerbit.com.

## Contributing
We strongly encourage you to join us in contributing to this repository so everyone can benefit from:
* New features and functionality
* Resolved bug fixes and issues
* Any general improvements

Read our [**contribution guidelines**](CONTRIBUTING.md) to find out how.

## Licence
MIT license. For more information, see the LICENSE file.
