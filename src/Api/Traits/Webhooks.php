<?php


namespace TheCodebakery\Trengo\Api\Traits;

use TheCodebakery\Trengo\Api\Trengo;

/**
 * Trait Webhooks
 *
 * @package App\Domain\Services\Trengo\traits
 */
trait Webhooks
{
    abstract public function sendRequest(string $url, string $method = Trengo::GET, array $body = []);
    abstract public function returnResponse(\Psr\Http\Message\ResponseInterface $response);

    /**
     * @param string $page
     *
     * @return mixed
     */
    public function listAllWebhooks(string $page = "1")
    {
        $response = $this->sendRequest("webhooks", Trengo::GET, [
            'query' => [
                'page' => $page
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param string $name
     * @param string $type
     * @param string $url
     *
     * @return mixed
     */
    public function createWebhook(string $name, string $type, string $url)
    {
        $response = $this->sendRequest("webhooks", Trengo::POST, [
            'form_params' => [
                'name' => $name,
                'type' => $type,
                'url'  => $url
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int $webhook_id
     *
     * @return mixed
     */
    public function getWebhook(int $webhook_id)
    {
        $response = $this->sendRequest("webhooks/$webhook_id");
        return $this->returnResponse($response);
    }

    /**
     * @param int    $webhook_id
     * @param string $name
     * @param string $type
     * @param string $url
     *
     * @return mixed
     */
    public function updateWebhook(int $webhook_id, string $name, string $type, string $url)
    {
        $response = $this->sendRequest("webhook/$webhook_id", Trengo::PUT, [
            'form_params' => [
                'name' => $name,
                'type' => $type,
                'url'  => $url
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int $webhook_id
     *
     * @return mixed
     */
    public function deleteWebhook(int $webhook_id)
    {
        $response = $this->sendRequest("webhook/$webhook_id", Trengo::DELETE);
        return $this->returnResponse($response);
    }
}
