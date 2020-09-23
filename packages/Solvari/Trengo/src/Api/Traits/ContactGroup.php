<?php


namespace Api\Traits;

use Api\Trengo;

trait ContactGroup
{
    abstract public function sendRequest(string $url, string $method = Trengo::GET, array $body = []);
    abstract public function returnResponse(\Psr\Http\Message\ResponseInterface $response);

    /**
     * @param string $page
     *
     * @return mixed
     */
    public function getAllContactGroups(string $page = "1")
    {
        $response = $this->sendRequest("contact_groups", Trengo::GET, [
            'query' => [
                'page' => $page
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int    $contact_group_id
     * @param string $page
     *
     * @return mixed
     */
    public function getContactGroup(int $contact_group_id, string $page = "")
    {
        $response = $this->sendRequest("contact_groups/$contact_group_id", Trengo::GET, [
            'query' => [
                'page' => $page
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function createContactGroup(string $name)
    {
        $response = $this->sendRequest("contact_groups", Trengo::POST, [
            'form_params' => [
                'name' => $name
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int    $contact_group_id
     * @param string $name
     *
     * @return mixed
     */
    public function updateContactGroup(int $contact_group_id, string $name)
    {
        $response = $this->sendRequest("contact_groups/$contact_group_id", Trengo::PUT, [
            'form_params' => [
                'name' => $name
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int $contact_group_id
     *
     * @return mixed
     */
    public function deleteContactGroup(int $contact_group_id)
    {
        $response = $this->sendRequest("contact_groups/$contact_group_id", Trengo::DELETE);
        return $this->returnResponse($response);
    }
}
