<?php

namespace Supplycart\Products;



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
        return $this->repository->getAll();
    }
}
