<?php

namespace Seerbit\Service\Status;

interface TransactionStatusServiceContract
{

    public function ValidateTransactionStatus(string $transaction_reference);

    public function ValidateSubscriptionStatus(string $billingId);
}