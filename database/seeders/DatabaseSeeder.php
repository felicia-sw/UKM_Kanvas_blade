<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // The order is important!
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ProfileSeeder::class,
            ArtworkCategorySeeder::class,
            ArtworkSeeder::class,
            EventSeeder::class,
            EventRegistrationSeeder::class,
            RundownSeeder::class,
            EventBudgetItemSeeder::class,
            DocumentationSeeder::class,
            MerchandiseCategorySeeder::class,
            MerchandiseSeeder::class,
            ShoppingCartSeeder::class,
            CartItemSeeder::class,
            MerchandiseOrderSeeder::class,
            MerchandiseOrderItemSeeder::class,
            DuesPeriodSeeder::class,
            DuesPaymentSeeder::class,
            NotificationSeeder::class,
            ContactUsSeeder::class,
            IncomeExpenseSeeder::class
        ]);
    }
}
