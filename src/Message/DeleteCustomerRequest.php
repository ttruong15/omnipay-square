<?php

/**
 * Created by IntelliJ IDEA.
 * User: Dylan
 * Date: 16/04/2019
 * Time: 3:50 PM
 */

namespace Omnipay\Square\Message;

class DeleteCustomerRequest extends AbstractRequest
{

	public function setCustomerReference($value)
	{
		return $this->setParameter('customerReference', $value);
	}

	public function getCustomerReference()
	{
		return $this->getParameter('customerReference');
	}

	public function getData()
	{
		$data = [];

		$data['customer_id'] = $this->getCustomerReference();

		return $data;
	}

	public function sendData($data)
	{
		try {
			$api_instance = new \SquareConnect\Api\CustomersApi($this->getClientApi());
			$httpResponse = $api_instance->deleteCustomer($data['customer_id']);
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
