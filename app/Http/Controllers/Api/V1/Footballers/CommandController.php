<?php

namespace App\Http\Controllers\Api\V1\Footballers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FootballerRequest;
use App\Http\Resources\FootballerResource;
use App\Http\Response\ClientResponse;
use App\Http\Traits\GlobalFunctions;
use App\Models\Footballer;
use Illuminate\Http\Request;

class CommandController extends Controller
{
    use GlobalFunctions;
    /**
     * @param FootballerRequest $request
     * @return FootballerResource
     */
    public function store(FootballerRequest $request)
    {
        $footballer = new Footballer();
        $this->_save($footballer, $request->all());
        return new FootballerResource($footballer);
    }

    /**
     * @param FootballerRequest $request
     * @param $id
     * @return FootballerResource
     */
    public function update(FootballerRequest $request, $id)
    {
        $footballer = Footballer::find($id);
        $this->_save($footballer, $request->all(),true);
        return new FootballerResource($footballer);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $footballer = Footballer::find($id);
        $footballer->delete();
        return ClientResponse::success('Footballer deleted successfully');
    }

    /**
     * @param Footballer $footballer
     * @param array $data
     * @param false $is_update
     */
    public function _save(Footballer &$footballer, array $data, $is_update = false)
    {
        if(isset($data['kicking_foot']))
            $footballer->kicking_foot = $data['kicking_foot'];
        if(isset($data['transfer_cost']))
            $footballer->transfer_cost = $data['transfer_cost'];
        if(isset($data['first_name']))
            $footballer->first_name = $data['first_name'];
        if(isset($data['last_name']))
            $footballer->last_name = $data['last_name'];
        if(isset($data['surname']))
            $footballer->surname = $data['surname'];
        if(!$is_update)
            $footballer->birthdate = $data['birthdate'];
        $footballer->save();
        if(isset($data['club_ids'])) {
            $this->saveMany($footballer,'clubs',$data['club_ids']);
        }
    }
}
