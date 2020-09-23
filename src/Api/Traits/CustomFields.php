<?php


namespace Api\Traits;

use Api\Trengo;

trait CustomFields
{
    abstract public function sendRequest(string $url, string $method = Trengo::GET, array $body = []);
    abstract public function returnResponse(\Psr\Http\Message\ResponseInterface $response);

    /**
     * @param string $page
     *
     * @return mixed
     */
    public function listAllCustomFields(string $page = "1")
    {
        $response = $this->sendRequest("custom_fields", Trengo::GET, [
            'query' => [
                'page' => $page
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param string $name
     * @param string $type
     *
     * @return mixed
     */
    public function createCustomField(string $name, string $type)
    {
        $response = $this->sendRequest("custom_fields", Trengo::POST, [
            'form_params' => [
                'name' => $name,
                'type' => $type
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int $custom_field_id
     *
     * @return mixed
     */
    public function getCustomField(int $custom_field_id)
    {
        $response = $this->sendRequest("custom_fields/$custom_field_id");
        return $this->returnResponse($response);
    }

    /**
     * @param int    $custom_field_id
     * @param string $name
     * @param string $type
     *
     * @return mixed
     */
    public function updateCustomField(int $custom_field_id, string $name, string $type)
    {
        $response = $this->sendRequest("custom_fields/$custom_field_id", Trengo::PUT, [
            'form_params' => [
                'name' => $name,
                'type' => $type
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int $custom_field_id
     *
     * @return mixed
     */
    public function deleteCustomField(int $custom_field_id)
    {
        $response = $this->sendRequest("custom_fields/$custom_field_id", Trengo::DELETE);
        return $this->returnResponse($response);
    }
}
