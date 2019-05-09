<?php

namespace App\Http\Controllers;

use App\Services\Web\AnalyzerService;
use Illuminate\Http\Request;


class AnalyzerController extends Controller
{

    /**
     * @var AnalyzerService
     */
    private $analyzerService;

    /**
     * AnalyzerController constructor.
     * @param AnalyzerService $analyzerService
     */
    public function __construct(AnalyzerService $analyzerService)
    {

        $this->analyzerService = $analyzerService;
    }

    public function analyze(Request $request)
    {
        return $this->analyzerService->analyze($request);
    }

}



