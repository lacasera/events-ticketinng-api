<?php

namespace App\Domain\Repositories\Events;

interface EventRepositoryInterface
{
    public function find(int $id);

    public function store(array $data);

    public function all(int $limit);

}