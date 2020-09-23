<?php


namespace Api;

use Api\Traits\ContactGroup;
use Api\Traits\Contacts;
use Api\Traits\CustomFields;
use Api\Traits\FileUpload;
use Api\Traits\Labels;
use Api\Traits\Profiles;
use Api\Traits\QuickActions;
use Api\Traits\QuickReplies;
use Api\Traits\Request;
use Api\Traits\SmsMessages;
use Api\Traits\Teams;
use Api\Traits\Tickets;
use Api\Traits\Users;
use Api\Traits\Util;
use Api\Traits\Webhooks;
use Api\Traits\WhatsApp;


/**
 * Class Trengo
 *
 * @author Wouter Veen w.veen@solvari.com
 * @copyright Solvari B.V. 2009-2019
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
    CONST BASE_URI  = 'https://app.trengo.eu/api/';

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
            'base_uri' => self::BASE_URI.self::VERSION,
            'headers' =>  [
                'Authorization' => 'Bearer '.config('trengo.API_TOKEN')
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
