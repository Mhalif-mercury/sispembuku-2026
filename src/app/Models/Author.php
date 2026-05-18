<?php

namespace App\Models;

use App\Models\Buku;
use Illuminate\Database\Eloquent\Model;
use Rupadana\ApiService\Contracts\HasAllowedFields;
use Rupadana\ApiService\Contracts\HasAllowedFilters;
use Rupadana\ApiService\Contracts\HasAllowedSorts;

class Author extends Model implements HasAllowedFields, HasAllowedFilters, HasAllowedSorts
{
    protected $fillable = ['nama', 'email'];

    public function bukus(){
        return $this->hasMany(Buku::class);
    }

    public static function getAllowedFields(): array
    {
        return ['id', 'nama', 'email', 'created_at', 'updated_at'];
    }

    public static function getAllowedSorts(): array
    {
        return ['id', 'nama', 'email', 'created_at', 'updated_at'];
    }

    public static function getAllowedFilters(): array
    {
        return ['nama', 'email'];
    }
}
