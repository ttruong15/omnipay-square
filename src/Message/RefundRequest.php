<?php

namespace Omnipay\Square\Message;

/**
 * Square Refund Request
 */
class RefundRequest extends AbstractRequest
{

	public function getTransactionId()
	{
		return $this->getParameter('transactionId');
	}

	public function setTransactionId($value)
	{
		return $this->setParameter('transactionId', $value);
	}

	public function getPaymentId()
	{
		return $this->getParameter('transactionId');
	}

	public function setPaymentId($value)
	{
		return $this->setParameter('transactionId', $value);
	}

	public function getFee()
	{
		return $this->getParameter('fee');
	}

	public function setFee($value)
	{
		return $this->setParameter('fee', $value);
	}

	public function getFeeCurrency()
	{
		return $this->getParameter('feeCurrency');
	}

	public function setFeeCurrency($value)
	{
		return $this->setParameter('feeCurrency', $value);
	}

	public function getReason()
	{
		return $this->getParameter('reason');
	}

	public function setReason($value)
	{
		return $this->setParameter('reason', $value);
	}

	public function getData()
	{
		$money = new \SquareConnect\Model\Money();
		$money->setAmount($this->getAmountInteger());
		$money->setCurrency($this->getCurrency());


		$data = new \SquareConnect\Model\RefundPaymentRequest();
		$data->setAmountMoney($money);
		$data->setIdempotencyKey($this->getIdempotencyKey());

		if ($this->getFee()) {
			$appFee = new \SquareConnect\Model\Money();
			$appFee->setAmount($this->getFee());
			if ($this->getFeeCurrency()) {
				$appFee->setCurrency($this->getFeeCurrency());
			}

			$data->setAppFeeMoney($appFee);
		}

		$data->setPaymentId($this->getTransactionId());
		$data->setReason($this->getReason());

		return $data;
	}

	public function sendData($data)
	{
		try {
			$api_instance = new \SquareConnect\Api\RefundsApi($this->getClientApi());
			$httpResponse = $api_instance->refundPayment($data);
			$responseArray = json_decode($httpResponse, true);

			return $this->response = new RefundResponse($this, $responseArray);
		} catch (\SquareConnect\ApiException $e) {
			$responseArray = json_decode(json_encode($e->getResponseBody()), true);
			return $this->response = new RefundResponse($this, $responseArray);
		} catch (\Exception $e) {
			throw $e;
		}
	}
}
