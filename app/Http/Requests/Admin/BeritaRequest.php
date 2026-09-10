<?php

namespace App\Http\Requests\Admin;

use App\Models\Berita;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class BeritaRequest extends FormRequest
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
        /** @var Berita|null $berita */
        $berita = $this->route('berita');

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('berita', 'slug')->ignore($berita?->id),
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
            $berita = $this->route('berita');
            $imageMissing = ! $this->hasFile('image') && empty($berita?->image);

            if ($imageMissing) {
                $validator->errors()->add('image', 'Gambar wajib diisi untuk berita.');
            }

            $content = trim(strip_tags((string) $this->input('content')));
            $words = $content === '' ? 0 : count(preg_split('/\s+/u', $content, -1, PREG_SPLIT_NO_EMPTY));

            if ($words < 250) {
                $validator->errors()->add('content', 'Konten berita minimal 250 kata.');
            }

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
