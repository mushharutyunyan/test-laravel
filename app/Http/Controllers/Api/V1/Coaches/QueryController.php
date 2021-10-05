<?php

namespace App\Http\Controllers\Api\V1\Coaches;

use App\Http\Controllers\Controller;
use App\Http\Resources\CoachResource;
use App\Models\Coach;
use Illuminate\Http\Request;

class QueryController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $leagues = Coach::orderBy('created_at', 'DESC')->paginate(20);
        return CoachResource::collection($leagues);
    }

    /**
     * @param $id
     * @return CoachResource
     */
    public function show($id)
    {
        return new CoachResource(Club::find($id));
    }
}
