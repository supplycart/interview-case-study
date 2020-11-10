<?php

namespace Supplycart\Orders;

use Auth;

class Orders
{
    /**
     * @var Repository
     */
    private $repository;

    /**
     * Orders constructor.
     * @param RepositoryInterface $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $products
     * @return \Illuminate\Database\Eloquent\Collection 
     */
    public function createOrder(array $productIds): object
    {
        $userId = Auth::id();
        return $this->repository->create($userId,$productIds);
    }

    /**
     * @return array
     */
    public function get(): object
    {
        $userId = Auth::id();
        return $this->repository->getOrdersByUser($userId);
    }
}
