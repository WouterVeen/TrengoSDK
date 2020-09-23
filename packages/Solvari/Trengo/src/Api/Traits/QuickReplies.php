<?php


namespace Api\Traits;

use Api\Trengo;

trait QuickReplies
{
    abstract public function sendRequest(string $url, string $method = Trengo::GET, array $body = []);
    abstract public function returnResponse(\Psr\Http\Message\ResponseInterface $response);

    /**
     * @param string $type Filter by type ( SMS, MESSAGING, EMAIL)
     *
     * @return mixed
     */
    public function listQuickReplies(string $type = "")
    {
        $response = $this->sendRequest("quick_replies", Trengo::GET, [
            'query' => [
                'type' => $type
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param string $title
     * @param string $message
     * @param string $type
     * @param array  $channel_ids
     *
     * @return mixed
     */
    public function createQuickReply(string $title, string $message, string $type, array $channel_ids = [])
    {
        $response = $this->sendRequest("quick_replies", Trengo::POST, [
            'form_params' => [
                'title'       => $title,
                'message'     => $message,
                'type'        => $type,
                'channel_ids' => $channel_ids
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int    $quick_reply_id The quick reply id
     * @param string $title          The quick reply title
     * @param string $message        The quick reply content
     * @param string $type           The quick reply type ( SMS, EMAIL, MESSAGING)
     * @param array  $channel_ids
     *
     * @return mixed
     */
    public function updateQuickReply(int $quick_reply_id, string $title, string $message, string $type, array $channel_ids = [])
    {
        $response = $this->sendRequest("quick_replies/$quick_reply_id", Trengo::PUT, [
            'form_params' => [
                'title'         => $title,
                'message'       => $message,
                'type'          => $type,
                'channel_ids'   => $channel_ids
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int $quick_reply_id
     *
     * @return mixed
     */
    public function deleteQuickReply(int $quick_reply_id)
    {
        $response = $this->sendRequest("quick_replies/$quick_reply_id", Trengo::DELETE);
        return $this->returnResponse($response);
    }


}
