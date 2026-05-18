<?php

namespace App\Filament\Admin\Resources\PeminjamanResource\Api\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePeminjamanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'buku_id' => 'required',
			'mahasiswa_id' => 'required',
			'tgl_peminjaman' => 'required|date',
			'tgl_pengembalian' => 'required|date'
		];
    }
}
