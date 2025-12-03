<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $minLat = 33.50; 
        $maxLat = 33.60; 
        $minLon = 36.20; 
        $maxLon = 36.30; 

        return [
            // 2. phone_number
            // استخدام دالة phoneNumber() لإنشاء رقم هاتف وهمي
            'phone_number' => fake()->phoneNumber(), 
            
            // 3. email
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            
            // 4. password
            'password' => bcrypt('password'), // كلمة مرور موحدة وسهلة للتجربة
            
            // 5. latitude
            'latitude' => fake()->randomFloat(8, $minLat, $maxLat),
            
            // 6. longitude
            'longitude' => fake()->randomFloat(8, $minLon, $maxLon),
            
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
