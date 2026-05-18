<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Rupadana\ApiService\Contracts\HasAllowedFields;
use Rupadana\ApiService\Contracts\HasAllowedFilters;
use Rupadana\ApiService\Contracts\HasAllowedSorts;

class Mahasiswa extends Model implements HasAllowedFields, HasAllowedFilters, HasAllowedSorts
{
    protected $fillable = ['nama', 'nim', 'email', 'password'];

    public function peminjaman(){
        return $this->hasMany(Peminjaman::class, 'mahasiswa_id');
    }

    public static function getAllowedFields(): array
    {
        return ['id', 'nama', 'nim', 'email', 'created_at', 'updated_at'];
    }

    public static function getAllowedSorts(): array
    {
        return ['id', 'nama', 'nim', 'email', 'created_at', 'updated_at'];
    }

    public static function getAllowedFilters(): array
    {
        return ['nama', 'nim', 'email'];
    }
}
