<?php


namespace TheCodebakery\Trengo\Api\Traits;

use TheCodebakery\Trengo\Api\Trengo;
trait WhatsApp
{

    abstract public function sendRequest(string $url, string $method = Trengo::GET, array $body = []);
    abstract public function returnResponse(\Psr\Http\Message\ResponseInterface $response);

    /**
     * @description Start a WhatsApp conversation
     *
     * @param int   $ticket_id
     * @param int   $hsm_id
     * @param array $params
     *
     * @return mixed
     */
    public function startWhatsAppConversation(int $ticket_id, int $hsm_id, array $params = [])
    {
        $response = $this->sendRequest('wa_sessions', Trengo::POST, [
            'form_params'   => [
                'ticket_id' => $ticket_id,
                'hsm_id'    => $hsm_id,
                'params'    => $params
            ]
        ]);
        return $this->returnResponse($response);
    }
}
