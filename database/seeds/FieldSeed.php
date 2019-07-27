<?php

use Illuminate\Database\Seeder;
use App\Field;

class FieldSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Field::class)->create([
            'name' => 'name',
            'label' => 'Company name'
        ]);

        factory(Field::class)->create([
            'name' => 'vat',
            'label' => 'Company vat number'
        ]);
    }
}
