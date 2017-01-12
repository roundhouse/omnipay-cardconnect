<?php

namespace Omnipay\Cardconnect\Message;

class VoidRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('transactionReference');
    	$data = array(
    		'merchid'   => $this->getMerchantId(),
    		'amount'    => $this->getAmountInteger(),
    		'retref'   => $this->getTransactionReference()
    	);
        return $data;
    }

    public function getEndpoint()
    {
        return $this->getEndpointBase() . "/void";
    }
}
