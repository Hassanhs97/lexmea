<?php

namespace App\Repositories;

use App\Models\Guest;

class GuestRepository
{
    protected $model;
    protected $roomRepository;

    public function __construct(Guest $model)
    {
        $this->model = $model;
    }
    public function all()
    {
        return $this->model
            ->latest()
            ->get();
    }

    public function find($id)
    {
        return $this->model->find($id);
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
}
