<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Logistics and Freight Forwarding',
                'slug' => 'logistics-and-freight-forwarding',
                'description' => 'Domestic haulage, export shipping, clearing & forwarding solutions for seamless product delivery.',
                'icon' => 'fas fa-truck',
                'color' => 'green',
            ],
            [
                'name' => 'Warehousing and Cold Storage',
                'slug' => 'warehousing-and-cold-storage',
                'description' => 'Secure storage facilities with temperature control for preserving product quality and freshness.',
                'icon' => 'fas fa-warehouse',
                'color' => 'blue',
            ],
            [
                'name' => 'Quality Inspection and Certification',
                'slug' => 'quality-inspection-and-certification',
                'description' => 'Product testing, quality assurance, and international certification services.',
                'icon' => 'fas fa-certificate',
                'color' => 'purple',
            ],
            [
                'name' => 'Packaging and Branding',
                'slug' => 'packaging-and-branding',
                'description' => 'Export-ready packaging, labeling, and branding solutions for agri-products.',
                'icon' => 'fas fa-box-open',
                'color' => 'pink',
            ],
            [
                'name' => 'Export Advisory and Trade Consulting',
                'slug' => 'export-advisory-and-trade-consulting',
                'description' => 'Expert guidance on compliance, documentation, and market entry strategies.',
                'icon' => 'fas fa-handshake',
                'color' => 'orange',
            ],
            [
                'name' => 'Equipment Leasing and Machinery Supply',
                'slug' => 'equipment-leasing-and-machinery-supply',
                'description' => 'Access to modern agricultural equipment and machinery for efficient operations.',
                'icon' => 'fas fa-tractor',
                'color' => 'yellow',
            ],
            [
                'name' => 'Cooperative Association',
                'slug' => 'cooperative-association',
                'description' => 'Join or partner with agricultural cooperatives for collective bargaining and resource sharing.',
                'icon' => 'fas fa-users',
                'color' => 'indigo',
            ],
        ];

        foreach ($categories as $category) {
            ServiceCategory::create($category);
        }
    }
}
