<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => 'Order',
            'status' => Order::STATUS_PENDING,
        ];
    }

    public function completed(): static
    {
        return $this->state(fn () => [
            'status' => Order::STATUS_COMPLETED,
        ]);
    }
}
