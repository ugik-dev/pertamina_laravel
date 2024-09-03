<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LiveLocationEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $idLiveLocation;
    public $long;
    public $lat;
    public $name;
    public $police_number;

    public function __construct($idLiveLocation, $long, $lat, $name, $police_number)
    {
        $this->idLiveLocation = $idLiveLocation;
        $this->long = $long;
        $this->lat = $lat;
        $this->name = $name;
        $this->police_number = $police_number;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return [('livelocation-channel.' . $this->idLiveLocation)];
    }
    public function broadcastAs()
    {
        return 'livelocation-event';
    }
}
