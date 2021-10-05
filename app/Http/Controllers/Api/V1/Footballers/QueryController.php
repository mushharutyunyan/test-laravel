<?php

namespace App\Http\Controllers\Api\V1\Footballers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Filter\FootballerFiterRequest;
use App\Http\Resources\FootballerFullResource;
use App\Http\Resources\FootballerResource;
use App\Models\Footballer;
use Illuminate\Http\Request;

class QueryController extends Controller
{
    /**
     * @param FootballerFiterRequest $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(FootballerFiterRequest $request)
    {
        $data = $request->all();
        $footballers = new Footballer();

        if($request->exists('kicking_foot')) {
            $footballers = $footballers->where('kicking_foot',$data['kicking_foot']);
        }
        if($request->exists('min_transfer_cost')) {
            $footballers = $footballers->where('transfer_cost','<=',$data['min_transfer_cost']);
        }
        if($request->exists('max_transfer_cost')) {
            $footballers = $footballers->where('transfer_cost','<=',$data['max_transfer_cost']);
        }
        if($request->exists('search')) {
            $footballers = $footballers
                ->where(function($query) use($data){
                    $query->where('first_name', 'LIKE', '%' . $data['search'] . '%');
                    $query->orWhere('last_name', 'LIKE', '%' . $data['search'] . '%');
                    $query->orWhere('surname', 'LIKE', '%' . $data['search'] . '%');
                });
        }
        $footballers = $footballers->orderBy('created_at', 'DESC')->paginate(20);
        return FootballerFullResource::collection($footballers);
    }

    /**
     * @param $id
     * @return FootballerFullResource
     */
    public function show($id)
    {
        return new FootballerFullResource(Footballer::find($id));
    }
}
