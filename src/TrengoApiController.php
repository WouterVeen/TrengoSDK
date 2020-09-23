<?php

namespace Solvari;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Api\Trengo;
use Solvari\WhatsApp\WhatsApp;

class TrengoApiController extends Controller
{
    CONST TEAM_SOLVARI = "Solvari";
    CONST TEAM_SERVICE = "Service";

    CONST TEAMS = [
        self::TEAM_SERVICE,
        self::TEAM_SOLVARI
    ];

    private $trengo = null;

    public function __construct()
    {
        $this->trengo = new Trengo();
    }

    /**
     * @return array
     */
    public function getAllChannels() : object
    {
        $return = [];
        $response = $this->trengo->getListOfAllTeams();
        foreach($response->data as $teams){
            foreach($teams->channels as $channel){
                $return[$teams->name][] = $channel;
            }
        }
        return (object)$return;
    }

    /**
     * @param string $channel_name
     *
     * @return object
     */
    public function getChannel(string $channel_name) : object
    {
        $return = [];
        $channels = $this->getAllChannels();
        foreach($channels as $channel){
            if($channel->type === $channel_name){
                $return[] = $channel;
            }
        }
        return (object)$return;
    }

    /**
     * @param string $team_name
     *
     * @return object
     */
    public function getAllChannelsByTeam(string $team_name) : object
    {
        $return = [];
        $response = $this->trengo->getListOfAllTeams();
        foreach($response->data as $teams){
            foreach($teams->channels as $channel){
                if($teams->name === $team_name ){
                    $return[] = $channel;
                }
            }
        }
        return (object)$return;
    }

    /**
     * @param string                         $ticket_id
     * @param \App\WhatsAppMessages\WhatsApp $whatsApp
     */
    public function sendWhatsAppMessage(string $ticket_id, WhatsApp $whatsApp)
    {
        $this->trengo->StartWhatsAppConversation($ticket_id, $whatsApp->getHSMId(), $whatsApp->getData());
    }
}
