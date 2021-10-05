<?php

namespace App\Http\Controllers\Api\V1\Coaches;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Filter\CoachFilterRequest;
use App\Http\Resources\CoachFullResource;
use App\Http\Resources\CoachResource;
use App\Models\Coach;

class QueryController extends Controller
{
    /**
     * @param CoachFilterRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(CoachFilterRequest $request)
    {
        $coaches = new Coach();
        $data = $request->all();
        if ($request->exists('search')) {
            $coaches = $coaches
                ->where(function ($query) use ($data) {
                    $query->where('first_name', 'LIKE', '%' . $data['search'] . '%');
                    $query->orWhere('last_name', 'LIKE', '%' . $data['search'] . '%');
                    $query->orWhere('surname', 'LIKE', '%' . $data['search'] . '%');
                });
        }
        $coaches = $coaches->orderBy('created_at', 'DESC')->paginate(20);
        return CoachFullResource::collection($coaches);
    }

    /**
     * @param $id
     * @return CoachFullResource
     */
    public function show($id)
    {
        return new CoachFullResource(Coach::find($id));
    }
}
