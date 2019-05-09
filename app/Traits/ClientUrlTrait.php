<?php

namespace App\Traits;

trait ClientUrlTrait
{

    /**
     * @param array $options
     * @return array
     */

    public
    function retrieveCurlResponse(array $options): array
    {

        $curlHandler = curl_init();
        curl_setopt_array($curlHandler, $options);
        $response = curl_exec($curlHandler);
        $status = curl_getinfo($curlHandler, CURLINFO_HTTP_CODE);
        curl_close($curlHandler);

        return ["response" => utf8_encode($response), "statusCode" => $status];
    }


    /**
     * @param string $url
     * @return array
     */
    public
    function composeHeaderOptionsArray(string $url): array
    {
        return [
            CURLOPT_URL => $this->enforceHttpsProtocol($url),
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_2_0,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HEADER => true,
            CURLOPT_NOBODY => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10
        ];
    }

    public
    function composeBodyOptionsArray(string $url): array
    {
        return [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
        ];
    }


    private function enforceHttpsProtocol(string $url)
    {
        $url = preg_replace("/^http:/i", "https:", $url);
        if (false === strpos($url, '://')) {
            $url = 'https://' . $url;
        }
        return $url;
    }

}