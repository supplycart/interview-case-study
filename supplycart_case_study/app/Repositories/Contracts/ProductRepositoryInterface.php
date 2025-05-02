<?php

namespace App\Repositories\Contracts;

interface ProductRepositoryInterface
{
    public function paginateWithRelations(int $perPage = 10);
}
