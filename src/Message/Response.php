<?php

namespace Omnipay\Square\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\RedirectResponseInterface;

/**
 * Square Response
 */
class Response extends AbstractResponse implements RedirectResponseInterface
{

    public function isSuccessful()
    {
        return !isset($this->data['errors']);
    }

    public function isRedirect()
    {
        return false;
    }

    public function getRedirectUrl()
    {
        return "";
    }

    public function getRedirectMethod()
    {
        return "";
    }

    public function getRedirectData()
    {
        return [];
    }

    public function getTransactionId()
    {
        return $this->data['id'] ?? null;
    }

    public function getCreatedAt()
    {
        return $this->data['created_at'] ?? null;
    }

    public function getUpdatedAt()
    {
        return $this->data['updated_at'] ?? null;
    }

    public function getReferenceId()
    {
        return $this->data['referenceId'] ?? null;
    }

    public function getMessage()
    {
        $message = '';
		if(isset($this->data['errors'][0]['code'])) {
            $message .= $this->data['errors'][0]['code'] . ': ';
        }

        return $message . ($this->data['errors'][0]['detail'] ?? '');
    }

    public function getErrorDetail()
    {
        return $this->data['errors'][0]['detail'] ?? null;
    }

	public function getCode()
	{
		return $this->data['errors'][0]['code'] ?? null;
	}

	public function getErrorCode()
	{
		return $this->getCode();
	}

	public function getCategory()
	{
		return $this->data['errors'][0]['category'] ?? null;
	}

	public function getErrors()
	{
		return $this->data['errors'] ?? null;
	}
}
