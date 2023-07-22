<?php


namespace TheCodeBakery\Trengo\Api\Traits;

use TheCodeBakery\Trengo\Api\Trengo;

/**
 * Trait Contacts
 *
 * @package App\Domain\Services\Trengo\traits
 */
trait Contacts
{
    abstract public function sendRequest(string $url, string $method = Trengo::GET, array $body = []);
    abstract public function returnResponse(\Psr\Http\Message\ResponseInterface $response);

    /**
     * @param int    $page
     * @param string $term
     *
     * @return mixed
     */
    public function listAllContacts(int $page = 1, string $term = "")
    {
        $response = $this->sendRequest("contacts", Trengo::GET, [
           'query' => [
               'page' => $page,
               'term' => $term
           ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int    $contact_id
     * @param string $include
     *
     * @return mixed
     */
    public function viewContact(int $contact_id, string $include = "")
    {
        $response = $this->sendRequest("contacts/$contact_id", Trengo::GET, [
            'query' => [
                'include' => $include
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int    $channel_id
     * @param string $identifier The contact identifier (email or phone, depending on the channel)
     *
     * @return mixed
     */
    public function createContact(int $channel_id, string $identifier = "")
    {
        $identifier = preg_replace( '/\s/', '', $identifier);

        $response = $this->sendRequest("channels/$channel_id/contacts", Trengo::POST, [
            'form_params' => [
                'identifier' => $identifier,
                'channel_id' => $channel_id
            ]
        ]);
        return $this->returnResponse($response);
    }

    /**
     * @param int    $contact_id
     * @param string $name
     * @param array  $contact_group_ids
     *
     * @return mixed
     */
    public function updateContact(int $contact_id, string $name, array $contact_group_ids = [])
    {
        $response = $this->sendRequest('contacts/'.$contact_id, Trengo::PUT, [
            'form_params' => [
                'name' => $name,
                'contact_group_ids' => $contact_group_ids
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int $contact_id
     *
     * @return mixed
     */
    public function deleteContact(int $contact_id)
    {
        $response = $this->sendRequest('contacts/'.$contact_id, Trengo::DELETE);

        return $this->returnResponse($response);
    }

    /**
     * @param int    $contact_id
     * @param int    $custom_field_id
     * @param string $value
     *
     * @return mixed
     */
    public function customerContactField(int $contact_id, int $custom_field_id, string $value)
    {
        $response = $this->sendRequest("contacts/$contact_id/custom_fields", Trengo::POST, [
            'form_params' => [
                'custom_field_id' => $custom_field_id,
                'value' => $value
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int    $contact_id
     * @param string $note
     *
     * @return mixed
     */
    public function addNoteToContact(int $contact_id, string $note)
    {
        $response = $this->sendRequest("contacts/$contact_id/notes", Trengo::POST, [
            'form_params' => [
                'note' => $note
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int $contact_id
     * @param int $note_id
     *
     * @return mixed
     */
    public function deleteNoteFromContact(int $contact_id, int $note_id)
    {
        $response = $this->sendRequest("contacts/$contact_id/notes/$note_id", Trengo::DELETE);

        return $this->returnResponse($response);
    }
}
