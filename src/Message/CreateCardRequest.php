<?php

namespace Omnipay\Square\Message;

/**
 * Square Create Credit Card Request
 */
class CreateCardRequest extends AbstractRequest
{

	public function setCustomerReference($value)
	{
		return $this->setParameter('customerReference', $value);
	}

	public function getCustomerReference()
	{
		return $this->getParameter('customerReference');
	}

	public function getCard()
	{
		return $this->getParameter('card');
	}

	public function setCard($value)
	{
		return $this->setParameter('card', $value);
	}

	public function getCardholderName()
	{
		return $this->getParameter('cardholderName');
	}

	public function setCardholderName($value)
	{
		return $this->setParameter('cardholderName', $value);
	}

	public function getData()
	{
		$data = [];

		$data['customer_id'] = $this->getCustomerReference();
		$data['card_nonce'] = $this->getCard();
		$data['cardholder_name'] = $this->getCardholderName();

		return $data;
	}

	public function sendData($data)
	{
		try {
			$api_instance = new \SquareConnect\Api\CustomersApi($this->getClientApi());
			$httpResponse = $api_instance->createCustomerCard($data['customer_id'], $data);
			$responseArray = json_decode($httpResponse, true);

			return $this->response = new CardResponse($this, $responseArray);
		} catch (\SquareConnect\ApiException $e) {
			$responseArray = json_decode(json_encode($e->getResponseBody()), true);
			return $this->response = new CardResponse($this, $responseArray);
		} catch (\Exception $e) {
			throw $e;
		}
	}
}
