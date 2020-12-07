<?php

namespace IntVent\Transmission;

use SoapClient;

class Client
{
    protected SoapClient $soapClient;
    protected string $username;
    protected string $password;
    protected string $wsdl = 'http://portal.trans-mission.nl/webservices/TMSOnline.wsdl';

    /**
     * Client constructor.
     *
     * @param string $username
     * @param string $password
     */
    public function __construct(string $username, string $password)
    {
        $this->username = $username;
        $this->password = $password;
    }
}
