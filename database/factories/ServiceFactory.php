<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $companyName = fake()->company();
        
        return [
            'user_id' => \App\Models\User::factory(),
            'service_category_id' => \App\Models\ServiceCategory::inRandomOrder()->first()->id ?? 1,
            'company_name' => $companyName,
            'slug' => \Illuminate\Support\Str::slug($companyName . '-' . fake()->unique()->numerify('####')),
            'description' => fake()->paragraphs(3, true),
            'contact_person' => fake()->name(),
            'email' => fake()->companyEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'location' => fake()->randomElement(['Lagos', 'Abuja', 'Port Harcourt', 'Kano', 'Ibadan', 'Enugu', 'Kaduna']),
            'coverage_area' => fake()->randomElement(['Nationwide', 'Lagos, Abuja', 'South-South', 'South-West', 'North']),
            'services_offered' => fake()->randomElements([
                'Domestic Transportation',
                'International Shipping',
                'Customs Clearance',
                'Temperature-Controlled Storage',
                'Dry Storage',
                'Quality Testing',
                'Certification',
                'Product Packaging',
                'Branding Services',
            ], fake()->numberBetween(3, 6)),
            'images' => [
                'services/service-1.jpg',
                'services/service-2.jpg',
            ],
            'website' => fake()->optional()->url(),
            'rating' => fake()->randomFloat(2, 3.5, 5.0),
            'reviews_count' => fake()->numberBetween(0, 150),
            'verification_status' => fake()->randomElement(['verified', 'pending']),
            'verification_badge' => fake()->randomElement(['Verified', 'Government Approved', null]),
            'status' => fake()->randomElement(['active', 'active', 'active', 'inactive']), // 75% active
        ];
    }
}
