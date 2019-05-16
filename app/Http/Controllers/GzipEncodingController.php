<?php

namespace App\Http\Controllers;

use App\Services\Web\GzipEncodingService;
use App\Traits\ClientUrlTrait;
use Illuminate\Http\Request;

/**
 * Class GzipEncodingController
 * @package App\Http\Controllers
 */
class GzipEncodingController extends Controller
{
    use ClientUrlTrait;
    /**
     * @var GzipEncodingService
     */
    private $gzipEncodingService;


    /**
     * GzipEncodingController constructor.
     * @param GzipEncodingService $gzipEncodingService
     */
    public function __construct(GzipEncodingService $gzipEncodingService)
    {
        $this->gzipEncodingService = $gzipEncodingService;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function gzipTest(Request $request): array
    {
        $url = $request->input('url');
        $header = $this->retrieveCurlResponse($this->composeHeaderOptionsArray($url));
        return $this->gzipEncodingService->gzipTest($header["response"]);
    }
}
