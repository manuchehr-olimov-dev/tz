<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Requests\StoreRequestRequest;
use App\Models\Request;
use Illuminate\Http\JsonResponse;

class RequestController
{

    public function create(StoreRequestRequest $request): JsonResponse
    {
        $store = Request::query()->create([
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'message' => $request->validated('message')
        ]);

        if(!$store){
            return \response()->json([
                "result" => "Произошла ошибка при отправке заявки. Попробуйте зайти попозже..."
            ]);
        } else {
            return \response()->json([
                "result" => "Заявка успешно отправлена."
            ]);
        }
    }

    public function read()
    {
        return view('requests', ['requests' => ]);
    }
}
