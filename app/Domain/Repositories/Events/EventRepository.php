<?php

namespace App\Domain\Repositories\Events;

use App\Models\Event;

class EventRepository implements EventRepositoryInterface
{
    protected $model;

    public function __constructor(Event $model)
    {
        $this->model = $model;
    }

    public function all($limit)
    {
        return $this->model->paginate($limit);   
    }

    public function store(array $data)
    {   
        return $this->model->create($data);
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }
}