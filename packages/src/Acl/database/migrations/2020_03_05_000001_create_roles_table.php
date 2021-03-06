<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $name = config('acl.tables.roles','roles');

        Schema::create($name, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tenant_id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->enum('special', ['all-access', 'no-access'])->nullable();
            $table->enum('status', ['deleted','draft', 'published'])->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['name','tenant_id']);
            $table->unique(['slug','tenant_id']);
            $table->foreign('tenant_id')->references('id')
                ->on('tenants')
                ->onDelete('cascade');
            $table->foreign('user_id')->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migration.
     *
     * @return void
     */
    public function down()
    {
        $name = config('shinobi.tables.roles','roles');

        Schema::drop($name);
    }
}
