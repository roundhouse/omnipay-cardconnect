<?php

namespace Omnipay\Cardconnect;

use Omnipay\Common\AbstractGateway;

/**
 * Cardconnect Gateway
 *
 * This gateway is useful for testing. It simply authorizes any payment made using a valid
 * credit card number and expiry.
 *
 * Any card number which passes the Luhn algorithm and ends in an even number is authorized,
 * for example: 4242424242424242
 *
 * Any card number which passes the Luhn algorithm and ends in an odd number is declined,
 * for example: 4111111111111111
 *
 * ### Example
 *
 * <code>
 * // Create a gateway for the Cardconnect Gateway
 * // (routes to GatewayFactory::create)
 * $gateway = Omnipay::create('Cardconnect');
 *
 * // Initialise the gateway
 * $gateway->initialize(array(
 *     'testMode' => true, // Doesn't really matter what you use here.
 * ));
 *
 * // Create a credit card object
 * // This card can be used for testing.
 * $card = new CreditCard(array(
 *             'firstName'    => 'Example',
 *             'lastName'     => 'Customer',
 *             'number'       => '4242424242424242',
 *             'expiryMonth'  => '01',
 *             'expiryYear'   => '2020',
 *             'cvv'          => '123',
 * ));
 *
 * // Do a purchase transaction on the gateway
 * $transaction = $gateway->purchase(array(
 *     'amount'                   => '10.00',
 *     'currency'                 => 'AUD',
 *     'card'                     => $card,
 * ));
 * $response = $transaction->send();
 * if ($response->isSuccessful()) {
 *     echo "Purchase transaction was successful!\n";
 *     $sale_id = $response->getTransactionReference();
 *     echo "Transaction reference = " . $sale_id . "\n";
 * }
 * </code>
 */
class Gateway extends AbstractGateway
{
    
    public function getName()
    {
        return 'Cardconnect';
    }
    
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
         
    ********************************************************************** 
    */
    
    public function getDefaultParameters()
    {
        $params = array(
          'merchantId' => '',
          'apiUsername' => '',
          'apiPassword' => '',
          'testMode' => false
        );
        return $params;
    }

    /**
     * Create an authorize request.
     *
     * @param array $parameters
     * @return \Omnipay\Cardconnect\Message\AuthorizeRequest
     */
    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Cardconnect\Message\AuthorizeRequest', $parameters);
    }

    /**
     * Create a purchase request.
     *
     * @param array $parameters
     * @return \Omnipay\Cardconnect\Message\AuthorizeRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->authorize($parameters);
    }
}
