<?php


namespace TheCodeBakery\Trengo\Api\Traits;

use Api\Trengo;

trait Users
{
    abstract public function sendRequest(string $url, string $method = Trengo::GET, array $body = []);
    abstract public function returnResponse(\Psr\Http\Message\ResponseInterface $response);

    /**
     * @param string $page
     *
     * @return mixed
     */
    public function listAllUsers(string $page = "1")
    {
        $response = $this->sendRequest("users", Trengo::GET, [
            'query' => [
                'page' => $page
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int    $user_id
     * @param string $page
     *
     * @return mixed
     */
    public function getUser(int $user_id, string $page = "1")
    {
        $response = $this->sendRequest("user/$user_id", Trengo::GET, [
            'query' => [
                'page' => $page
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param string $email
     * @param string $first_name
     * @param string $last_name
     * @param string $authorization
     * @param array  $team_ids
     *
     * @return mixed
     */
    public function createUser(string $email, string $first_name, string $last_name, string $authorization, array $team_ids = [])
    {
        $response = $this->sendRequest("users", Trengo::POST, [
            'form_params' => [
                'email'         => $email,
                'first_name'    => $first_name,
                'last_name'     => $last_name,
                'team_ids'      => $team_ids,
                'authorization' => $authorization
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int    $user_id
     * @param string $email
     * @param string $first_name
     * @param string $last_name
     * @param string $authorization
     * @param array  $team_ids
     *
     * @return mixed
     */
    public function updateUser(int $user_id, string $email, string $first_name, string $last_name, string $authorization, array $team_ids = [])
    {
        $response = $this->sendRequest("users/$user_id", Trengo::PUT, [
            'form_params' => [
                'email'         => $email,
                'first_name'    => $first_name,
                'last_name'     => $last_name,
                'team_ids'      => $team_ids,
                'authorization' => $authorization,
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int $user_id
     *
     * @return mixed
     */
    public function deleteUser(int $user_id)
    {
        $response = $this->sendRequest("users/$user_id", Trengo::DELETE);
        return $this->returnResponse($response);
    }
}
