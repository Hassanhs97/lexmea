<?php

namespace App\Http\Requests\Room;

use App\Models\Room;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RoomUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request, Room $room): array
    {
        return [
            'floor_number' => 'required|integer',
            'room_number'  => ['required', 'integer',  Rule::unique('rooms')->where(function ($query) use ($request) {
                return $query->where('room_number', $request->room_number);
            })->ignore($this->id)],
            'capacity'     => 'required|integer',
            'status'       => 'required|in:READY,TAKEN,MAINTENANCE',
        ];
    }
}
