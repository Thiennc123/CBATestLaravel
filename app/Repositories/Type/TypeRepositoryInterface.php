<?php
namespace App\Repositories\Type;

use App\Repositories\RepositoryInterface;

interface TypeRepositoryInterface extends RepositoryInterface
{
    public function getProduct();
}
