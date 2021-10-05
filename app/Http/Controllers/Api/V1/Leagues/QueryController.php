<?php

namespace App\Http\Controllers\Api\V1\Leagues;

use App\Http\Controllers\Controller;
use App\Http\Resources\LeagueResource;
use App\Models\League;

class QueryController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $leagues = League::orderBy('created_at', 'DESC')->paginate(20);
        return LeagueResource::collection($leagues);
    }

    /**
     * @param $id
     * @return LeagueResource
     */
    public function show($id)
    {
        return new LeagueResource(League::find($id));
    }
}
