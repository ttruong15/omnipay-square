<?php

namespace Omnipay\Square\Message;

/**
 * Square Card Response
 */
class CardResponse extends Response
{

	public function getCard()
	{
		if (isset($this->data['card'])) {
			if (!empty($this->data['card'])) {
				return $this->data['card'];
			}
		}
		return null;
	}

	public function getCardReference()
	{
		if (isset($this->data['card'])) {
			if (!empty($this->data['card'])) {
				return $this->data['card']['id'];
			}
		}
		return null;
	}

	public function getTransactionId()
	{
		return $this->getCardReference();
	}
}
