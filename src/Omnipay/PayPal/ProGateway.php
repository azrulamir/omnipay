<?php

/*
 * This file is part of the Omnipay package.
 *
 * (c) Adrian Macneil <adrian@adrianmacneil.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Omnipay\PayPal;

use Omnipay\Common\AbstractGateway;
use Omnipay\PayPal\Message\ProAuthorizeRequest;
use Omnipay\PayPal\Message\CaptureRequest;
use Omnipay\PayPal\Message\RefundRequest;

/**
 * PayPal Pro Class
 */
class ProGateway extends AbstractGateway
{
    public function getName()
    {
        return 'PayPal Pro';
    }

    public function getDefaultParameters()
    {
        return array(
            'username' => 'clickrf-facilitator_api1.clickphotos.asia',
            'password' => '1370503460',
            'signature' => 'AiPC9BjkCyDFQXbSkoZcgqH3hpacArVIP5-c3gTKpsUzlDAiE4TQzpuM',
            //'username' => 'clickrf_api1.clickphotos.asia',
            //'password' => 'G8DQHK8KXTZQYRP5',
            //'signature' => 'Ag9JVlxjw6oaChFMFT7yJtPzsVOVAOXxGKZ8sNK.agiZAuHpcdeRop-o',
            'testMode' => true,
        );
    }

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

    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PayPal\Message\ProAuthorizeRequest', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PayPal\Message\ProPurchaseRequest', $parameters);
    }

    public function capture(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PayPal\Message\CaptureRequest', $parameters);
    }

    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\PayPal\Message\RefundRequest', $parameters);
    }
}
