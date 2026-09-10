<?php

namespace App\Http\Requests\Admin;

use App\Models\NewsInformation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class NewsInformationRequest extends FormRequest
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
        /** @var NewsInformation|null $newsInformation */
        $newsInformation = $this->route('newsInformation');

        return [
            'type' => ['required', Rule::in(['berita', 'informasi'])],
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('news_information', 'slug')->ignore($newsInformation?->id),
            ],
            'content' => ['required', 'string'],
            'summary' => ['required', 'string'],
            'image' => ['nullable', 'image', 'max:4096'],
            'country' => ['required', 'string', 'max:255'],
            'tags' => ['required', 'string'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $newsInformation = $this->route('newsInformation');
            $type = $this->input('type');
            $imageMissing = ! $this->hasFile('image') && empty($newsInformation?->image);

            if ($type === 'berita' && $imageMissing) {
                $validator->errors()->add('image', 'Gambar wajib diisi untuk konten berita.');
            }

            if ($type === 'berita') {
                $content = trim(strip_tags((string) $this->input('content')));
                $words = $content === '' ? 0 : count(preg_split('/\s+/u', $content, -1, PREG_SPLIT_NO_EMPTY));

                if ($words < 250) {
                    $validator->errors()->add('content', 'Konten berita minimal 250 kata.');
                }
            }
        });
    }
}
