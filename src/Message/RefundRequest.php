<?php

namespace Omnipay\Cardconnect\Message;

class RefundRequest extends AbstractRequest
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
        return $this->getEndpointBase() . "/refund";
    }
}
