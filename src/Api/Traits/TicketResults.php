<?php


namespace TheCodeBakery\Trengo\Api\Traits;

use Api\Trengo;

trait TicketResults
{
    abstract public function sendRequest(string $url, string $method = Trengo::GET, array $body = []);
    abstract public function returnResponse(\Psr\Http\Message\ResponseInterface $response);

    /**
     * @param int $page
     *
     * @return mixed
     */
    public function listAllTicketResults(string $page = "1")
    {
        $response = $this->sendRequest("ticket_results", Trengo::GET, [
            'query' => [
                'page' => $page
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int $ticket_id
     *
     * @return mixed
     */
    public function getTicketResult(int $ticket_id)
    {
        $response = $this->sendRequest("ticket_results/$ticket_id");
        return $this->returnResponse($response);
    }

    /**
     * @param string $name
     * @param int    $sort_order
     *
     * @return mixed
     */
    public function createTicketResult(string $name, int $sort_order = 0)
    {
        $response = $this->sendRequest("ticket_results", Trengo::POST, [
            'form_params' => [
                'name' => $name,
                'sort_order' => $sort_order
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int    $ticket_id
     * @param string $name
     * @param int    $sort_order
     *
     * @return mixed
     */
    public function updateTicketResult(int $ticket_id, string $name, int $sort_order = 0)
    {
        $response = $this->sendRequest("tickets_results/$ticket_id", Trengo::PUT, [
            'form_params' => [
                'name' => $name,
                'sort_order' => $sort_order
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int $ticket_id
     *
     * @return mixed
     */
    public function deleteTicketResult(int $ticket_id)
    {
        $response = $this->sendRequest("ticket_results/$ticket_id", Trengo::DELETE);
        return $this->returnResponse($response);
    }
}
