<?php

namespace App\Contracts;

/**
 * Interface ProductContract
 * @package App\Contracts
 * @author Haze Illias <hazreenaaida@gmail.com>
 */

interface ProductContract
{
    /**
     * @param string $order
     * @param string $sort
     * @param array|string[] $columns
     * @return mixed
     */
    public function listProducts(string $order = 'id', string $sort = 'desc', array $columns = ['*']);

    /**
     * @param int $id
     * @return mixed
     */
    public function findProductById(int $id);

    /**
     * @param $slug
     * @return mixed
     */
    public function findProductBySlug($slug);
}