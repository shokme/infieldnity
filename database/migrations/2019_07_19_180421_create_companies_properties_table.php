<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_properties', function (Blueprint $table) {
            $table->string('name')->primary()->unique();
            $table->string('label');
            $table->string('description')->nullable();
            $table->string('group_name');
            $table->string('type');
            $table->string('field_type');
            $table->integer('update_user_id');
            $table->boolean('deleted')->default(false);
            $table->boolean('form_field');
            $table->integer('display_order');
            $table->boolean('read_only_value')->default(false);
            $table->boolean('hidden')->default(false);
            $table->boolean('mutable_definition_not_deletable')->default(false);
            $table->boolean('calculated')->default(false);
            $table->boolean('externalOptions')->default(false);
            $table->integer('created_user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies_properties');
    }
}
