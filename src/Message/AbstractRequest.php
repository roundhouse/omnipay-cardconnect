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
    public function setMerchantId()
    {
        return $this->setParameter('merchantId');
    }

    public function setApiUsername()
    {
        return $this->setParameter('apiUsername');
    }

    public function setPassword()
    {
        return $this->setParameter('apiPassword');
    }

    public function setTestMode()
    {
        return $this->setParameter('testMode');
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