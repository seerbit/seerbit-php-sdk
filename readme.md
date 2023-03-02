
<div align="center">
 <img width="200" valign="top" src="https://assets.seerbitapi.com/images/seerbit_logo_type.png">
</div>


# SeerBit PHP Library

This library provides convenient access to the SeerBit API from PHP based applications. It provides Utility classses to access API resources on SeerBit.

## Integration
The Library supports all APIs under the following services:

* Standard Checkout
* Payment via Card and Bank Account
* Recurrent transactions
* Card Tokenization
* Pre-authorized payment
* Order Payments
* Mobile Money Payments
* Transaction Validation

## Requirements
PHP 8

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

### Find examples [**here**](./src/Examples) 

#### Example 1 : Start a Standard transaction ###

```php

try{
    $token = "YOUR MERCHANT TOKEN";
    //Instantiate SeerBit Client
    $client = new Client();

    //Configure SeerBit Client
    $client->setToken($token);

    //SETUP CREDENTIALS
    $client->setPublicKey("MERCHANT_PUBLIC_KEY"); //REQUIRED
    $client->setSecretKey("MERCHANT_SECRET_KEY"); //OPTIONAL

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
### Find more examples [**here**](./src/Examples)


<u>How to Generate a Token?</u>
```
curl --location 'https://seerbitapi.com/api/v2/encrypt/keys' \
--header 'Content-Type: application/json' \
--data '{
	"key": "merchantSecretKey.merchantPublicKey"
}'
```

<u>Generate Token Response</u>

```
{
	"status": "SUCCESS",
	"data": {
			"code": "00",
			"EncryptedSecKey": {
					"encryptedKey": "SNt8kjeVjsdTG4lPlwg6sTvpVAay2RA7hoCEzHPkIQa+MNfDepx4VBr5JMgLb5Q5anq9XoN2pXU850bumqBWFVw1T1ZW5w8N+Sq/"
			},
			"message": "Successful"
	}
}
```


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
[**Examples**](./src/Examples) 

### Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.


## Support
If you have any problems, questions or suggestions, create an issue here or send your inquiry to developers@seerbit.com.

## Contributing
We encourage you to join us in contributing to this repository so everyone can benefit from:
* New features and functionality
* Resolved bug fixes and issues
* Any general improvements

Read our [**contribution guidelines**](CONTRIBUTING.md) to find out how.

## Licence
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
