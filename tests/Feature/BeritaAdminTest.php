<?php

namespace Tests\Feature;

use App\Models\Berita;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class BeritaAdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_berita_with_extra_images(): void
    {
        Storage::fake('public');

        $user = User::create([
            'name' => 'Admin Test',
            'email' => 'admin@example.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        $content = implode(' ', array_fill(0, 260, 'kata'));

        $response = $this->actingAs($user)->post(route('admin.berita.store'), [
            'title' => 'Judul Berita Test',
            'slug' => 'judul-berita-test',
            'summary' => 'Ringkasan berita test',
            'content' => $content,
            'country' => 'Indonesia',
            'tags' => "tag1\ntag2",
            'image' => UploadedFile::fake()->image('main.jpg'),
            'image_2' => [
                UploadedFile::fake()->image('extra1.jpg'),
                UploadedFile::fake()->image('extra2.jpg'),
            ],
        ]);

        $response->assertRedirect(route('admin.berita.index'));
        $this->assertDatabaseHas('berita', [
            'title' => 'Judul Berita Test',
            'slug' => 'judul-berita-test',
        ]);

        $berita = Berita::where('slug', 'judul-berita-test')->firstOrFail();
        $this->assertCount(2, $berita->extraImages());
    }
}
