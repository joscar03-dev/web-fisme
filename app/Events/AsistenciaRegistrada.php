<?php

namespace App\Events;

use App\Models\Asistencia;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AsistenciaRegistrada
{
    public $asistencia;
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(Asistencia $asistencia)
    {
        //
        $this->asistencia = $asistencia;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
        return new Channel('asistencias');
    }
    public function broadcastWith()
    {
        return [
            'id' => $this->asistencia->id,
            'nombres_completos' => $this->asistencia->nombres_completos,
            'fecha' => $this->asistencia->fecha,
        ];
    }
}
