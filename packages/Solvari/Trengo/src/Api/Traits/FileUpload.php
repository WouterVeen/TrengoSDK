<?php


namespace Api\Traits;

use Api\Trengo;
use File;

trait FileUpload
{
    abstract public function sendRequest(string $url, string $method = Trengo::GET, array $body = []);
    abstract public function returnResponse(\Psr\Http\Message\ResponseInterface $response);

    /**
     * @param \File $file
     *
     * @return mixed
     */
    public function FileUpload(File $file)
    {
        $response = $this->sendRequest("upload/messages/multipart", Trengo::POST, [
            'form_params' => [
                'file' => $file
            ]
        ]);

        return $this->returnResponse($response);
    }
}
