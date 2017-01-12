<?php 
/**
* Abstract class used to communicate with CardConnect
*/
namespace Omnipay\Cardconnect\Message;

abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $testEndpoint = 'https://fts.cardconnect.com:6443/cardconnect/rest';
    
    /*
     ★ ★ ★ Jeremy Bueler (buelerj) *************************************
         Getters
    ********************************************************************** 
    */
    
    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function getApiHost()
    {
        return $this->getParameter('apiHost');
    }

    public function getApiPort()
    {
        return $this->getParameter('apiPort');
    }

    public function getApiUsername()
    {
        return $this->getParameter('apiUsername');
    }

    public function getApiPassword()
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
    public function setApiHost($value)
    {
        return $this->setParameter('apiHost', $value);
    }
    public function setApiPort($value)
    {
        return $this->setParameter('apiPort', $value);
    }

    public function setApiPassword($value)
    {
        return $this->setParameter('apiPassword', $value);
    }

    public function setTestMode($value)
    {
        return $this->setParameter('testMode', $value);
    }
    
    protected function liveEndpoint()
    {
        return "https://".$this->getApiHost().":".$this->getApiPort()."/cardconnect/rest";
    }
    /*
     ★ ★ ★ Jeremy Bueler (buelerj) *************************************
         Implementation
    ********************************************************************** 
    */
    public function sendData($data)
    {
        $authString = $this->getApiUsername() . ":" . $this->getApiPassword();
        $response = $this->httpClient->put($this->getEndpoint(), array('content-type' => 'application/json'), json_encode($data))->setHeader("Authorization", "Basic " . base64_encode($authString))->send();
        $this->response = new Response($this, $response->json());
        return $this->response;
    }
    
    public function getEndpointBase()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint();
    }    
}