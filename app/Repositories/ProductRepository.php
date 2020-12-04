<?php

namespace App\Repositories;

use App\Contracts\ProductContract;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Resources\UserResource;


/**
 * Class ProductRepository
 * @package App\Repositories
 * @author Haze Illias <hazreenaaida@gmail.com>
 */

class ProductRepository extends BaseRepository implements ProductContract
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
        $this->model = $model;
    }

    public function listProducts(string $order = 'id', string $sort = 'asc', array $columns = ['*'])
    {
       // return $this->all($columns, $order, $sort);
        return ProductResource::collection(Product::paginate(16));
    }

    public function findProductById(int $id)
    {
        try {
            return $this->findOneOrFail($id);

        } catch (ModelNotFoundException $e) {

            throw new ModelNotFoundException($e);
        }
    }

    public function findProductBySlug($slug)
    {
        return Product::where('slug', $slug)->first();
    }
}