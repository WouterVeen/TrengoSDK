<?php


namespace Api\Traits;

use Api\Trengo;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;

trait Request
{
    /**
     * @description Send a request to trengo
     *
     * @param string $url
     * @param string $method
     * @param array  $body
     *
     * @return mixed|\Psr\Http\Message\ResponseInterface|string
     */
    public function sendRequest(string $url, string $method = Trengo::GET, array $body = [])
    {
        try{
            $response = $this->client->request($method, $url, $body);
        }catch(ClientException $ce){
            \Log::error($ce->getMessage());
            abort($ce->getCode(), $ce->getMessage());
        } catch (GuzzleException $ge) {
            \Log::error($ge->getMessage());
            abort($ge->getCode(), $ge->getMessage());
        }
        return $response;
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $request
     *
     * @return mixed
     */
    public function returnResponse(\Psr\Http\Message\ResponseInterface $response)
    {
        return json_decode($response->getBody());
    }
}
