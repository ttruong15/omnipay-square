<?php

/**
 * Created by IntelliJ IDEA.
 * User: Dylan
 * Date: 17/04/2019
 * Time: 3:28 PM
 */

namespace Omnipay\Square\Message;

class FetchCardRequest extends AbstractRequest
{

	public function setCustomerReference($value)
	{
		return $this->setParameter('customerReference', $value);
	}

	public function getCustomerReference()
	{
		return $this->getParameter('customerReference');
	}

	public function setCardReference($value)
	{
		return $this->setParameter('cardReference', $value);
	}

    public function getCardReference()
    {
        return $this->getParameter('card');
    }

    public function getCard()
    {
        return $this->getParameter('card');
    }

    public function setCard($value)
    {
        return $this->setParameter('card', $value);
    }

	public function getData()
	{
		$data = [];

		$data['customer_id'] = $this->getCustomerReference();
		$data['card_id'] = $this->getCard();

		return $data;
	}

	public function sendData($data)
	{
		try {
			$api_instance = new \SquareConnect\Api\CustomersApi($this->getClientApi());
			$httpResponse = $api_instance->retrieveCustomer($data['customer_id']);
			$responseArray = json_decode($httpResponse, true);

			$customerCard['card'] = [];
			if(array_key_exists('customer', $responseArray) && is_array($responseArray['customer']['cards'])) {
				foreach($responseArray['customer']['cards'] as $card) {
					if($card['id'] === $data['card_id']) {
						$customerCard['card'] = $card;
						break;
					}
				}
			}
			return $this->response = new CardResponse($this, $customerCard);
		} catch (\SquareConnect\ApiException $e) {
			$responseArray = json_decode(json_encode($e->getResponseBody()), true);
			return $this->response = new CardResponse($this, $responseArray);
		} catch (\Exception $e) {
			throw $e;
		}
	}
}
