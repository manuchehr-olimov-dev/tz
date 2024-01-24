<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Requests\FilterRequestsRequest;
use App\Http\Requests\PutRequestRequest;
use App\Http\Requests\StoreRequestRequest;
use App\Mail\RequestCommented;
use App\Models\Request;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class RequestController
{

    public function create(StoreRequestRequest $request): JsonResponse
    {
        $store = Request::query()->create([
            'name' => $request->validated('name'),
            'email' => $request->validated('email'),
            'message' => $request->validated('message'),
            'updated_at' => null
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

    public function read(FilterRequestsRequest $request): JsonResponse
    {
        $requests = Request::query()
            ->filtered($request)
            ->get();

        return response()->json([
            "requests" => $requests
        ]);
    }
    public function put(PutRequestRequest $request, $id): JsonResponse
    {
        $result = Request::query()
                    ->where('id', $id)
                    ->update([
//                        'status' => 'Resolved',
                        'comment' => $request->validated('comment'),
                        'updated_at' => now()
                    ]);

        if($result){

            Mail::to("hell123o@example.com")
                ->send(new RequestCommented(Request::findOrFail($id)));

            return response()->json([
                'result' => 'Ответ успешно отправлен',
                'request' => Request::query()->findOrFail($id)->first()
            ]);

        } else {
            return response()->json([
                'result' => 'Произошла ошибка. Попробуйте попозже...'
            ]);
        }
    }
    public function solveRequestPage($id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('solve-request', [
            "request" => Request::query()
                ->where('id', $id)
                ->select(['id', 'name', 'message', 'status', 'email'])
                ->first()
        ]);
    }
}
