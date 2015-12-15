<?php

namespace Api\Requests;

use Dingo\Api\Http\FormRequest;

class CatRequest extends FormRequest
{
	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		return [
	    	'name' => 'required|max:100',
	    	'age' => 'required|numeric|between:0,40'
    	];
	}
}