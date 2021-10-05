<?php

namespace App\Http\Controllers\Api\V1\Clubs;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClubFullResource;
use App\Http\Resources\ClubResource;
use App\Models\Club;
use App\Models\League;

class QueryController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $clubs = Club::orderBy('created_at', 'DESC')->paginate(20);
        return ClubFullResource::collection($clubs);
    }

    /**
     * @param $id
     * @return ClubFullResource
     */
    public function show($id)
    {
        return new ClubFullResource(Club::find($id));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function byLeague($id)
    {
        $clubs = League::find($id)->clubs;
        return ClubFullResource::collection($clubs);
    }
}
