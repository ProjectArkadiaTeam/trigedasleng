<?php

use App\Group;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->boolean('admin')->default(0);
            $table->boolean('default')->default(0)->unique(); // Only one group can be the default
            $table->timestamps();
        });

        // Create Admin Group
        $group = new Group([
            'name'  => 'Admin',
            'admin' => 1,
        ]);
        $group->save();
        // Create Registered Group
        $group = new Group([
            'name'    => 'Registered',
            'default' => 1,
        ]);
        $group->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
