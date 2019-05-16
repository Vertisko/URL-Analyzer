<?php

namespace App\Http\Controllers;

use App\Services\Web\HttpService;
use App\Traits\ClientUrlTrait;
use Illuminate\Http\Request;

/**
 * Class HttpController
 * @package App\Http\Controllers
 */
class HttpController extends Controller
{
    use ClientUrlTrait;
    /**
     * @var HttpService
     */
    private $httpService;
    /**
     * HttpController constructor.
     * @param HttpService $httpService
     */
    public function __construct(HttpService $httpService)
    {
        $this->httpService = $httpService;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function httpTest(Request $request): array
    {
        $url = $request->input('url');

        $header = $this->retrieveCurlResponse(
            $this->composeHeaderOptionsArray($url)
        );
        return $this->httpService->httpTest($header["response"]);
    }
}
