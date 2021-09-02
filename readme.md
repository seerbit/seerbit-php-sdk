<div align="center">
 <img width="400" valign="top" src="https://res.cloudinary.com/dpejkbof5/image/upload/v1620323718/Seerbit_logo_png_ddcor4.png">
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

Start a Standard transaction:

```php

try{
    $token = "YOUR MERCHANT TOKEN";
    //Instantiate SeerBit Client
    $client = new Client();
    $client->setToken($token);
    //Configure SeerBit Client
    $client->setEnvironment(\Seerbit\Environment::LIVE);
    $client->setAuthType(\Seerbit\AuthType::BEARER);

    //SETUP CREDENTIALS
    $client->setPublicKey("YOUR_PUBLIC_KEY");
    $client->setSecretKey("YOUR_SECRE_KEY");

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
Generate Token here: https://doc.seerbit.com/development-resources/hash/key-encrpyt

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

## Examples ##
* https://doc.seerbit.com/

### Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.


## Support
If you have any problems, questions or suggestions, create an issue here or send your inquiry to developers@seerbit.com.

## Credits

- [Victor Osas Ighalo](https://github.com/victorighalo)

## Contributing
We strongly encourage you to join us in contributing to this repository so everyone can benefit from:
* New features and functionality
* Resolved bug fixes and issues
* Any general improvements

Read our [**contribution guidelines**](CONTRIBUTING.md) to find out how.

## Licence
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
