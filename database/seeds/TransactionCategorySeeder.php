<?php

use Illuminate\Database\Seeder;

class TransactionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaction_categories')->insert(['name' => 'Acessórios']);
        DB::table('transaction_categories')->insert(['name' => 'Entretenimento']);
        DB::table('transaction_categories')->insert(['name' => 'Eventos']);
        DB::table('transaction_categories')->insert(['name' => 'Comida']);
        DB::table('transaction_categories')->insert(['name' => 'Combustível']);
    }
}
