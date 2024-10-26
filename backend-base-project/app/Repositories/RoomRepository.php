<?php

namespace App\Repositories;

use App\Models\Room;

class RoomRepository
{
    protected $model;
    protected $guestRepository;

    public function __construct(Room $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model
            ->latest()
            ->with('guest')
            ->get();
    }

    public function find($id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $model = $this->find($id);
        $model->update($data);
        return $model;
    }

    public function assignGuestToRoom($room, $guestId) {
        $room->guest_id = $guestId;
        $room->status   = Room::TAKEN_STATUS;
        $room->save();
    }

    public function deAssignGuestFromRoom($room) {
        $room->guest_id = null;
        $room->status   = Room::MAINTENANCE_STATUS;
        $room->save();
    }

    public function ready($room) {
        $room->guest_id = null;
        $room->status   = Room::READY_STATUS;
        $room->save();
    }
}
