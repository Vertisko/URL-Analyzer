<?php

namespace App\Services\Validation;

use Illuminate\Validation\Rule;

class ValidateService
{

    /**
     * HelperService constructor.
     */
    public function __construct()
    {
    }

    public function urlValidation(): array
    {
        return ['url' => 'url'];
    }
}
