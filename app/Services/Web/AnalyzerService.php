<?php


namespace App\Services\Web;


use App\Traits\ClientUrlTrait;
use Illuminate\Http\Request;

class AnalyzerService
{
    use ClientUrlTrait;
    /**
     * @var HttpService
     */
    private $httpService;
    /**
     * @var ImageAltService
     */
    private $imageAltService;
    /**
     * @var GzipEncodingService
     */
    private $gzipEncodingService;
    /**
     * @var PageSpeedInsightService
     */
    private $pageSpeedInsightService;
    /**
     * @var IndexService
     */
    private $indexService;
    /**
     * @var ImageWebPService
     */
    private $imageWebPService;

    /**
     * AnalyzerService constructor.
     * @param HttpService $httpService
     * @param ImageAltService $imageAltService
     * @param GzipEncodingService $gzipEncodingService
     * @param PageSpeedInsightService $pageSpeedInsightService
     * @param IndexService $indexService
     * @param ImageWebPService $imageWebPService
     */
    public function __construct(
        HttpService $httpService, ImageAltService $imageAltService, GzipEncodingService $gzipEncodingService,
        PageSpeedInsightService $pageSpeedInsightService, IndexService $indexService, ImageWebPService $imageWebPService)
    {
        $this->httpService = $httpService;
        $this->imageAltService = $imageAltService;
        $this->gzipEncodingService = $gzipEncodingService;
        $this->pageSpeedInsightService = $pageSpeedInsightService;
        $this->indexService = $indexService;
        $this->imageWebPService = $imageWebPService;
    }

    public function analyze(Request $request): array
    {
        $url = $request->input('url');
        $body = $this->retrieveCurlResponse($this->composeBodyOptionsArray($url));
        $header = $this->retrieveCurlResponse($this->composeHeaderOptionsArray($url));;
        $result = array();
        if ($body["statusCode"] <> 200) {
            return [];
        }
        //1. status code
        $result["statusCode"] = $body["statusCode"];
        //2. http2.0 test
        $result["httpTest"] = $this->httpService->httpTest($header["response"]);
        //3. gzip test
        $result["gzipTest"] = $this->gzipEncodingService->gzipTest($header["response"]);
        //4. image/webP test
        $result["webPTest"] = $this->imageWebPService->webPTest($body["response"]);
        //5. index test
        $result["indexTest"] = $this->indexService->indexTest($header["response"], $url);
        //6. image alts test
        $result["imageAltsTest"] = $this->imageAltService->altsComputation($body["response"]);
        //7. page speed insight analysis output
        $result["insight"] = $this->pageSpeedInsightService->insightAnalysisReview($url);

        return $result;
    }


}