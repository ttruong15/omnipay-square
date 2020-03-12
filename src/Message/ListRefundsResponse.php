<?php

namespace Omnipay\Square\Message;

/**
 * Square List Refunds Response
 */
class ListRefundsResponse extends Response
{

	public function getRefunds()
	{
		return $this->data['refunds'];
	}
}
