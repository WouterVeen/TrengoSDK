<?php


namespace TheCodeBakery\Trengo\Api\Traits;

use Api\Trengo;

trait Teams
{
    abstract public function sendRequest(string $url, string $method = Trengo::GET, array $body = []);
    abstract public function returnResponse(\Psr\Http\Message\ResponseInterface $response);
    /**
     * @param string $page
     *
     * @return mixed
     */
    public function getAllTeams(string $page = "1")
    {
        $response = $this->sendRequest("teams", Trengo::GET, [
            'query' => [
                'page' => $page
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int    $team_id
     * @param string $page
     *
     * @return mixed
     */
    public function getTeam(int $team_id, string $page = "1")
    {
        $response = $this->sendRequest("teams/$team_id", Trengo::GET, [
            'query' => [
                'page' => $page
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param string $name
     * @param array  $channel_ids
     * @param array  $user_ids
     *
     * @return mixed
     */
    public function createTeam(string $name, array $channel_ids, array $user_ids)
    {
        $response = $this->sendRequest("teams", Trengo::POST, [
            'form_params' => [
                'name' => $name,
                'channel_ids' => $channel_ids,
                'user_ids' => $user_ids
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int    $team_id
     * @param string $name
     * @param array  $channel_ids
     * @param array  $user_ids
     *
     * @return mixed
     */
    public function updateTeam(int $team_id, string $name, array $channel_ids = [], array $user_ids = [])
    {
        $response = $this->sendRequest("teams/$team_id", Trengo::PUT, [
            'form_params' => [
                'name' => $name,
                'channel_ids' => $channel_ids,
                'user_ids' => $user_ids
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int $team_id
     *
     * @return mixed
     */
    public function deleteTeam(int $team_id)
    {
        $response = $this->sendRequest("teams/$team_id", Trengo::DELETE);
        return $this->returnResponse($response);
    }
}
