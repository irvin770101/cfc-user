<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id')->comment('索引');
            $table->string('account', 50)->comment('帳戶');
            $table->string('password', 100)->comment('密碼');
            $table->string('name', 150)->comment('姓名');
            $table->string('email')->comment('email');
            $table->string('phone_number', 15)->nullable()->comment('電話號碼');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('member');
    }
}
