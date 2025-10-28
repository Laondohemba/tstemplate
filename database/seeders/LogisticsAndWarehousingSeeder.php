<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Support\Str;

class LogisticsAndWarehousingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create service providers
        $logisticsUser = User::where('email', 'logistics@test.com')->first();
        if (!$logisticsUser) {
            $logisticsCat = ServiceCategory::where('slug', 'logistics-and-freight-forwarding')->first();
            $logisticsUser = User::create([
                'slug' => 'logistics-provider-' . uniqid(),
                'name' => 'Logistics Provider',
                'email' => 'logistics@test.com',
                'password' => bcrypt('password'),
                'role' => 'service_provider',
                'location' => 'Lagos, Nigeria',
                'service_category_id' => $logisticsCat ? $logisticsCat->id : null,
            ]);
        }

        $warehousingUser = User::where('email', 'warehousing@test.com')->first();
        if (!$warehousingUser) {
            $warehousingCat = ServiceCategory::where('slug', 'warehousing-and-cold-storage')->first();
            $warehousingUser = User::create([
                'slug' => 'warehousing-provider-' . uniqid(),
                'name' => 'Warehousing Provider',
                'email' => 'warehousing@test.com',
                'password' => bcrypt('password'),
                'role' => 'service_provider',
                'location' => 'Abuja, Nigeria',
                'service_category_id' => $warehousingCat ? $warehousingCat->id : null,
            ]);
        }

        // Get categories
        $logisticsCat = ServiceCategory::where('slug', 'logistics-and-freight-forwarding')->first();
        $warehousingCat = ServiceCategory::where('slug', 'warehousing-and-cold-storage')->first();

        if ($logisticsCat && !Service::where('service_category_id', $logisticsCat->id)->exists()) {
            Service::create([
                'user_id' => $logisticsUser->id,
                'service_category_id' => $logisticsCat->id,
                'company_name' => 'FastTrack Logistics Nigeria',
                'slug' => 'fasttrack-logistics',
                'description' => 'Leading logistics and freight forwarding company providing domestic and international shipping services. We specialize in agricultural products transportation with secure handling and timely delivery.',
                'contact_person' => 'John Smith',
                'email' => 'info@fasttracklogistics.com',
                'phone' => '+234 800 123 4567',
                'address' => '15 Marina Road, Lagos Island, Lagos',
                'location' => 'Lagos, Nigeria',
                'coverage_area' => 'Nationwide and International',
                'services_offered' => [
                    'Domestic Transportation',
                    'International Shipping',
                    'Customs Clearance',
                    'Freight Forwarding',
                    'Express Delivery',
                    'Cold Chain Logistics'
                ],
                'status' => 'active',
                'verification_status' => 'verified',
            ]);
        }

        if ($warehousingCat && !Service::where('service_category_id', $warehousingCat->id)->exists()) {
            Service::create([
                'user_id' => $warehousingUser->id,
                'service_category_id' => $warehousingCat->id,
                'company_name' => 'CoolStorage Warehouse Ltd',
                'slug' => 'coolstorage-warehouse',
                'description' => 'State-of-the-art cold storage and warehousing facilities designed for agricultural products. Temperature-controlled storage with 24/7 monitoring and inventory management services.',
                'contact_person' => 'Mary Johnson',
                'email' => 'info@coolstorage.com',
                'phone' => '+234 800 987 6543',
                'address' => 'Warehouse Complex, Industrial Area, Abuja',
                'location' => 'Abuja, Nigeria',
                'coverage_area' => 'Central Nigeria',
                'services_offered' => [
                    'Temperature-Controlled Storage',
                    'Dry Warehousing',
                    'Inventory Management',
                    'Product Preservation',
                    'Real-time Monitoring',
                    'Secure Storage'
                ],
                'status' => 'active',
                'verification_status' => 'verified',
            ]);
        }

        echo "Logistics and Warehousing services created successfully!\n";
    }
}
