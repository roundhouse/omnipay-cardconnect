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

    public function getApiSite()
    {
        return $this->getParameter('apiSite');
    }

    public function getApiUsername()
    {
        return $this->getParameter('apiUsername');
    }

    public function getApiPassword()
    {
        return $this->getParameter('apiPassword');
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
    public function setApiSite($value)
    {
        return $this->setParameter('apiSite', $value);
    }

    public function setApiPassword($value)
    {
        return $this->setParameter('apiPassword', $value);
    }

    public function sendData($data)
    {
        return $this->handleResponse($this->httpClient->request('PUT', $this->getEndpoint(), $this->getHeaders(), json_encode($data)));
    }

    public function getHeaders()
    {
        $authHeader = 'Basic ' . base64_encode($this->getApiUsername() . ":" . $this->getApiPassword());
        
        return [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => $authHeader,
        ];
    }

    public function getEndpointBase()
    {
        $site = $this->getApiSite();
        if ($this->getTestMode()) {
            $site .= '-uat';
        }

        return "https://{$site}.cardconnect.com/cardconnect/rest";
    }

    public function handleResponse($response)
    {
        if ($response->getStatusCode() != 200) {
            throw new \Exception($response->getReasonPhrase());
        }

        $this->response = new Response($this, json_decode($response->getBody()->getContents(), true));

        return $this->response;
    }
}