<?php

namespace App\Http\Controllers\Api\V1\Clubs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ClubRequest;
use App\Http\Resources\ClubResource;
use App\Http\Response\ClientResponse;
use App\Models\Club;
use Illuminate\Http\Request;

class CommandController extends Controller
{
    /**
     * @param ClubRequest $request
     * @return ClubResource
     */
    public function store(ClubRequest $request)
    {
        $club = new Club();
        $this->_save($club, $request->all());
        return new ClubResource($club);
    }

    /**
     * @param ClubRequest $request
     * @param $id
     * @return ClubResource
     */
    public function update(ClubRequest $request, $id)
    {
        $club = Club::find($id);
        $this->_save($club, $request->all(),true);
        return new ClubResource($club);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $league = Club::find($id);
        $league->delete();
        return ClientResponse::success('Club deleted successfully');
    }

    /**
     * @param Club $club
     * @param array $data
     * @param false $is_update
     */
    public function _save(Club &$club, array $data, $is_update = false)
    {
//        if(!$is_update) {
        // we can add restrictions - for example do not update league id while club updated
//        }
        $club->name = $data['name'];
        if(isset($data['league_id']))
        $club->league_id = $data['league_id'];
        if(isset($data['foundation_date']))
        $club->foundation_date = $data['foundation_date'];
        $club->save();
    }
}
