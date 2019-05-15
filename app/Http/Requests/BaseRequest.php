<?php

namespace App\Http\Requests;

use App\Services\Validation\ValidateService;
use Illuminate\Foundation\Http\FormRequest;

class BaseRequest extends FormRequest
{
    /**
     * @var ValidateService
     */
    protected $validateService;


    public function __construct(ValidateService $validateService)
    {
        parent::__construct();
        $this->validateService = $validateService;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

        ];
    }
}
