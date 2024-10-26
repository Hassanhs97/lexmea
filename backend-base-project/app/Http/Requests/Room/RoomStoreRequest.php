<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;

class RoomStoreRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'floor_number' => 'required|integer',
            'room_number'  => 'required|integer|unique:rooms',
            'capacity'     => 'required|integer',
            'status'       => 'required|in:READY,TAKEN,MAINTENANCE',
        ];
    }
}
