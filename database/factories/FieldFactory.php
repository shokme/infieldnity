<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use App\Field;

$factory->define(Field::class, function (Faker $faker) {
    return [
        'name' => 'name',
        'label' => 'label',
        'description' => null,
        'group_name' => 'base',
        'type' => 'string',
        'field_type' => 'field',
        'update_user_id' => 1,
        'deleted' => false,
        'form_field' => true,
        'display_order' => 1,
        'read_only_value' => false,
        'hidden' => false,
        'mutable_definition_not_deletable' => false,
        'calculated' => false,
        'externalOptions' => false,
        'created_user_id' => 1
    ];
});
