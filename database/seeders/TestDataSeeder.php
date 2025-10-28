<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test service provider user
        $serviceProvider = User::create([
            'name' => 'Test Logistics Company',
            'email' => 'logistics@test.com',
            'password' => Hash::make('password'),
            'role' => 'service_provider',
            'slug' => 'test-logistics-company',
            'email_verified_at' => now(),
        ]);

        // Get the logistics category
        $logisticsCategory = ServiceCategory::where('slug', 'logistics-and-freight-forwarding')->first();

        if ($logisticsCategory) {
            // Create a test service
            Service::create([
                'user_id' => $serviceProvider->id,
                'service_category_id' => $logisticsCategory->id,
                'company_name' => 'Test Logistics Company',
                'slug' => 'test-logistics-company-' . uniqid(),
                'description' => 'Professional freight forwarding and logistics services across Nigeria. Specializing in agricultural product transportation with temperature-controlled vehicles.',
                'contact_person' => 'John Doe',
                'email' => 'contact@testlogistics.com',
                'phone' => '+234 800 000 0000',
                'address' => '123 Logistics Street, Lagos, Nigeria',
                'location' => 'Lagos, Nigeria',
                'coverage_area' => 'West Africa',
                'services_offered' => [
                    'Domestic Transportation',
                    'International Shipping',
                    'Customs Clearance',
                    'Temperature-Controlled Transport'
                ],
                'images' => [],
                'website' => 'https://www.testlogistics.com',
                'verification_status' => 'verified',
                'status' => 'active',
            ]);
        }

        // Create another test service provider
        $serviceProvider2 = User::create([
            'name' => 'Nigerian Freight Solutions',
            'email' => 'freight@test.com',
            'password' => Hash::make('password'),
            'role' => 'service_provider',
            'slug' => 'nigerian-freight-solutions',
            'email_verified_at' => now(),
        ]);

        if ($logisticsCategory) {
            // Create another test service
            Service::create([
                'user_id' => $serviceProvider2->id,
                'service_category_id' => $logisticsCategory->id,
                'company_name' => 'Nigerian Freight Solutions',
                'slug' => 'nigerian-freight-solutions-' . uniqid(),
                'description' => 'Comprehensive logistics solutions including warehousing, freight forwarding, and distribution services across West Africa.',
                'contact_person' => 'Jane Smith',
                'email' => 'contact@nigerianfreight.com',
                'phone' => '+234 800 111 1111',
                'address' => '456 Freight Avenue, Abuja, Nigeria',
                'location' => 'Abuja, Nigeria',
                'coverage_area' => 'West Africa',
                'services_offered' => [
                    'Road Transport',
                    'Sea Freight',
                    'Air Cargo',
                    'Distribution Services'
                ],
                'images' => [],
                'website' => 'https://www.nigerianfreight.com',
                'verification_status' => 'verified',
                'status' => 'active',
            ]);
        }

        $this->command->info('Test data created successfully!');
    }
}