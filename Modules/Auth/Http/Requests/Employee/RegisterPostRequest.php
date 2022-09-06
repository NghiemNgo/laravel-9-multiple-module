<?php

namespace Modules\Auth\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterPostRequest extends FormRequest
{
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'code' => 'required|string|max:50',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees',
            'password' => 'required|string|min:8',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'code.required'     => __('auth::validation.required', ['field' => __('auth::validation.code')]),
            'name.required'     => __('auth::validation.required', ['field' => __('auth::validation.name')]),
            'email.required'    => __('auth::validation.required', ['field' => __('auth::validation.email')]),
            'password.required' => __('auth::validation.required', ['field' => __('auth::validation.password')]),
            'code.string'       => __('auth::validation.string', ['field' => __('auth::validation.code')]),
            'name.string'       => __('auth::validation.string', ['field' => __('auth::validation.name')]),
            'email.string'      => __('auth::validation.string', ['field' => __('auth::validation.email')]),
            'password.string'   => __('auth::validation.string', ['field' => __('auth::validation.password')]),
            'email.email'       => __('auth::validation.typeEmail', ['field' => __('auth::validation.email')]),
            'code.max'          => __('auth::validation.max', ['field' => __('auth::validation.code')]),
            'name.max'          => __('auth::validation.max', ['field' => __('auth::validation.name')]),
            'email.max'         => __('auth::validation.max', ['field' => __('auth::validation.email')]),
            'email.unique'      => __('auth::validation.unique', ['field' => __('auth::validation.email')]),
            'password.min'      => __('auth::validation.min', ['field' => __('auth::validation.password')]),
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();
        throw new HttpResponseException(response()->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'message' => $validator->errors()->first()
            ])
        );
    }
}
