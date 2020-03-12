<?php

namespace Omnipay\Square\Message;

/**
 * Square Customer Response
 */
class CustomerResponse extends Response
{
	public function getCustomer()
	{
		if (isset($this->data['customer'])) {
			if (!empty($this->data['customer'])) {
				return $this->data['customer'];
			}
		}
		return null;
	}

	public function getCustomerReference()
	{
		if (isset($this->data['customer'])) {
			if (!empty($this->data['customer'])) {
				return $this->data['customer']['id'];
			}
		}
		return null;
	}

	public function getCustomerCards()
	{
		if (isset($this->data['customer'])) {
			if (!empty($this->data['customer'])) {
				return $this->data['customer']['cards'];
			}
		}
		return null;
	}

	public function getCard()
	{
		return $this->getCustomerCards();
	}

	public function getTransactionId()
	{
		return $this->getCustomerReference();
	}
}
