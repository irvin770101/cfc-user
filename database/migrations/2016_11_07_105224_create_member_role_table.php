<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_role', function(Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->unsignedInteger('member_id')->comment('成員索引');
            $table->unsignedInteger('role_id')->comment('角色索引');
            $table->timestamps();
        });

        Schema::table('member_role', function(Blueprint $table) {
            $table->primary(['member_id', 'role_id']);
            $table->foreign('member_id')
                ->references('id')->on('member')
                ->onDelete('cascade');
            $table->foreign('role_id')
                ->references('id')->on('role')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('member_role');
    }
}
