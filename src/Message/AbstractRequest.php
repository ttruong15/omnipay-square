<?php

/**
 * Square Abstract REST Request
 */

namespace Omnipay\Square\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{

	protected $testEndpoint = 'https://connect.squareupsandbox.com';
	protected $liveEndpoint = 'https://connect.squareup.com';

	public function getAccessToken()
	{
		return $this->getParameter('accessToken');
	}

	public function setAccessToken($value)
	{
		return $this->setParameter('accessToken', $value);
	}

	public function getLocationId()
	{
		return $this->getParameter('locationId');
	}

	public function setLocationId($value)
	{
		return $this->setParameter('locationId', $value);
	}

	public function getIdempotencyKey()
	{
		return $this->getParameter('idempotencyKey');
	}

	public function setIdempotencyKey($value)
	{
		return $this->setParameter('idempotencyKey', $value);
	}

	public function getTransactionId()
	{
		return null;
	}

	protected function getEndpoint()
	{
		return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
	}

	protected function getClientApi()
	{
		$api_config = new \SquareConnect\Configuration();

		$api_config->setHost($this->getEndpoint());
		$api_config->setAccessToken($this->getAccessToken());
		return new \SquareConnect\ApiClient($api_config);
	}
}
