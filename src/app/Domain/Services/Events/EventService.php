<?php

namespace App\Domain\Services\Events;

use App\Domain\Repositories\Events\EventRepositoryInterface;

class EventService
{

    protected $eventRepository;

    public function __constructor(EventRepositoryInterface $eventRepositoryInterface)
    {
        $this->eventRepository = $eventRepositoryInterface;
    }

    public function store(array $data)
    {
        logger($data);
    }

    public function all($limit = 50)
    {
        return $this->eventRepository->all($limit);
    }
}