<?php

namespace Trin4ik\NovaSwitcher;

use Laravel\Nova\Http\Requests\ResourceDetailRequest;

class SwitchController
{
    public function __invoke (ResourceDetailRequest $request)
    {
        $resourceClass = $request->resource();
        $modelClass = $resourceClass::$model;
        $model = $modelClass::withoutGlobalScopes()->find($request->post('resourceId'));

        if($model) {
            $model->{$request->post('fieldName')} = (bool)$request->post('value');
            $model->save();

            return [
                'success' => true
            ];
        }

        return [
            'success' => false
        ];
    }
}
