<?php

namespace Omnipay\Square\Message;

/**
 * Square Create Customer Request
 */
class CreateCustomerRequest extends AbstractRequest
{

	public function getFirstName()
	{
		return $this->getParameter('firstName');
	}

	public function setFirstName($value)
	{
		return $this->setParameter('firstName', $value);
	}

	public function getLastName()
	{
		return $this->getParameter('lastName');
	}

	public function setLastName($value)
	{
		return $this->setParameter('lastName', $value);
	}

	public function getCompanyName()
	{
		return $this->getParameter('companyName');
	}

	public function setCompanyName($value)
	{
		return $this->setParameter('companyName', $value);
	}

	public function getEmail()
	{
		return $this->getParameter('email');
	}

	public function setEmail($value)
	{
		return $this->setParameter('email', $value);
	}

	public function setAddress($value)
	{
		$address = new \SquareConnect\Model\Address($value);
		$addressArray = json_decode((string) $address, true);
		return $this->setParameter('address', $addressArray);
	}

	public function getAddress()
	{
		return $this->getParameter('address');
	}


	public function getPhoneNumber()
	{
		return $this->getParameter('phoneNumber');
	}

	public function setPhoneNumber($value)
	{
		return $this->setParameter('phoneNumber', $value);
	}

	public function getNickName()
	{
		return $this->getParameter('nickName');
	}

	public function setNickName($value)
	{
		return $this->setParameter('nickName', $value);
	}

	public function getReferenceId()
	{
		return $this->getParameter('referenceId');
	}

	public function setReferenceId($value)
	{
		return $this->setParameter('referenceId', $value);
	}

	public function getNote()
	{
		return $this->getParameter('note');
	}

	public function setNote($value)
	{
		return $this->setParameter('note', $value);
	}

	public function getBirthday()
	{
		return $this->getParameter('birthday');
	}

	public function setBirthday($value)
	{
		return $this->setParameter('birthday', $value);
	}

	public function getData()
	{
		$data = [];

		$data['given_name'] = $this->getFirstName();
		$data['family_name'] = $this->getLastName();
		$data['company_name'] = $this->getCompanyName();
		$data['email_address'] = $this->getEmail();
		$data['address'] = $this->getAddress();
		$data['phone_number'] = $this->getPhoneNumber();
		$data['nickname'] = $this->getNickName();
		$data['address'] = $this->getAddress();
		$data['reference_id'] = $this->getReferenceId();
		$data['note'] = $this->getNote();
		$data['birthday'] = $this->getBirthday();

		return $data;
	}

	public function sendData($data)
	{
		try {
			$api_instance = new \SquareConnect\Api\CustomersApi($this->getClientApi());
			$httpResponse = $api_instance->createCustomer($data);
			$responseArray = json_decode($httpResponse, true);

			return $this->response = new CustomerResponse($this, $responseArray);
		} catch (\SquareConnect\ApiException $e) {
			$responseArray = json_decode(json_encode($e->getResponseBody()), true);
			return $this->response = new CustomerResponse($this, $responseArray);
		} catch (\Exception $e) {
			throw $e;
		}
	}
}
