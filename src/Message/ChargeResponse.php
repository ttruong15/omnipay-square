<?php

namespace Omnipay\Square\Message;

/**
 * Square Purchase Response
 */
class ChargeResponse extends Response
{

	public function getPayment()
	{
		return $this->data['payment'] ?? null;
	}

	public function getStatus()
	{
		return $this->data['payment']['status'] ?? null;
	}

	public function getlocationId()
	{
		return $this->data['payment']['location_id'] ?? null;
	}

	public function getTransactionId()
	{
		return $this->data['payment']['id'] ?? null;
	}

	public function getCardDetails()
	{
		return $this->data['payment']['card_details'] ?? null;
	}

	public function getCustomerId()
	{
		return $this->data['payment']['customer_id'] ?? null;
	}

	public function getReceiptNumber()
	{
		return $this->data['payment']['receipt_number'] ?? null;
	}

	public function getReceiptUrl()
	{
		return $this->data['payment']['receipt_url'] ?? null;
	}

	public function getTransactionReference()
	{
		return $this->getTransactionId();
	}
}
