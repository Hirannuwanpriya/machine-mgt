<?php

namespace App\Repositories\Interfaces;

use App\Models\Machine;

interface MachineRepositoryInterface
{
    public function all($paginate = false, $length = 10);

    public function find(int $id): ?Machine;

    public function create(array $data): Machine;

    public function update(array $data, int $id): bool;

    public function delete(int $id): bool;

    public function updateHours(array $data, int $id): bool;
}
