<?php

namespace App\Http\Requests\Admin;

use App\Models\Informasi;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class InformasiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        if ($this->filled('slug')) {
            $this->merge([
                'slug' => Str::slug((string) $this->input('slug')),
            ]);
        }
    }

    public function rules(): array
    {
        /** @var Informasi|null $informasi */
        $informasi = $this->route('informasi');

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('informasi', 'slug')->ignore($informasi?->id),
            ],
            'content' => ['required', 'string'],
            'summary' => ['required', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:4096'],
            'image_2' => ['nullable', 'array'],
            'image_2.*' => ['file', 'image', 'mimes:jpg,jpeg,png', 'max:4096'],
            'country' => ['required', 'string', 'max:255'],
            'tags' => ['required', 'string'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $tags = collect(preg_split('/\r\n|\r|\n/', (string) $this->input('tags')))
                ->map(fn ($tag) => trim($tag))
                ->filter()
                ->values();

            if ($tags->count() > 10) {
                $validator->errors()->add('tags', 'Tags maksimal 10 baris, gunakan Enter untuk memisahkan.');
            }
        });
    }
}
