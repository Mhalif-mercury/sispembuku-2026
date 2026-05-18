<?php

namespace App\Models;

use App\Models\Buku;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Rupadana\ApiService\Contracts\HasAllowedFields;
use Rupadana\ApiService\Contracts\HasAllowedFilters;
use Rupadana\ApiService\Contracts\HasAllowedSorts;

class Peminjaman extends Model implements HasAllowedFields, HasAllowedFilters, HasAllowedSorts
{
    protected $fillable = ['buku_id', 'mahasiswa_id', 'tgl_peminjaman', 'tgl_pengembalian'];

    public function buku(){
        return $this->belongsTo(Buku::class, 'buku_id');
    }

    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_id');
    }

    public static function getAllowedFields(): array
    {
        return ['id', 'buku_id', 'mahasiswa_id', 'tgl_peminjaman', 'tgl_pengembalian', 'created_at', 'updated_at'];
    }

    public static function getAllowedSorts(): array
    {
        return ['id', 'buku_id', 'mahasiswa_id', 'tgl_peminjaman', 'tgl_pengembalian', 'created_at', 'updated_at'];
    }

    public static function getAllowedFilters(): array
    {
        return ['buku_id', 'mahasiswa_id', 'tgl_peminjaman', 'tgl_pengembalian'];
    }

    protected static function boot(){
        parent::boot();

        static::saving(function($model){
            if($model->tgl_pengembalian){
                $model->tgl_pengembalian = Carbon::parse($model->tgl_peminjaman)->addDays(7)->format('Y-m-d');
            }
        });

        static::created(function($peminjaman){
            $buku = $peminjaman->buku;
            $buku->decrement('kuantitas');
        });
    }
}
