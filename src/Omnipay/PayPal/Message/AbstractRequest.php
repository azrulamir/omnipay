<?php

/*
 * This file is part of the Omnipay package.
 *
 * (c) Adrian Macneil <adrian@adrianmacneil.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Omnipay\PayPal\Message;

/**
 * PayPal Abstract Request
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $liveEndpoint = 'https://api-3t.paypal.com/nvp';
    protected $testEndpoint = 'https://api-3t.sandbox.paypal.com/nvp';

    public function getUsername()
    {
        return $this->getParameter('username');
    }

    public function setUsername($value)
    {
        return $this->setParameter('username', $value);
    }

    public function getPassword()
    {
        return $this->getParameter('password');
    }

    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    public function getSignature()
    {
        return $this->getParameter('signature');
    }

    public function setSignature($value)
    {
        return $this->setParameter('signature', $value);
    }

    public function getSolutionType()
    {
        return $this->getParameter('solutionType');
    }

    public function setSolutionType($value)
    {
        return $this->setParameter('solutionType', $value);
    }

    public function getLandingPage()
    {
        return $this->getParameter('landingPage');
    }

    public function setLandingPage($value)
    {
        return $this->setParameter('landingPage', $value);
    }

    public function getHeaderImageUrl()
    {
        return $this->getParameter('headerImageUrl');
    }

    public function setHeaderImageUrl($value)
    {
        return $this->setParameter('headerImageUrl', $value);
    }

    protected function getBaseData($method)
    {
        $data = array();
        $data['METHOD'] = $method;
        $data['VERSION'] = '85.0';
        $data['USER'] = $this->getUsername();
        $data['PWD'] = $this->getPassword();
        $data['SIGNATURE'] = $this->getSignature();

        return $data;
    }
    
    protected function getInvoiceBaseData()
    {
        $data = array();
        $data['USER'] = $this->getUsername();
        $data['PWD'] = $this->getPassword();
        $data['SIGNATURE'] = $this->getSignature();
        
    }

    public function setCart($value)
    {
        return $this->setParameter('cart', $value);
    }

    public function getCart()
    {
        return $this->getParameter('cart');
    }
	
    public function send()
    {
        $url = $this->getEndpoint().'?'.http_build_query($this->getData());
        $httpResponse = $this->httpClient->get($url)->send();

        return $this->createResponse($httpResponse->getBody());
    }

    protected function getEndpoint()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }

    protected function createResponse($data)
    {
        return $this->response = new Response($this, $data);
    }
}
