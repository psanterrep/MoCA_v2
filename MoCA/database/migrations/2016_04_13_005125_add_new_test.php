<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Test;

class AddNewTest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $test = new Test();
        $test->id = 1;
        $test->version = 1;
        $test->name ='Letters2Back';
        $test->active = true;
        $test->path ='Letters2Back_v1.html';
 
        $test->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $test = Test::find(1);
        $test->delete();
    }
}
