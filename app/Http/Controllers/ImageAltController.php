<?php

namespace App\Http\Controllers;

use App\Services\Web\ImageAltService;
use App\Traits\ClientUrlTrait;
use Illuminate\Http\Request;

class ImageAltController extends Controller
{
    use ClientUrlTrait;
    /**
     * @var ImageAltService
     */
    private $imageAltService;

    /**
     * ImageAltController constructor.
     * @param ImageAltService $imageAltService
     */
    public function __construct(ImageAltService $imageAltService)
    {
        $this->imageAltService = $imageAltService;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function altsComputation(Request $request): array
    {
        $url = $request->input('url');
        $body = $this->retrieveCurlResponse($this->composeBodyOptionsArray($url));
        return $this->imageAltService->altsComputation($body["response"]);
    }
}
