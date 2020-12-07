<?php

namespace IntVent\Transmission;

use IntVent\Transmission\Exceptions\TransmissionSoapException;
use IntVent\Transmission\Models\Afhaalpunt;
use SoapClient;
use SoapFault;

class Client
{
    protected SoapClient $soapClient;
    protected array $oLogin = [];
    protected string $password;
    protected string $depot;
    protected string $verlader;
    protected string $versleuteld;
    protected string $wsdl = 'http://portal.trans-mission.nl/webservices/TMSOnline.wsdl';

    /**
     * Client constructor.
     *
     * @param  string  $username
     * @param  string  $password
     * @param  string  $depot
     * @param  string  $verlader
     * @param  string  $versleuteld
     * @throws TransmissionSoapException
     */
    public function __construct(string $username, string $password, string $depot, string $verlader, string $versleuteld = '0')
    {
        $this->oLogin['username'] = $username;
        $this->oLogin['password'] = $password;
        $this->oLogin['depot'] = $depot;
        $this->oLogin['verlader'] = $verlader;
        $this->oLogin['versleuteld'] = $versleuteld;

        try {
            $this->soapClient = new SoapClient($this->wsdl);
        } catch (SoapFault $exception) {
            throw new TransmissionSoapException($exception->getMessage());
        }
    }

    /**
     * @return array
     */
    public function getAfhaalpunt(): array
    {
        $points = $this->soapClient->__soapCall('getAfhaalpunt', [
            'getAfhaalpunt' => $this->oLogin,
        ]);

        if (! is_array($points)) {
            return [];
        }

        return array_map(fn ($item) => (new Afhaalpunt($item))->toArray(), $points);
    }
}
