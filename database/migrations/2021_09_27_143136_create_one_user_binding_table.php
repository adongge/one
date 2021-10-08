<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOneUserBindingTable extends Migration
{
    public $prefix = '';
    public $one_prefix = '';

    public function __construct()
    {
        $this->prefix = config('database.connections.mysql.prefix');
        $this->one_prefix = config('one.app.database.prefix', 'one_');
    }
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->one_prefix . 'user_binding', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable()->comment('绑定的用户ID');
            $table->string('type')->default('wx_app')->comment('wx_app:微信小程序');  
            $table->string('app_id');
            $table->string('open_id');
            $table->string('nick_name')->nullable();
            $table->string('sex')->nullable();
            $table->string('email')->nullable();
            $table->string('avatar')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('country')->nullable();
            $table->string('language')->nullable();
            $table->string('unionid')->nullable();

            $table->unique(['app_id', 'open_id'],'unique_app_open_id');
            $table->foreign('user_id')
                ->references('id')
                ->on($this->prefix . 'users')
                ->onDelete('cascade');
        });
        \Illuminate\Support\Facades\DB::statement("alter table {$this->one_prefix}user_binding comment '用户绑定表'");
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->one_prefix.'user_binding');
    }
}
