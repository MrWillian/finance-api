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
        DB::table('transaction_categories')->insert(['name' => 'Lucro']);
        DB::table('transaction_categories')->insert(['name' => 'Acessório']);
        DB::table('transaction_categories')->insert(['name' => 'Automóvel']);
        DB::table('transaction_categories')->insert(['name' => 'Casa']);
        DB::table('transaction_categories')->insert(['name' => 'Combustível']);
        DB::table('transaction_categories')->insert(['name' => 'Comida']);
        DB::table('transaction_categories')->insert(['name' => 'Eletrodoméstico']);
        DB::table('transaction_categories')->insert(['name' => 'Entretenimento']);
        DB::table('transaction_categories')->insert(['name' => 'Evento']);
        DB::table('transaction_categories')->insert(['name' => 'Supermercado']);
    }
}
