<?php

namespace Omnipay\Cardconnect\Message;

class CaptureRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('amount', 'transactionReference');
    	$data = array(
    		'merchid'   => $this->getMerchantId(),
    		'amount'    => $this->getAmountInteger(),
    		'currency'  => $this->getCurrency(),
    		'retref'   => $this->getTransactionReference()
    	);
        return $data;
    }

    public function getEndpoint()
    {
        return $this->getEndpointBase() . "/capture";
    }
}
