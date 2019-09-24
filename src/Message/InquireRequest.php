<?php

namespace Omnipay\Cardconnect\Message;

class InquireRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('transactionReference');
    	$data = array(
    		'merchid'   => $this->getMerchantId(),
    		'retref'   => $this->getTransactionReference()
    	);
        return $data;
    }

    public function sendData($data)
    {
        $response = $this->httpClient->request('GET', $this->getEndpoint($data), $this->getHeaders());

        if ($response->getStatusCode() != 200) {
            throw new \Exception($response->getReasonPhrase());
        }

        $json = json_decode($response->getBody()->getContents(), true);

        $this->response = new Response($this, [
            'respcode' => $json['respcode'] ?? null,
            'voidable' => isset($json['voidable']) && $json['voidable'] === 'Y',
            'refundable' => isset($json['refundable']) && $json['refundable'] === 'Y',
        ]);

        return $this->response;
    }

    public function getEndpoint($data)
    {
        return $this->getEndpointBase() . "/inquire/{$data['retref']}/{$data['merchid']}";
    }
}
