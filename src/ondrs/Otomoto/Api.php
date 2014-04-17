<?php
/**
 * Created by PhpStorm.
 * User: Ondra
 * Date: 22.2.14
 * Time: 11:11
 */

namespace ondrs\Otomoto;


class Api
{

    /** @var string */
    private $username;

    /** @var string */
    private $key;

    /** @var string */
    private $iv;

    /** @var int */
    private $clientId;

    /** @var \SoapClient */
    private $client;


    /**
     * @param string $username
     * @param string $key
     * @param string $iv
     * @param string $ip
     */
    public function __construct($username, $key, $iv, $ip)
    {
        $this->username = $username;
        $this->key = $key;
        $this->iv = $iv;
        $this->ip = $ip;
    }


    /**
     * @param int $clientId
     * @return $this
     */
    public function createClient($clientId)
    {
        $this->clientId = $clientId;

        $this->client = new \SoapClient('http://dataservice.otomoto.cz/import.svc?wsdl', array(
            'soap_version' => SOAP_1_1,
            'connection_timeout' => 15,
            'trace' => 1,
        ));

        return $this;
    }


    /**
     * @return int
     */
    public function getClientId()
    {
        return $this->clientId;
    }


    /**
     * @param null|string $input
     * @return string
     */
    public function generateKey($input = NULL)
    {
        $text = $input === NULL ? $this->username . ';' . date('d/m/Y H:i:s') . ';' . $this->ip : $input;

        $cipher = new \Crypt_Rijndael();
        $cipher->setKeyLength(256);
        $cipher->setBlockLength(128);
        $cipher->setKey(base64_decode($this->key));
        $cipher->setIV(base64_decode($this->iv));

        return base64_encode($cipher->encrypt($text));
    }


    /**
     * @return mixed
     * @throws OtomotoException
     */
    public function advertQuickList()
    {
        try {
            $result = $this->client->AdvertQuickList(array(
                'request' => array(
                    'Username' => $this->username,
                    'AutorizationKey' => $this->generateKey(),
                    'ClientId' => array(
                        $this->clientId
                    ),
                ),
            ));

            if(!$result->AdvertQuickListResult->IsOk) {
                throw new OtomotoException($result->EnumListResult->Message);
            }

            return $result->AdvertQuickListResult->Advert->WSAdvertResult;

        } catch(\Exception $e) {
            throw new OtomotoException($e->getMessage(), $e->getCode());
        }

    }


    /**
     * @param array $adverts of Advert
     * @return mixed
     * @throws OtomotoException
     */
    public function advertSave(array $adverts)
    {
        try {
            $result = $this->client->AdvertSave(array(
                'request' => array(
                    'Username' => $this->username,
                    'AutorizationKey' => $this->generateKey(),
                    'Advert' => $adverts,
                ),
            ));

            if(!$result->AdvertQuickListResult->IsOk) {
                throw new OtomotoException($result->EnumListResult->Message);
            }

            return $result;

        } catch(\Exception $e) {
            throw new OtomotoException($e->getMessage(), $e->getCode());
        }
    }


    /**
     * @param array $adverts of AdvertStatus
     * @return mixed
     * @throws OtomotoException
     */
    public function advertChangeStatus(array $adverts)
    {
        try {
            $result = $this->client->AdvertChangeStatus(array(
                'request' => array(
                    'Username' => $this->username,
                    'AutorizationKey' => $this->generateKey(),
                    'Advert' => $adverts,
                ),
            ));

            if(!$result->AdvertQuickListResult->IsOk) {
                throw new OtomotoException($result->EnumListResult->Message);
            }

            return $result;

        } catch(\Exception $e) {
            throw new OtomotoException($e->getMessage(), $e->getCode());
        }
    }


    /**
     * @return mixed
     * @throws OtomotoException
     */
    public function enumList()
    {
        $result = $this->client->EnumList();

        try {
            if(!$result->EnumListResult->IsOk) {
                throw new OtomotoException($result->EnumListResult->Message);
            }

            return $result->EnumListResult->Enum->WSEnum;

        } catch(\Exception $e) {
            throw new OtomotoException($e->getMessage(), $e->getCode());
        }
    }


    /**
     * @param $enumId
     * @return mixed
     * @throws OtomotoException
     */
    public function enumValueList($enumId)
    {
        $result =  $this->client->EnumValueList(array(
            'enumId' => $enumId,
        ));

        try {
            if(!$result->EnumValueListResult->IsOk) {
                throw new OtomotoException($result->EnumValueListResult->Message);
            }

            return $result->EnumValueListResult->Value->WSEnumValue;

        } catch(\Exception $e) {
            throw new OtomotoException($e->getMessage(), $e->getCode());
        }
    }



}
