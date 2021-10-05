<?php

namespace App\Http\Controllers\Api\V1\Leagues;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LeagueRequest;
use App\Http\Resources\LeagueResource;
use App\Http\Response\ClientResponse;
use App\Models\League;

class CommandController extends Controller
{
    /**
     * @param LeagueRequest $request
     * @return LeagueResource
     */
    public function store(LeagueRequest $request)
    {
        $league = new League();
        $this->_save($league, $request->all());
        return new LeagueResource($league);
    }

    /**
     * @param LeagueRequest $request
     * @param $id
     * @return LeagueResource
     */
    public function update(LeagueRequest $request, $id)
    {
        $league = League::find($id);
        $this->_save($league, $request->all());
        return new LeagueResource($league);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $league = League::find($id);
        $league->delete();
        return ClientResponse::success('League deleted successfully');
    }

    /**
     * @param League $league
     * @param array $data
     */
    public function _save(League &$league, array $data)
    {
        $league->name = $data['name'];
        $league->save();
    }
}
