<?php
namespace App\Filament\Admin\Resources\AuthorResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Admin\Resources\AuthorResource;
use App\Filament\Admin\Resources\AuthorResource\Api\Requests\CreateAuthorRequest;

class CreateHandler extends Handlers {
    public static string | null $uri = '/';
    public static string | null $resource = AuthorResource::class;

    public static function getMethod()
    {
        return Handlers::POST;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }

    /**
     * Create Author
     *
     * @param CreateAuthorRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(CreateAuthorRequest $request)
    {
        $model = new (static::getModel());

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Create Resource");
    }
}