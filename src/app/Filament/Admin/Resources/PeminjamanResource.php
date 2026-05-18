<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PeminjamanResource\Pages;
use App\Filament\Admin\Resources\PeminjamanResource\RelationManagers;
use App\Models\Buku;
use App\Models\Peminjaman;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Carbon;

class PeminjamanResource extends Resource
{
    protected static ?string $model = Peminjaman::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('buku_id')
                    ->relationship(
                        name: 'buku', 
                        titleAttribute: 'judul',
                        modifyQueryUsing: fn($query) =>
                            $query->where('kuantitas', '>', 0)
                    )
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('mahasiswa_id')
                    ->relationship('mahasiswa', 'nama')
                    ->searchable()
                    ->required(),
                Forms\Components\DatePicker::make('tgl_peminjaman')
                    ->required()
                    ->default(now())
                    ->live()
                    ->afterStateUpdated(function($state, Forms\Set $set){
                        if($state){
                            $tgl_kembali = Carbon::parse($state)->addDays(7)->format('Y-m-d');
                            $set('tgl_pengembalian', $tgl_kembali);
                        }
                    }),
                Forms\Components\DatePicker::make('tgl_pengembalian')
                    ->minDate(fn (Forms\Get $get) => $get('tgl_peminjaman'))
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('buku_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('mahasiswa_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tgl_peminjaman')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tgl_pengembalian')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPeminjamen::route('/'),
            'create' => Pages\CreatePeminjaman::route('/create'),
            'edit' => Pages\EditPeminjaman::route('/{record}/edit'),
        ];
    }
}
