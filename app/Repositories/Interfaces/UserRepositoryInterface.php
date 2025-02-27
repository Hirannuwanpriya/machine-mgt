<?php

namespace App\Repositories\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;



interface UserRepositoryInterface
{
    public function all(bool $paginate = false, int $length = 10);

    public function find(int $id): ?User;

    public function create(array $data): User;

    public function update(array $data, int $id): bool;

    public function delete(int $id): bool;

}
