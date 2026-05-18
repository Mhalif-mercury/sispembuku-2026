<?php
namespace App\Filament\Admin\Resources\AuthorResource\Api;

use Rupadana\ApiService\ApiService;
use App\Filament\Admin\Resources\AuthorResource;
use Illuminate\Routing\Router;


class AuthorApiService extends ApiService
{
    protected static string | null $resource = AuthorResource::class;

    public static function handlers() : array
    {
        return [
            Handlers\CreateHandler::class,
            Handlers\UpdateHandler::class,
            Handlers\DeleteHandler::class,
            Handlers\PaginationHandler::class,
            Handlers\DetailHandler::class
        ];

    }
}
