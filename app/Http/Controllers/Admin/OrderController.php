<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class OrderController extends Controller
{
    public function __construct(protected OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        return $this->orderRepository->getAll();
    }

    public function create()
    {
        return $this->orderRepository->getAll();
    }
}
