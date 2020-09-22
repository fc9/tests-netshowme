<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /*
     * Validation rules applied to data.
     *
     * @var array
     */
    protected $rules;

    /*
     * Filters applied to data.
     *
     * @var array
     */
    protected $filters;

    /**
     * ContactRequest constructor.
     *
     * @param array $query
     * @param array $request
     * @param array $attributes
     * @param array $cookies
     * @param array $files
     * @param array $server
     * @param null $content
     */
    public function __construct(
        array $query = [],
        array $request = [],
        array $attributes = [],
        array $cookies = [],
        array $files = [],
        array $server = [],
        $content = null)
    {
        parent::__construct($query, $request, $attributes, $cookies, $files, $server, $content);

        $request = $rules = config('contact.request');
        $this->rules = $request['rules'];
        $this->filters = $request['filters'];
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
            'name' => $this->rules['name'],
            'email' => $this->rules['email'],
            'phone' => $this->rules['phone'],
            'message' => $this->rules['message'],
            'attachment' => $this->rules['attachment']
        ];
    }

    /**
     * @inheritDoc
     */
    public function filters()
    {
        return [
            'name' => $this->filters['name'],
            'email' => $this->filters['email'],
            'phone' => $this->filters['phone'],
            'message' => $this->filters['message']
        ];
    }
}
