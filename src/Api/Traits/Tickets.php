<?php

namespace TheCodeBakery\Trengo\Api\Traits;

use Api\Trengo;

trait Tickets
{
    use TicketResults;

    abstract public function sendRequest(string $url, string $method = Trengo::GET, array $body = []);
    abstract public function returnResponse(\Psr\Http\Message\ResponseInterface $response);

    /**
     * @return mixed
     */
    public function getListOfAllTickets()
    {
        $response = $this->sendRequest('tickets', Trengo::GET);
        return $this->returnResponse($response);
    }

    /**
     * @return mixed
     */
    public function getAggregatedListOfAllTickets()
    {
        $response = $this->sendRequest('ticket_aggregates', Trengo::GET);
        return $this->returnResponse($response);
    }

    /**
     * @param int    $channel_id
     * @param int    $contact_id
     * @param string $subject
     *
     * @return mixed
     */
    public function createTicket(int $channel_id, int $contact_id, string $subject = "")
    {
        $response = $this->sendRequest('tickets', Trengo::POST, [
            'form_params' => [
                'channel_id'    => $channel_id,
                'contact_id'    => $contact_id,
                'subject'       => $subject
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int    $ticket_id
     * @param string $type
     * @param int    $user_id
     * @param int    $team_id
     * @param string $note
     *
     * @return mixed
     */
    public function assignATicket(int $ticket_id, string $type, int $user_id = 0, int $team_id = 0, string $note = "")
    {
        $response = $this->sendRequest("tickets/$ticket_id/assign", Trengo::POST, [
            'form_params' => [
                'type'      => $type,
                'user_id'   => $user_id,
                'team_id'   => $team_id,
                'note'      => $note
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int $ticket_id
     * @param int $ticket_result_id
     *
     * @return mixed
     */
    public function closeATicket(int $ticket_id, int $ticket_result_id = 0)
    {
        $response = $this->sendRequest("tickets/$ticket_id/close", Trengo::POST, [
            'form_params' => [
                'ticket_result_id' => $ticket_result_id
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int $ticket_id
     *
     * @return mixed
     */
    public function reopenTicket(int $ticket_id)
    {
        $response = $this->sendRequest("tickets/$ticket_id/reopen", Trengo::POST);
        return $this->returnResponse($response);
    }

    /**
     * @param int $ticket_id
     * @param int $source_ticket_id
     *
     * @return mixed
     */
    public function mergeTicket(int $ticket_id, int $source_ticket_id)
    {
        $response = $this->sendRequest("tickets/$ticket_id/merge", Trengo::POST, [
            'form_params' => [
                'source_ticket_id' => $source_ticket_id
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int $ticket_id
     * @param int $label_id
     *
     * @return mixed
     */
    public function attachLabel(int $ticket_id, int $label_id)
    {
        $response = $this->sendRequest("tickets/$ticket_id/labels", Trengo::POST, [
            'form_params' => [
                'label_id' => $label_id
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int $ticket_id
     * @param int $label_id
     *
     * @return mixed
     */
    public function detachLabel(int $ticket_id, int $label_id)
    {
        $response = $this->sendRequest("tickets/$ticket_id/labels/$label_id". Trengo::DELETE);
        return $this->returnResponse($response);
    }

    /**
     * @param int $ticket_id
     *
     * @return mixed
     */
    public function deleteTicket(int $ticket_id)
    {
        $response = $this->sendRequest("tickets/$ticket_id", Trengo::DELETE);
        return $this->returnResponse($response);
    }

    /**
     * @param int $ticket_id
     *
     * @return mixed
     */
    public function markTicketAsSpam(int $ticket_id)
    {
        $response = $this->sendRequest("tickets/$ticket_id/spam", Trengo::POST);
        return $this->returnResponse($response);
    }

    /**
     * @param int $ticket_id
     *
     * @return mixed
     */
    public function unmarkTicketAsSpam(int $ticket_id)
    {
        $response = $this->sendRequest("tickets/$ticket_id/spam", Trengo::DELETE);
        return $this->returnResponse($response);
    }

    /**
     * @param int    $ticket_id
     * @param int    $custom_field_id
     * @param string $value
     *
     * @return mixed
     */
    public function setCustomDataOnTicket(int $ticket_id, int $custom_field_id, string $value)
    {
        $response = $this->sendRequest("tickets/$ticket_id/custom_fields", Trengo::POST, [
            'form_params' => [
                'custom_field_id' => $custom_field_id,
                'value' => $value
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int $ticket_id
     * @param int $message_id
     *
     * @return mixed
     */
    public function deleteMessage(int $ticket_id, int $message_id)
    {
        $response = $this->sendRequest("tickets/$ticket_id/messages/$message_id", Trengo::DELETE);
        return $this->returnResponse($response);
    }

    /**
     * @param int    $ticket_id
     * @param string $message
     * @param bool   $internal_note
     * @param string $subject
     * @param array  $attachment_ids
     *
     * @return mixed
     */
    public function sendTicketMessage(int $ticket_id, string $message, bool $internal_note = false, string $subject = "", array $attachment_ids = [])
    {
        $response = $this->sendRequest("tickets/$ticket_id/messages", Trengo::POST, [
            'form_params' => [
                'message' => $message,
                'internal_node' => $internal_note,
                'subject'       => $subject,
                'attachment_ids' => $attachment_ids
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int    $ticket_id
     * @param string $caption
     * @param string $file
     *
     * @return mixed
     */
    public function sendTicketMediaMessage(int $ticket_id, string $caption, string $file)
    {
        $response = $this->sendRequest("tickets/$ticket_id/messages/media", Trengo::POST, [
            'form_params' => [
                'caption' => $caption,
                'file' => $file
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int $ticket_id
     *
     * @return mixed
     */
    public function listAllMessages(int $ticket_id)
    {
        $response = $this->sendRequest("tickets/$ticket_id/messages");
        return $this->returnResponse($response);
    }

    /**
     * @param int $ticket_id
     *
     * @return mixed
     */
    public function markTicketAsFavorite(int $ticket_id)
    {
        $response = $this->sendRequest("tickets/$ticket_id/favorited", Trengo::POST);
        return $this->returnResponse($response);
    }

    /**
     * @param int $ticket_id
     *
     * @return mixed
     */
    public function unmarkTicketAsFavorite(int $ticket_id)
    {
        $response = $this->sendRequest("tickets/$ticket_id/favorited/0", Trengo::DELETE);
        return $this->returnResponse($response);
    }

    /**
     * @param int $ticket_id
     * @param int $message_id
     *
     * @return mixed
     */
    public function fetchMessage(int $ticket_id, int $message_id)
    {
        $response = $this->sendRequest("tickets/$ticket_id/messages/$message_id");
        return $this->returnResponse($response);
    }
}
