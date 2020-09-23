<?php


namespace Api\Traits;

use Api\Trengo;
trait Labels
{
    abstract public function sendRequest(string $url, string $method = Trengo::GET, array $body = []);
    abstract public function returnResponse(\Psr\Http\Message\ResponseInterface $response);

    /**
     * @param string $page
     *
     * @return mixed
     */
    public function listAllLabels(string $page = "1")
    {
        $response = $this->sendRequest("labels", Trengo::GET, [
            'query' => [
                'page' => $page
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int    $label_id
     * @param string $page
     *
     * @return mixed
     */
    public function getLabel(int $label_id, string $page = "1")
    {
        $response = $this->sendRequest("label/$label_id", Trengo::GET, [
            'query' => [
                'page' => $page
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param string $name
     * @param string $color
     *
     * @return mixed
     */
    public function createLabel(string $name, string $color)
    {
        $response = $this->sendRequest("labels", Trengo::POST, [
            'form_params' => [
                'name' => $name,
                'color' => $color
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int    $label_id
     * @param string $name
     * @param string $color
     *
     * @return mixed
     */
    public function updateLabel(int $label_id, string $name, string $color)
    {
        $response = $this->sendRequest("labels/$label_id", Trengo::PUT, [
            'form_params' => [
                'name' => $name,
                'color' => $color
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int $label_id
     *
     * @return mixed
     */
    public function deleteLabel(int $label_id)
    {
        $response = $this->sendRequest("labels/$label_id", Trengo::DELETE);
        return $this->returnResponse($response);
    }
}
