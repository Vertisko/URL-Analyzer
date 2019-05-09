<?php

namespace App\Services\Web;

class GzipEncodingService
{
    private $responseArray;

    /**
     * AnalyzerController constructor.
     */
    public function __construct()
    {
        $this->initResponseArray();
    }

    private function initResponseArray(bool $support = false)
    {
        $this->responseArray = [
            "isSupported" => $support
        ];
    }

    /**
     * @return mixed
     */
    public function getResponseArray()
    {
        return $this->responseArray;
    }

    /**
     * @param string $errorMessage
     * @return GzipEncodingService
     */
    public function setResponseArrayError(string $errorMessage): GzipEncodingService
    {
        $this->responseArray["error"] = $errorMessage;
        return $this;
    }

    /**
     * AnalyzerController constructor.
     * @param string $header
     * @return array
     */
    public function gzipTest(string $header): array
    {
        $this->responseArray["isSupported"] = (strpos($header, "content-encoding: gzip")) ? true : false;
        return $this->responseArray;
    }


}