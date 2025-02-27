<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{

    private User $user;

    public function __construct(User $user)
    {
        $this->user = new User();
    }

    public function all($paginate = false, $length = 10)
    {

        $base_query = $this
            ->user
            ->newQuery();

        return $paginate ? $base_query->paginate($length) : $base_query->get();
    }

    public function find(int $id): ?User
    {
        return $this
            ->user
            ->newQuery()
            ->find($id);
    }

    //find User By email
    public function findByEmail(string $email): ?User
    {
        return $this
            ->user
            ->newQuery()
            ->where('email', $email)
            ->first();
    }

    public function create(array $data): User
    {
        return $this
            ->user
            ->newQuery()
            ->create($data);
    }

    public function update(array $data, int $id): bool
    {
        return $this
            ->user
            ->newQuery()
            ->find($id)
            ->update($data);
    }

    public function delete(int $id): bool
    {
        return $this
            ->user
            ->newQuery()
            ->find($id)
            ->destroy($id);
    }
}
