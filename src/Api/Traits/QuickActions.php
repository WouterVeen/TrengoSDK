<?php


namespace TheCodeBakery\Trengo\Api\Traits;

use Api\Trengo;

/**
 * Trait QuickActions
 *
 * @package App\Domain\Services\Trengo\traits
 */
trait QuickActions
{
    abstract public function sendRequest(string $url, string $method = Trengo::GET, array $body = []);
    abstract public function returnResponse(\Psr\Http\Message\ResponseInterface $response);

    /**
     * @param int    $channel_id    The sender of the message.
     * @param string $contact_id    The destination of the message. Based on the channel_id this must be en email address or phone number.
     * @param string $message       The message send to the receiver.
     * @param string $contact_name  The name of the contact. Only used when the contact does not already exists.
     * @param string $email_message The subject of the message. Only used when the message is an email.
     *
     * @return mixed
     */
    public function sendAMessage(int $channel_id, string $contact_id, string $message, string $contact_name = "", string $email_message = "")
    {
        $response = $this->sendRequest("messages", Trengo::POST, [
            'form_params' => [
                'channel_id'    => $channel_id,
                'contact_id'    => $contact_id,
                'message'       => $message,
                'contact_name'  => $contact_name,
                'email_message' => $email_message
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int    $channel_id    The sender of the message.
     * @param string $phone         The phone number from the contact. Must be numeric.
     * @param string $direction     The direction of the phone call. Must be INBOUND or OUTBOUND.
     * @param string $contact_name  The name of the contact. Only used when the contact does not already exists.
     * @param string $note          An optional note used to create an intern ticket message.
     * @param int    $duration      The duration in seconds of the phone call.
     * @param string $recording_url A public recording URL.
     *
     * @return mixed
     */
    public function logPhoneCall(int $channel_id, string $phone, string $direction, string $contact_name = "", string $note = "", int $duration = 0, string $recording_url = "")
    {
        $response = $this->sendRequest("voice/logs", Trengo::POST, [
            'channel_id'    => $channel_id,
            'phone'         =>$phone,
            'directions'    => $direction,
            'contact_name'  => $contact_name,
            'note'          => $note,
            'duration'      => $duration,
            'recording_url' => $recording_url
        ]);

        return $this->returnResponse($response);
    }
}
