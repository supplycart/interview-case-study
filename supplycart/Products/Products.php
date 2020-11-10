<?php

namespace Supplycart\Products;
use Auth;


class Products
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
     * @return array
     */
    public function get(): object
    {
        return $this->repository->getAllwithSpecialPrice(Auth::id());
    }
}
