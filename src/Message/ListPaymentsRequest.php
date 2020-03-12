<?php

namespace Omnipay\Square\Message;

/**
 * Square List Payments Request
 */
class ListPaymentsRequest extends AbstractRequest
{

	public function getBeginTime()
	{
		return $this->getParameter('beginTime');
	}

	public function setBeginTime($value)
	{
		return $this->setParameter('beginTime', $value);
	}

	public function getEndTime()
	{
		return $this->getParameter('endTime');
	}

	public function setEndTime($value)
	{
		return $this->setParameter('endTime', $value);
	}

	public function getSortOrder()
	{
		return $this->getParameter('sortOrder');
	}

	public function setSortOrder($value)
	{
		return $this->setParameter('sortOrder', $value);
	}

	public function getCursor()
	{
		return $this->getParameter('cursor');
	}

	public function setCursor($value)
	{
		return $this->setParameter('cursor', $value);
	}

	public function getTotal()
	{
		return $this->getParameter('total');
	}

	public function setTotal($value)
	{
		return $this->setParameter('total', $value);
	}

	public function getlast4()
	{
		return $this->getParameter('last4');
	}

	public function setLast4($value)
	{
		return $this->setParameter('last4', $value);
	}

	public function getCardBrand()
	{
		return $this->getParameter('cardBrand');
	}

	public function setCardBrand($value)
	{
		return $this->setParameter('cardBrand', $value);
	}

	public function getData()
	{
		return [
			'begin_time' => $this->getBeginTime(),
			'end_time' => $this->getEndTime(),
			'sort_order' => $this->getSortOrder(),
			'cursor' => $this->getCursor(),
			'location_id' => $this->getLocationId(),
			'total' => $this->getTotal(),
			'last_4' => $this->getlast4(),
			'card_brand' => $this->getCardBrand(),
		];
	}

	public function sendData($data)
	{
		print_r($data);
		try {
			if(!$data['location_id']) {
				$data['location_id'] = null;
			}
			$api_instance = new \SquareConnect\Api\PaymentsApi($this->getClientApi());
			$httpResponse = $api_instance->listPayments(
				$data['begin_time'], $data['end_time'],
				$data['sort_order'], $data['cursor'],
				$data['location_id'], $data['total'],
				$data['last_4'], $data['card_brand']
			);

			$responseArray = json_decode($httpResponse, true);

			return $this->response = new ListPaymentsResponse($this, $responseArray);
		} catch (\SquareConnect\ApiException $e) {
			$responseArray = json_decode(json_encode($e->getResponseBody()), true);
			return $this->response = new ListPaymentsResponse($this, $responseArray);
		} catch (\Exception $e) {
			throw $e;
		}
	}
}
