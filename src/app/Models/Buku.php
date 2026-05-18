<?php

namespace App\Models;

use App\Models\Author;
use App\Models\Peminjaman;
use Illuminate\Database\Eloquent\Model;
use Rupadana\ApiService\Contracts\HasAllowedFields;
use Rupadana\ApiService\Contracts\HasAllowedFilters;
use Rupadana\ApiService\Contracts\HasAllowedSorts;

class Buku extends Model implements HasAllowedFields, HasAllowedFilters, HasAllowedSorts
{
    protected $fillable = ['judul', 'isbn', 'author_id', 'kuantitas'];

    public function author(){
        return $this->belongsTo(Author::class, 'author_id');
    }

    public function peminjaman(){
        return $this->hasMany(Peminjaman::class, 'buku_id');
    }

    public static function getAllowedFields(): array
    {
        return ['id', 'judul', 'isbn', 'author_id', 'kuantitas', 'created_at', 'updated_at'];
    }

    public static function getAllowedSorts(): array
    {
        return ['id', 'judul', 'isbn', 'kuantitas', 'created_at', 'updated_at'];
    }

    public static function getAllowedFilters(): array
    {
        return ['judul', 'isbn', 'author_id', 'kuantitas'];
    }
}
