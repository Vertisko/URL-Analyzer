<?php

namespace App\Http\Controllers;

use App\Traits\ClientUrlTrait;
use Illuminate\Http\Request;

class ClientUrlController extends Controller
{
    use ClientUrlTrait;

    public function body(Request $request)
    {
        $url = $request->input('url');
        return $this->retrieveCurlResponse(
            $this->composeBodyOptionsArray($url)
        );
    }

    public function header(Request $request)
    {
        $url = $request->input('url');
        return $this->retrieveCurlResponse(
            $this->composeHeaderOptionsArray($url)
        );
    }
}
