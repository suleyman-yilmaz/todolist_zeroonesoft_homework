<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // 'id' sütunu otomatik olarak primary key ve auto increment olur.
            $table->string('task'); // 'task' sütunu için string veri tipi
            $table->boolean('status')->default(false); // 'status' sütunu, boolean veri tipi ve varsayılan olarak false
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
