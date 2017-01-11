<?php

namespace Omnipay\Cardconnect\Message;

class AuthorizeRequest extends AbstractRequest
{
    public function getData()
    {
        //Process and validate data for the request
        $this->validate('amount', 'card');
        // if ($this->getCard()->validate()) {
        // }
        $card = $this->getCard();
        // (
        //     [billingFirstName] => Jeremy
        //     [shippingFirstName] => Jeremy
        //     [billingLastName] => Bueler
        //     [shippingLastName] => Bueler
        //     [number] => 4242424242424242
        //     [expiryMonth] => 12
        //     [expiryYear] => 2018
        //     [startMonth] => 12
        //     [startYear] => 2012
        //     [cvv] => 023
        //     [issueNumber] =>
        //     [billingAddress1] => 537 SE Ash St Suite #401
        //     [shippingAddress1] => 537 SE Ash St Suite #401
        //     [billingAddress2] =>
        //     [shippingAddress2] =>
        //     [billingCity] => Portland
        //     [shippingCity] => Portland
        //     [billingPostcode] => 97214
        //     [shippingPostcode] => 97214
        //     [billingState] => OR
        //     [shippingState] => OR
        //     [billingCountry] =>
        //     [shippingCountry] =>
        //     [billingPhone] =>
        //     [shippingPhone] =>
        //     [email] => jeremy@roundhouseagency.com
        // )
    	$data = array(
    		'merchid'   => $this->getMerchantId(),
    		'account'   => $card->getNumber(),
    		'expiry'    => $card->getExpiryDate('m')."".$this->getCard()->getExpiryDate('y'),
    		'cvv2'      => $card->getCvv(),
    		'amount'    => $this->getAmountInteger(),
    		'currency'  => $this->getCurrency(),
    		'orderid'   => $this->getTransactionId(),
    		'name'      => $card->getName(),
    		'street'    => $card->getBillingAddress1(),
    		'city'      => $card->getBillingCity(),
    		'region'    => $card->getBillingState(),
    		'country'   => $card->getBillingCountry(),
    		'postal'    => $card->getBillingPostcode(),
    		'tokenize'  => "Y",
    	);
        //
        // echo "<pre>";print_r($this->getCard()); echo "</pre><br /><br /><br /><br />";
        return $data;
    }

    public function getEndpoint()
    {
        return $this->getEndpointBase() . "/auth";
    }
}
