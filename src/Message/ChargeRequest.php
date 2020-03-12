<?php

namespace Omnipay\Square\Message;

/**
 * Square Purchase Request
 */
class ChargeRequest extends AbstractRequest
{

	public function getReceiptId()
	{
		return $this->getParameter('receiptId');
	}

	public function setReceiptId($value)
	{
		return $this->setParameter('receiptId', $value);
	}

	public function getTransactionId()
	{
		return $this->getParameter('transactionId');
	}

	public function setTransactionId($value)
	{
		return $this->setParameter('transactionId', $value);
	}

	public function getNonce()
	{
		return $this->getParameter('nonce');
	}

	public function setNonce($value)
	{
		return $this->setParameter('nonce', $value);
	}

	public function setCustomerReference($value)
	{
		return $this->setParameter('customerReference', $value);
	}

	public function getCustomerReference()
	{
		return $this->getParameter('customerReference');
	}

	public function getCustomerCardId()
	{
		return $this->getParameter('customerCardId');
	}

	public function setCustomerCardId($value)
	{
		return $this->setParameter('customerCardId', $value);
	}

	public function getReferenceId()
	{
		return $this->getParameter('referenceId');
	}

	public function setReferenceId($value)
	{
		return $this->setParameter('referenceId', $value);
	}

	public function getOrderId()
	{
		return $this->getParameter('orderId');
	}

	public function setOrderId($value)
	{
		return $this->setParameter('orderId', $value);
	}

	public function getNote()
	{
		return $this->getParameter('note');
	}

	public function setNote($value)
	{
		return $this->setParameter('note', $value);
	}

	public function setStatementDescriptionIdentifier($value)
	{
		return $this->setParameter('statementDescriptionIdentifier', $value);
	}

	public function getStatementDescriptionIdentifier()
	{
		return $this->getParameter('statementDescriptionIdentifier');
	}

	public function setVerificationToken($value)
	{
		return $this->setParameter('verificationToken', $value);
	}

	public function getVerificationToken()
	{
		return $this->getParameter('verificationToken');
	}

	public function getData()
	{
		$amountMoney = new \SquareConnect\Model\Money();
		$amountMoney->setAmount($this->getAmountInteger());
		$amountMoney->setCurrency($this->getCurrency());

		$data = new \SquareConnect\Model\CreatePaymentRequest();
		$data->setSourceId($this->getNonce() ?? $this->getCustomerCardId());
		$data->setVerificationToken($this->getToken());
		$data->setCustomerId($this->getCustomerReference());
		$data->setNote($this->getNote());
		$data->setReferenceId($this->getReferenceId());
		$data->setIdempotencyKey($this->getIdempotencyKey());
		$data->setAmountMoney($amountMoney);
		$data->setOrderId($this->getOrderId());
		$data->setStatementDescriptionIdentifier($this->getStatementDescriptionIdentifier());
		$data->setVerificationToken($this->getVerificationToken());
		if ($this->getLocationId()) {
			$data->setLocationId($this->getLocationId());
		}

		return $data;
	}

	public function sendData($data)
	{
		try {
			$api_instance = new \SquareConnect\Api\PaymentsApi($this->getClientApi());
			$httpResponse = $api_instance->createPayment($data);

			$responseArray = json_decode($httpResponse, true);
			return $this->response = new ChargeResponse($this, $responseArray);
		} catch (\SquareConnect\ApiException $e) {
			$responseArray = json_decode(json_encode($e->getResponseBody()), true);
			return $this->response = new ChargeResponse($this, $responseArray);
		} catch (\Exception $e) {
			throw $e;
		}
	}
}
