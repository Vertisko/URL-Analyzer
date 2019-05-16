<?php

namespace App\Http\Controllers;

use App\Services\Web\ImageWebPService;
use Illuminate\Http\Request;

/**
 * Class ImageWebPController
 * @package App\Http\Controllers
 */
class ImageWebPController extends Controller
{
    /**
     * @var ImageWebPService
     */
    private $imageWebPService;


    /**
     * ImageWebPController constructor.
     * @param ImageWebPService $imageWebPService
     */
    public function __construct(ImageWebPService $imageWebPService)
    {
        $this->imageWebPService = $imageWebPService;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function webPTest(Request $request): array
    {
        $body = $request->input('body');
        return $this->imageWebPService->webPTest($body);
    }
}
