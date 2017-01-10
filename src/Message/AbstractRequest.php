<?php 
/**
* Abstract class used to communicate with CardConnect
*/
namespace Omnipay\Cardconnect\Message;

class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    /*
        TODO Update liveEndpoint value once testing is complete
    */
    protected $liveEndpoint = 'https://fts.cardconnect.com:6443';
    protected $testEndpoint = 'https://fts.cardconnect.com:6443';
    
    /*
     ★ ★ ★ Jeremy Bueler (buelerj) *************************************
         Getters
    ********************************************************************** 
    */
    
    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function getApiUsername()
    {
        return $this->getParameter('apiUsername');
    }

    public function getPassword()
    {
        return $this->getParameter('apiPassword');
    }

    public function getTestMode()
    {
        return $this->getParameter('testMode');
    }

    /*
     ★ ★ ★ Jeremy Bueler (buelerj) *************************************
         Setters
    ********************************************************************** 
    */
    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    public function setApiUsername($value)
    {
        return $this->setParameter('apiUsername', $value);
    }

    public function setPassword($value)
    {
        return $this->setParameter('apiPassword', $value);
    }

    public function setTestMode($value)
    {
        return $this->setParameter('testMode', $value);
    }
    
    
    /*
     ★ ★ ★ Jeremy Bueler (buelerj) *************************************
         Implementation
    ********************************************************************** 
    */
    
    public function getEndpointBase()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }    
}