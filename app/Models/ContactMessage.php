<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    public const STATUS_PERLU_DITINJAU = 'perlu_ditinjau';
    public const STATUS_DIFOLLOWUP = 'difollowup';
    public const STATUS_SELESAI = 'selesai';

    protected $fillable = ['nama', 'email', 'pesan', 'status', 'is_read'];

    protected $attributes = [
        'status' => self::STATUS_PERLU_DITINJAU,
    ];

    protected $casts = ['is_read' => 'boolean'];

    /**
     * Daftar status yang valid beserta label & warna badge-nya.
     */
    public static function statusOptions(): array
    {
        return [
            self::STATUS_PERLU_DITINJAU => ['label' => 'Perlu Ditinjau', 'color' => 'danger'],
            self::STATUS_DIFOLLOWUP => ['label' => 'Sedang Difollow Up', 'color' => 'warning'],
            self::STATUS_SELESAI => ['label' => 'Sudah Selesai', 'color' => 'success'],
        ];
    }

    public function statusLabel(): string
    {
        return self::statusOptions()[$this->status]['label'] ?? $this->status;
    }

    public function statusColor(): string
    {
        return self::statusOptions()[$this->status]['color'] ?? 'gray';
    }
}
