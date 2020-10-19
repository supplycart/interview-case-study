<?php
namespace App\Contracts;

interface OrderContract
{
  public function getAll($request);

  public function newOrder($request);

  public function updateOrder($request, $id);
}