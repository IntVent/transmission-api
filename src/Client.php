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
    public function __construct(
        string $username,
        string $password,
        string $depot,
        string $verlader,
        string $versleuteld = '0'
    ) {
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

    public function getAdr(string $unnummer)
    {
        return $this->soapClient->__soapCall('getAdr', [
            'getAdr' => array_merge($this->oLogin, [
                'unnummer' => $unnummer,
            ]),
        ]);
    }

    public function getPkgebied()
    {
        return $this->soapClient->__soapCall('getPkgebied', [
            'getPkgebied' => $this->oLogin,
        ]);
    }

    public function addOpdracht(
        string $type,
        ?string $nrorder,
        ?string $nrbordero,
        string $datum,
        string $afznaam,
        string $afznaam2,
        string $afzstraat,
        string $afzhuisnr,
        string $afzpostcode,
        string $afzplaats,
        string $afzland,
        string $afztelefoon,
        string $afzemail,
        string $geanaam,
        string $geanaam2,
        string $geastraat,
        string $geahuisnr,
        string $geapostcode,
        string $geaplaats,
        string $gealand,
        string $geatelefoon,
        string $geaemail,
        string $geazoek,
        string $instructie,
        string $rembours,
        array $aPlus,
        array $aRegel,
        $zaterdag
    )
    {
        return $this->soapClient->__soapCall('addOpdracht', [
            'addOpdracht' => array_merge($this->oLogin, [
                'type' => $type,
                'nrorder' => $nrorder,
                'nrbordero' => $nrbordero,
                'datum' => $datum,
                'afznaam' => $afznaam,
                'afznaam2' => $afznaam2,
                'afzstraat' => $afzstraat,
                'afzhuisnr' => $afzhuisnr,
                'afzpostcode' => $afzpostcode,
                'afzplaats' => $afzplaats,
                'afzland' => $afzland,
                'afztelefoon' => $afztelefoon,
                'afzemail' => $afzemail,
                'geanaam' => $geanaam,
                'geanaam2' => $geanaam2,
                'geastraat' => $geastraat,
                'geahuisnr' => $geahuisnr,
                'geapostcode' => $geapostcode,
                'geaplaats' => $geaplaats,
                'gealand' => $gealand,
                'geatelefoon' => $geatelefoon,
                'geaemail' => $geaemail,
                'geazoek' => $geazoek,
                'instructie' => $instructie,
                'rembours' => $rembours,
                'aPlus' => $aPlus,
                'aRegel' => $aRegel,
                'zaterdag' => $zaterdag,
            ]),
        ]);
    }

    public function delOpdracht(string $nrzend)
    {
        return $this->soapClient->__soapCall('delOpdracht', [
            'delOpdracht' => array_merge($this->oLogin, [
                'nrzend' => $nrzend,
            ]),
        ]);
    }

    public function getAdresNL_2(string $postcode)
    {
        return $this->soapClient->__soapCall('getAdresNL_2', [
            'getAdresNL_2' => array_merge($this->oLogin, [
                'postcode' => $postcode,
            ]),
        ]);
    }

    /**
     * Get verzendlijst which is a base64encoded string.
     * @return string
     */
    public function getVerzendlijst()
    {
        return $this->soapClient->__soapCall('getVerzendlijst', [
            'getVerzendlijst' => $this->oLogin,
        ]);
    }

    public function getLabels(array $labels)
    {
        return $this->soapClient->__soapCall('getLabels', [
            'getLabels' => array_merge($this->oLogin, [
                'aNrzend' => $labels,
            ]),
        ]);
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

        return array_map(fn($item) => (new Afhaalpunt($item))->toArray(), $points);
    }
}
