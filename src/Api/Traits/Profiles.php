<?php


namespace Api\Traits;

use Api\Trengo;

/**
 * Trait Profiles
 *
 * @package App\Domain\Services\Trengo\traits
 */
trait Profiles
{
    abstract public function sendRequest(string $url, string $method = Trengo::GET, array $body = []);
    abstract public function returnResponse(\Psr\Http\Message\ResponseInterface $response);

    /**
     * @param int    $page
     * @param string $term
     *
     * @return mixed
     */
    public function listAllProfiles(int $page = 1, string $term = "")
    {
        $response = $this->sendRequest("profiles", Trengo::GET, [
           'query' => [
               'page' => $page,
               'term' => $term
           ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param string $name
     *
     * @return mixed
     */
    public function createProfile(string $name)
    {
        $response = $this->sendRequest("profiles", Trengo::POST, [
            'form_params' => [
                'name' => $name
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int   $profile_id
     * @param array $with
     *
     * @return mixed
     */
    public function viewProfile(int $profile_id, array $with = [])
    {
        $response = $this->sendRequest("profiles/$profile_id", Trengo::GET, [
           'query' => [
               'with' => $with
           ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int    $profile_id
     * @param string $name
     *
     * @return mixed
     */
    public function updateProfile(int $profile_id, string $name)
    {
        $response = $this->sendRequest("profiles/$profile_id", Trengo::PUT, [
           'form_params' => [
               'name' => $name
           ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int    $profile_id
     * @param int    $custom_field_id
     * @param string $value
     *
     * @return mixed
     */
    public function setCustomProfileField(int $profile_id, int $custom_field_id, string $value)
    {
        $response = $this->sendRequest("profiles/$profile_id/custom_fields", Trengo::POST, [
            'form_params' => [
                'custom_field_id' => $custom_field_id,
                'value' => $value
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int $profile_id
     *
     * @return mixed
     */
    public function deleteProfile(int $profile_id)
    {
        $response = $this->sendRequest("profiles/$profile_id", Trengo::DELETE);
        return $this->returnResponse($response);
    }

    /**
     * @param int    $profile_id
     * @param string $note
     * @param string $user_id
     *
     * @return mixed
     */
    public function createNote(int $profile_id, string $note, string $user_id)
    {
        $response = $this->sendRequest("profiles/$profile_id/notes", Trengo::POST, [
            'form_params' => [
                'note' => $note,
                'user_id' => $user_id
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int $profile_id
     * @param int $note_id
     *
     * @return mixed
     */
    public function deleteNote(int $profile_id, int $note_id)
    {
        $response = $this->sendRequest("profiles/$profile_id/notes/$note_id", Trengo::DELETE);

        return $this->returnResponse($response);
    }

    /**
     * @param int    $profile_id
     * @param int    $contact_id
     * @param string $type
     *
     * @return mixed
     */
    public function attachContactToProfile(int $profile_id, int $contact_id, string $type = "")
    {
        $response = $this->sendRequest("profiles/$profile_id/contacts", Trengo::POST, [
            'form_params' => [
                'contact_id' => $contact_id,
                'type' => $type
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int    $profile_id
     * @param int    $contact_id
     * @param string $type
     *
     * @return mixed
     */
    public function detachContactFromProfile(int $profile_id, int $contact_id, string $type = "")
    {
        $response = $this->sendRequest("profiles/$profile_id/contacts/$contact_id", Trengo::DELETE, [
            'query'=> [
                'type' => $type
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int        $profile_id
     * @param \File|null $image
     *
     * @return mixed
     */
    public function setProfileImage(int $profile_id, \File $image = null)
    {
        $response = $this->sendRequest("profiles/$profile_id/image", Trengo::POST, [
            'form_params' => [
                'image' => $image
            ]
        ]);

        return $this->returnResponse($response);
    }

    /**
     * @param int $profile_id
     *
     * @return mixed
     */
    public function unsetProfileImage(int $profile_id)
    {
        $response = $this->sendRequest("profiles/$profile_id/images/0", Trengo::DELETE);
        return $this->returnResponse($response);
    }
}
