<?php

namespace Omnipay\Square\Message;

/**
 * Square Refund Response
 */
class RefundResponse extends Response
{

	public function getTransactionId()
	{
		return $this->data['refund']['id'] ?? null;
	}

	public function getRefunds()
	{
		return $this->data['refund'];
	}

	public function getStatus()
	{
		return $this->data['refund']['status'];
	}
}
