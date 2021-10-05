<?php

namespace App\Http\Controllers\Api\V1\Footballers;

use App\Http\Controllers\Controller;
use App\Http\Resources\FootballerResource;
use App\Models\Footballer;
use Illuminate\Http\Request;

class QueryController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $leagues = Footballer::orderBy('created_at', 'DESC')->paginate(20);
        return FootballerResource::collection($leagues);
    }

    /**
     * @param $id
     * @return FootballerResource
     */
    public function show($id)
    {
        return new FootballerResource(Footballer::find($id));
    }
}
