<?php

/**
 * Created by IntelliJ IDEA.
 * User: Dylan
 * Date: 17/04/2019
 * Time: 9:44 AM
 */

namespace Omnipay\Square\Message;

class DeleteCardRequest extends AbstractRequest
{

	public function setCustomerReference($value)
	{
		return $this->setParameter('customerReference', $value);
	}

	public function getCustomerReference()
	{
		return $this->getParameter('customerReference');
	}

	public function getCardReference()
	{
		return $this->getParameter('cardReference');
	}

	public function setCardReference($value)
	{
		return $this->setParameter('cardReference', $value);
	}

	public function getData()
	{
		$data = [];

		$data['customer_id'] = $this->getCustomerReference();
		$data['card_id'] = $this->getCardReference();

		return $data;
	}

	public function sendData($data)
	{
		try {
			$api_instance = new \SquareConnect\Api\CustomersApi($this->getClientApi());
			$httpResponse = $api_instance->deleteCustomerCard($data['customer_id'], $data['card_id']);
			$responseArray = json_decode($httpResponse, true);

			return $this->response = new Response($this, $responseArray);
		} catch (\SquareConnect\ApiException $e) {
			$responseArray = json_decode(json_encode($e->getResponseBody()), true);
			return $this->response = new Response($this, $responseArray);
		} catch (\Exception $e) {
			throw $e;
		}
	}
}
