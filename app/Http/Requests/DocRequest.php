<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $validation =  $this->routeIs('documents.store') ?
            $this->createDoc() : $this->updateDocName();

        $validation['folder'] =  'nullable|exists:folders,slug';

        return $validation;
    }

    private function createDoc(): array
    {
        return ['file'  =>  'required|file|max:5000',];
    }

    private function updateDocName(): array
    {
        return ['name' => 'required|string',];
    }
}
