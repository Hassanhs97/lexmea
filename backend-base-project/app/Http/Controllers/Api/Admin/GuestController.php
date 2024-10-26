<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guest\GuestStoreRequest;
use App\Http\Resources\Api\Admin\Guest\GuestCollection;
use App\Models\Guest;
use App\Repositories\GuestRepository;
use Illuminate\Support\Facades\Response;
use Symfony\Component\HttpFoundation\Response as HttpFoundationResponse;

class GuestController extends Controller
{
    public function __construct(
        protected GuestRepository $guestRepository
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $guests = $this->guestRepository->all();

        return new GuestCollection($guests);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GuestStoreRequest $request)
    {
        $this->guestRepository->create($request->all());


        return Response::json(
            [
                'message' => [
                    'guest stored successfully.'
                ]
            ],
            HttpFoundationResponse::HTTP_OK
        );
    }

     /**
     * Display the specified resource.
     */
    public function show(Guest $guest)
    {
        return $guest;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(GuestStoreRequest $request, Guest $guest)
    {
        $this->guestRepository->update($guest->id, $request->all());

        return Response::json(
            [
                'message' => [
                    'guest updated successfully.'
                ]
            ],
            HttpFoundationResponse::HTTP_OK
        );
    }
}
