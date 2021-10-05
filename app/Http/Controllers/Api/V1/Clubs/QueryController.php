<?php

namespace App\Http\Controllers\Api\V1\Clubs;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClubResource;
use App\Models\Club;

class QueryController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $leagues = Club::orderBy('created_at', 'DESC')->paginate(20);
        return ClubResource::collection($leagues);
    }

    /**
     * @param $id
     * @return ClubResource
     */
    public function show($id)
    {
        return new ClubResource(Club::find($id));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function byLeague($id)
    {
        $leagues = Club::where('league_id',$id)->get();
        return ClubResource::collection($leagues);
    }
}
