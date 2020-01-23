<div align="center">
 <img width="200" valign="top" src="https://res.cloudinary.com/dy2dagugp/image/upload/v1571249658/seerbit-logo_mdinom.png">
</div>


<h1 align="center">
  <img width="60" valign="bottom" src="https://www.php.net/images/logos/php-logo.svg">
  - SeerBit
</h1>


# SeerBit's API Library for PHP (Version 1)

SeerBit PHP Library for easy integration with SeerBit's API.

## Integration
The Library supports all APIs under the following services:

* Payment via API (card and account)
* Disputes
* Refunds
* Transaction Status

## Requirements
PHP 5.5 or higher

## Installation ##
You can use Composer or simply Download the Release

### Composer ###

The preferred method is via [composer](https://getcomposer.org). Follow the
[installation instructions](https://getcomposer.org/doc/00-intro.md) if you do not already have
composer installed.


Once composer is installed, execute the following command in your project root to install this library:

```sh
composer require seerbit/seerbit-php-v1
```

### Examples ###

Validate a transaction:

```php

use Seerbit\Client;
use Seerbit\Service\Authenticate;
use Seerbit\Service\Status\TransactionStatusService;

//Instantiate SeerBit Client
$client = new Client();

//Configure SeerBit Client Environment
$client->setEnvironment(\Seerbit\Environment::LIVE);

$client->setPublicKey("ACCOUNT PUBLIC KEY");
$client->setPrivateKey("ACCOUNT PRIVATE KEY");

//Instantiate Authentication Service
$authService = new Authenticate($client);

    //Get Auth Token
    $card_auth_token = $authService->Auth()->getToken();

    if ($card_auth_token){

        //Instantiate Transaction Service
        $transaction_service =  New TransactionStatusService($client, $card_auth_token);

        $transaction_reference = "TRANSACTION REFERENCE";

        //Validate Transaction
        $transaction_status = $transaction_service->ValidateStatus($transaction_reference);
        echo($transaction_status->toJson());

    }else{
        echo 'Authentication failed';
    }


```
Find more examples [**here**](./src/Examples) 

## Documentation ##
* https://doc.seerbit.com/v/master/api/library

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
