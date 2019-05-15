<?php

namespace App\Http\Controllers;

use App\Services\Web\IndexService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * @var IndexService
     */
    private $indexService;

    /**
     * IndexController constructor.
     * @param IndexService $indexService
     */
    public function __construct(IndexService $indexService)
    {
        $this->indexService = $indexService;
    }
}
