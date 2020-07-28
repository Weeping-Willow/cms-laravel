<?php

namespace App\Http\Requests\Articles;

use Illuminate\Foundation\Http\FormRequest;

class CreateArticleRequest extends FormRequest
{
    /**
     * @var mixed
     */
    private $name;
    /**
     * @var mixed
     */
    private $description;
    /**
     * @var mixed
     */
    private $title;
    /**
     * @var mixed
     */
    private $image;

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
            'title' => 'required|unique:articles',
            'description' => 'required',
            'content' => 'required',
            'image' => 'required|image',
            'category' => 'required'
        ];
    }
}
