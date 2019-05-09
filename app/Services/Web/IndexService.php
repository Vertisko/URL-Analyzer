<?php

namespace App\Services\Web;


use App\Traits\ClientUrlTrait;
use RobotsTxtParser;
use vipnytt\XRobotsTagParser;

class IndexService
{
    use ClientUrlTrait;

    private $responseArray;

    public function __construct()
    {
        $this->initResponseArray();
    }


    /**
     * @return void
     */
    private function initResponseArray(): void
    {
        $this->responseArray = [
            "robotsFile" => array(), "metaTag" => array(), "xRobotTag" => array()
        ];
    }

    /**
     * @param bool $exists
     * @param bool $isIndexed
     * @return array
     */
    private function initPartArray(bool $exists = false, bool $isIndexed = true): array
    {
        return ["exists" => $exists, "isIndexed" => $isIndexed];
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
     * @return IndexService
     */
    public function setResponseArrayError(string $errorMessage): IndexService
    {
        $this->responseArray["error"] = $errorMessage;
        return $this;
    }


    public function indexTest(string $header, string $url): array
    {
        $this->initResponseArray();
        $this->lookupMetaTag($url);
        $this->lookupRobotsFile($url);
        $this->lookupXRobotTag($header);

        return $this->getResponseArray();

    }

    private function lookupXRobotTag(string $header)
    {
        //DUMMY HEADER
//        $header = <<<STRING
//        HTTP/1.1 200 OK
//        Date: Tue, 25 May 2010 21:42:43 GMT
//        X-Robots-Tag: nofollow, noindex
//STRING;

        $result = $this->initPartArray();
        $rules = $this->retrieveXRobotRules($header);
        //         rules for agent * found
        if (!empty($rules)) {
            $result["exists"] = true;
            if (isset($rules['noindex'])) {
                $result["isIndexed"] = !$rules['noindex'];
            }
        }
        $this->responseArray["xRobotTag"] = $result;

    }

    private function retrieveXRobotRules(string $header): array
    {
        $parser = new XRobotsTagParser\Adapters\TextString($header, '*');
        return $parser->getRules();
    }

    private function lookupRobotsFile(string $url): void
    {
        $result = $this->initPartArray();
        $robotsFileBody = $this->retrieveCurlResponse($this->composeBodyOptionsArray("$url/robots.txt"));
//         robots.txt file found
        if ($robotsFileBody["statusCode"] == 200) {
            $result = $this->robotTsFileIndexTest($result, $robotsFileBody["response"], '*');
        }
        $this->responseArray["robotsFile"] = $result;

    }

    private function robotTsFileIndexTest(array $result, string $robotsFileBody, string $agent): array
    {
        $result["exists"] = true;
        $parser = new RobotsTxtParser($robotsFileBody);
        $parser->setUserAgent($agent);
        $result["isIndexed"] = $parser->isAllowed('/') ? true : false;
        return $result;

    }

    private function lookupMetaTag(string $url): void
    {
        $result = $this->initPartArray();
        $tags = get_meta_tags($this->enforceHttpsProtocol($url));

//        meta tag found
        if (isset($tags["robots"])) {
            $result["exists"] = true;
            $result["isIndexed"] = (stripos($tags["robots"], "noindex")) ? false : true;

        }
        $this->responseArray["metaTag"] = $result;
    }
}