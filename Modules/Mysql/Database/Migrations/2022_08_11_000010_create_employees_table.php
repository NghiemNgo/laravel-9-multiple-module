<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 20)->comment("Mã nhân viên");
            $table->string('full_name', 50)->comment("Họ và tên");
            $table->string('user_name', 50)->comment("Tên đăng nhập");
            $table->string('email')->unique()->comment("Email đăng ký");
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone_number', 20);
            $table->string('identity_number', 20)->comment("CMT/CCCD");
            $table->tinyInteger('is_active')->default(2); //inactive
            $table->rememberToken();
            $table->text('img_url')->nullable();
            $table->string('residential_address', 100)->comment("Địa chỉ cư trú, nơi ở hiện tại");
            $table->string('permanent_address', 100)->comment("Địa chỉ thường trú, nơi đăng ký thường trú với cơ quan nhà nước.");
            $table->text('app_token')->nullable();
            $table->text('web_token')->nullable();
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}