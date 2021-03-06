<?php

namespace Omnipay\Square\Message;

/**
 * Square List Refunds Request
 */
class ListRefundsRequest extends AbstractRequest
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

	public function getStatus()
	{
		return $this->getParameter('status');
	}

	public function setStatus($value)
	{
		return $this->setParameter('status', $value);
	}

	public function getSourceType()
	{
		return $this->getParameter('sourceType');
	}

	public function setSourceType($value)
	{
		return $this->setParameter('sourceType', $value);
	}

	public function getData()
	{
		return [
			'begin_time' => $this->getBeginTime(),
			'end_time' => $this->getEndTime(),
			'sort_order' => $this->getSortOrder(),
			'cursor' => $this->getCursor(),
			'location_id' => $this->getLocationId(),
			'status' => $this->getStatus(),
			'source_type' => $this->getSourceType(),
		];
	}

	public function sendData($data)
	{
		try {
			if(!$data['location_id']) {
				$data['location_id'] = null;
			}
			$api_instance = new \SquareConnect\Api\RefundsApi($this->getClientApi());
			$httpResponse = $api_instance->listPaymentRefunds(
				$data['begin_time'], $data['end_time'],
				$data['sort_order'], $data['cursor'],
				$data['location_id'], $data['status'],
				$data['source_type']
			);

			$responseArray = json_decode($httpResponse, true);

			return $this->response = new ListRefundsResponse($this, $responseArray);
		} catch (\SquareConnect\ApiException $e) {
			$responseArray = json_decode(json_encode($e->getResponseBody()), true);
			return $this->response = new ListRefundsResponse($this, $responseArray);
		} catch (\Exception $e) {
			throw $e;
		}
	}
}
