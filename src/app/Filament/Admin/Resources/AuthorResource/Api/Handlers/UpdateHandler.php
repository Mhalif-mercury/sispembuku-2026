<?php
namespace App\Filament\Admin\Resources\AuthorResource\Api\Handlers;

use Illuminate\Http\Request;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Admin\Resources\AuthorResource;
use App\Filament\Admin\Resources\AuthorResource\Api\Requests\UpdateAuthorRequest;

class UpdateHandler extends Handlers {
    public static string | null $uri = '/{id}';
    public static string | null $resource = AuthorResource::class;

    public static function getMethod()
    {
        return Handlers::PUT;
    }

    public static function getModel() {
        return static::$resource::getModel();
    }


    /**
     * Update Author
     *
     * @param UpdateAuthorRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function handler(UpdateAuthorRequest $request)
    {
        $id = $request->route('id');

        $model = static::getModel()::find($id);

        if (!$model) return static::sendNotFoundResponse();

        $model->fill($request->all());

        $model->save();

        return static::sendSuccessResponse($model, "Successfully Update Resource");
    }
}