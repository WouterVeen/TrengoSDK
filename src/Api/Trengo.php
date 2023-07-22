<?php

namespace TheCodebakery\Trengo\Api;

use GuzzleHttp\Client;
use TheCodebakery\Trengo\Api\Traits\ContactGroup;
use TheCodebakery\Trengo\Api\Traits\Contacts;
use TheCodebakery\Trengo\Api\Traits\CustomFields;
use TheCodebakery\Trengo\Api\Traits\FileUpload;
use TheCodebakery\Trengo\Api\Traits\Labels;
use TheCodebakery\Trengo\Api\Traits\Profiles;
use TheCodebakery\Trengo\Api\Traits\QuickActions;
use TheCodebakery\Trengo\Api\Traits\QuickReplies;
use TheCodebakery\Trengo\Api\Traits\Request;
use TheCodebakery\Trengo\Api\Traits\SmsMessages;
use TheCodebakery\Trengo\Api\Traits\Teams;
use TheCodebakery\Trengo\Api\Traits\Tickets;
use TheCodebakery\Trengo\Api\Traits\Users;
use TheCodebakery\Trengo\Api\Traits\Util;
use TheCodebakery\Trengo\Api\Traits\Webhooks;
use TheCodebakery\Trengo\Api\Traits\WhatsApp;


/**
 * Class Trengo
 *
 * @author Wouter Veen wouterbrveen@gmail.com
 * @copyright TheCodeBakery 1991-2023
 * @version V1.0.0
 * @package App\Domain\Services\Trengo
 */
class Trengo
{
    /**
     * Trait list
     */
    use Request,
        Tickets,
        WhatsApp,
        FileUpload,
        Util,
        Contacts,
        Profiles,
        QuickReplies,
        QuickActions,
        Webhooks,
        CustomFields,
        Users,
        Teams,
        Labels,
        ContactGroup,
        SmsMessages;

    /*
     * Trengo channel types
     */
    CONST CHANNEL_TYPE_EMAIL    = "EMAIL";
    CONST CHANNEL_TYPE_CHAT     = "CHAT";
    CONST CHANNEL_TYPE_WA       = "WA_BUSINESS";
    CONST CHANNEL_TYPE_SMS      = "SMS";

    /*
     * Request methods
     */
    CONST GET       = "GET";
    CONST POST      = "POST";
    CONST PUT       = "PUT";
    CONST DELETE    = "DELETE";

    /*
     * Trengo api version and api url
     */
    CONST VERSION   = "v2/";

    /*
     * Trengo tickets statusses
     */
    CONST OPEN      = 'OPEN';
    CONST CLOSE     = 'CLOSE';
    CONST ASSIGNED  = 'ASSIGNED';
    CONST INVALID   = 'INVALID';

    /*
     * Array of Trengo ticket statusses
     */
    CONST TRENGO_TICKED_STATUSSES = [
        self::OPEN,
        self::CLOSE,
        self::ASSIGNED,
        self::INVALID
    ];

    /*
     * Array of Trengo Channel types
     */
    CONST CHANNELS = [
        self::CHANNEL_TYPE_CHAT,
        self::CHANNEL_TYPE_EMAIL,
        self::CHANNEL_TYPE_WA,
        self::CHANNEL_TYPE_SMS
    ];

    /**
     * @var \GuzzleHttp\Client|null
     */
    private $client = null;

    public function __construct()
    {
        $this->client = new CLient([
            'base_uri' => config('trengo.api_base_url').self::VERSION,
            'headers' =>  [
                'Authorization' => 'Bearer '.config('trengo.api_key')
            ]
        ]);
    }

    /**
     * @param string $page
     *
     * @return mixed
     */
    public function getListOfAllTeams(string $page = "0")
    {
        $response = $this->sendRequest('teams', self::GET, [
            'form_params' => [
                'page' => $page
            ]
        ]);
        return json_decode($response->getBody());
    }
}
