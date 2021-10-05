<?php

namespace App\Http\Controllers\Api\V1\Coaches;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CoachRequest;
use App\Http\Resources\CoachResource;
use App\Http\Response\ClientResponse;
use App\Http\Traits\GlobalFunctions;
use App\Models\Coach;
use Illuminate\Http\Request;

class CommandController extends Controller
{
    use GlobalFunctions;
    /**
     * @param CoachRequest $request
     * @return CoachResource
     */
    public function store(CoachRequest $request)
    {
        $coach = new Coach();
        $this->_save($coach, $request->all());
        return new CoachResource($coach);
    }

    /**
     * @param CoachRequest $request
     * @param $id
     * @return CoachResource
     */
    public function update(CoachRequest $request, $id)
    {
        $coach = Coach::find($id);
        $this->_save($coach, $request->all(),true);
        return new CoachResource($coach);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $coach = Coach::find($id);
        $coach->delete();
        return ClientResponse::success('Coach deleted successfully');
    }

    /**
     * @param Coach $coach
     * @param array $data
     * @param false $is_update
     */
    public function _save(Coach &$coach, array $data, $is_update = false)
    {
        if(isset($data['first_name']))
        $coach->first_name = $data['first_name'];
        if(isset($data['last_name']))
        $coach->last_name = $data['last_name'];
        if(isset($data['surname']))
        $coach->surname = $data['surname'];
        if(!$is_update)
        $coach->birthdate = $data['birthdate'];
        $coach->save();
        if(isset($data['club_ids'])) {
            $this->saveMany($coach,'clubs',$data['club_ids']);
        }
    }
}
