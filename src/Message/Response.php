<?php

namespace Omnipay\Cardconnect\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * Cardconnect Response
 *
 * This is the response class for all Cardconnect requests.
 *
 * @see \Omnipay\Cardconnect\Gateway
 */
class Response extends AbstractResponse
{
    public function isSuccessful()
    {
        return isset($this->data['respcode']) && $this->data['respcode'] == '00';
    }

    public function getTransactionReference()
    {
        return isset($this->data['retref']) ? $this->data['retref'] : null;
    }
    
    public function getCode()
    {
        return isset($this->data['authcode']) ? $this->data['authcode'] : null;
    }

    public function getMessage()
    {
        return isset($this->data['resptext']) ? $this->data['resptext'] : null;
    }
}
