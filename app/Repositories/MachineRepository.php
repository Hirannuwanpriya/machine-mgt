<?php

namespace App\Repositories;

use App\Models\Machine;
use App\Repositories\Interfaces\MachineRepositoryInterface;


class MachineRepository implements MachineRepositoryInterface
{

    private Machine $machine;

    public function __construct(
        Machine $machine
    )
    {
        $this->machine = $machine;
    }

    public function all($paginate = false,  $length = 10)
    {
        $base_query = $this
            ->machine
            ->newQuery();

        return $paginate ? $base_query->paginate($length) : $base_query->get();
    }

    public function find(int $id): ?Machine
    {
        return $this
            ->machine
            ->newQuery()
            ->find($id);
    }

    public function create(array $data): Machine
    {
        return $this
            ->machine
            ->newQuery()
            ->create($data);
    }

    public function update(array $data, int $id): bool
    {
        return $this
            ->machine
            ->newQuery()
            ->find($id)
            ->update($data);
    }

    public function delete(int $id): bool
    {
        return $this
            ->machine
            ->newQuery()
            ->find($id)
            ->destroy($id);
    }

    public function updateHours(array $data, int $id): bool
    {

        return $this
            ->machine
            ->newQuery()
            ->find($id)
            ->update(
                [
                    'hours' => $data['hours'],
                    'timer_date' => $data['timer_date']
                ]
            );
    }
}
