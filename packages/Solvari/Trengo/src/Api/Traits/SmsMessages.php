<?php


namespace Api\Traits;

use Api\Trengo;

trait SmsMessages
{
    abstract public function sendRequest(string $url, string $method = Trengo::GET, array $body = []);
    abstract public function returnResponse(\Psr\Http\Message\ResponseInterface $response);

    /**
     * @param int $page
     *
     * @return mixed
     */
    public function listAllSMSMessages(int $page = 1)
    {
        $response = $this->sendRequest("sms_messages", Trengo::GET, [
            'query' => [
                'page' => $page
            ]
        ]);
        return $this->returnResponse($response);
    }

    /**
     * @param int    $channel_id
     * @param int    $to
     * @param string $message
     *
     * @return mixed
     */
    public function sendSMSMessage(int $channel_id, int $to,  string $message = "")
    {
        $response = $this->sendRequest("sms_messages", Trengo::POST, [
            'form_params' => [
                'channel_id' => $channel_id,
                'message'    => $message,
                'to'         => $to
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @return mixed
     */
    public function fetchBalance()
    {
        $response = $this->sendRequest("wallet/balance");
        return $this->returnResponse($response);
    }
}
