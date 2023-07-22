<?php


namespace TheCodeBakery\Trengo\Api\Traits;

use TheCodeBakery\Trengo\Api\Trengo;

/**
 * Trait Util
 *
 * @package App\Domain\Services\Trengo\traits
 */
trait Util
{
    abstract public function sendRequest(string $url, string $method = Trengo::GET, array $body = []);
    abstract public function returnResponse(\Psr\Http\Message\ResponseInterface $response);

    /**
     * @param int    $channel_id
     * @param object $contact
     * @param object $body
     * @param object $attachment
     *
     * @return mixed
     */
    public function storeCustomChannelMessage(int $channel_id, object $contact, object $body, object $attachment)
    {
        $response = $this->sendRequest("/custom_channel_message", Trengo::POST, [
           'form_params' => [
               'channel' => $channel_id,
               'contact' => [
                   'name' => $contact->name,
                   'email' => $contact->email,
                   'identifier' => $contact->identifier
               ],
               'body' => [
                   'text' => $body->text
               ],
               'attachments' => [
                   '*' => [
                       'url' => $attachment->url,
                       'name' => $attachment->name
                   ]
               ]
           ]
        ]);

        return $this->returnResponse($response);
    }
}
