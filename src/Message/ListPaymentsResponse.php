<?php

namespace Omnipay\Square\Message;

/**
 * Square List Payment Response
 */
class ListPaymentsResponse extends Response
{

	public function getPayments()
	{
		return $this->data['payments'];
	}
}
