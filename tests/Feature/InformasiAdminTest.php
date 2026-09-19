<?php

namespace Tests\Feature;

use App\Models\Informasi;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class InformasiAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_informasi_with_extra_images(): void
    {
        Storage::fake('public');

        $user = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@example.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        $response = $this->actingAs($user)->post(route('admin.informasi.store'), [
            'title' => 'Judul Informasi Test',
            'slug' => 'judul-informasi-test',
            'summary' => 'Ringkasan informasi test',
            'content' => 'Konten informasi test',
            'country' => 'Indonesia',
            'tags' => "tag1\ntag2",
            'image' => UploadedFile::fake()->image('main.jpg'),
            'image_2' => [
                UploadedFile::fake()->image('extra1.jpg'),
                UploadedFile::fake()->image('extra2.jpg'),
            ],
        ]);

        $response->assertRedirect(route('admin.informasi.index'));
        $this->assertDatabaseHas('informasi', [
            'title' => 'Judul Informasi Test',
            'slug' => 'judul-informasi-test',
        ]);

        $informasi = Informasi::where('slug', 'judul-informasi-test')->firstOrFail();
        $this->assertCount(2, $informasi->extraImages());
    }
}
