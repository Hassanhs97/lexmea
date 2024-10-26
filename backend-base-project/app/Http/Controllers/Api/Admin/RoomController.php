<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\RoomStoreRequest;
use App\Http\Requests\Room\RoomUpdateRequest;
use App\Http\Resources\Api\Admin\RoomCollection;
use App\Models\Guest;
use App\Models\Room;
use App\Repositories\RoomRepository;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class RoomController extends Controller
{
    public function __construct(
        protected RoomRepository $roomRepository
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $rooms = $this->roomRepository->all();

        return new RoomCollection($rooms);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoomStoreRequest $request)
    {
        $this->roomRepository->create($request->all());


        return Response::json(
            [
                'message' => [
                    'room stored successfully.'
                ]
            ],
            HttpFoundationResponse::HTTP_OK
        );
    }

     /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        return $room;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(RoomUpdateRequest $request, Room $room)
    {
        $this->roomRepository->update($room->id, $request->all());

        return Response::json(
            [
                'message' => [
                    'room updated successfully.'
                ]
            ],
            HttpFoundationResponse::HTTP_OK
        );
    }

    /**
     * Assign guest to room.
     */
    public function assignGuestToRoom(Room $room, Guest $guest) {

        $this->roomRepository->assignGuestToRoom($room, $guest->id);

        return Response::json(
            [
                'message' => [
                    'guest successfully attached to room.'
                ]
            ],
            HttpFoundationResponse::HTTP_OK
        );
    }

    /**
     * Deassign guest from room.
     */
    public function deAssignGuestFromRoom(Room $room, Guest $guest) {

        $this->roomRepository->deAssignGuestFromRoom($room, $guest->id);

        return Response::json(
            [
                'message' => [
                    'guest successfully deattached from room.'
                ]
            ],
            HttpFoundationResponse::HTTP_OK
        );
    }

    /**
     * Ready room.
     */
    public function ready(Room $room) {

        $this->roomRepository->ready($room);

        return Response::json(
            [
                'message' => [
                    'room status set to ready successfully.'
                ]
            ],
            HttpFoundationResponse::HTTP_OK
        );
    }
}
