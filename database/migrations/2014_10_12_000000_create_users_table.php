<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (env('DB_MIGRATE_USERS')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('account')->nullable()->comment('帳號名稱');
                $table->string('name')->nullable()->comment('名字');
                $table->string('email')->nullable()->comment('電子郵件');
                $table->string('nation')->nullable()->comment('國際碼');
                $table->string('mobile')->nullable()->comment('行動電話');
                $table->string('phone')->nullable()->comment('國際碼+行動電話');
                $table->string('password')->comment('名字');
                $table->string('address')->nullable()->comment('地址');
                $table->string('verify_mode')->nullable()->comment('兩階段驗證方式');
                $table->string('2fa_secret')->nullable()->comment('2fa密鑰');
                $table->string('otp_code',10)->nullable()->comment('簡訊碼');
                $table->datetime('otp_time')->nullable()->comment('簡訊碼到期時間');
                $table->date('birthDay')->nullable()->comment('生日');
                $table->boolean('lock_on')->default(0)->comment('0:未鎖定, 超過次數限制鎖定');
                $table->boolean('status')->default(0)->comment('-9:已刪除, -3:鎖定, -1:停用, 0:未完成註冊, 1:完成註冊');
                $table->rememberToken();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (env('DB_MIGRATE_USERS')) {
            Schema::dropIfExists('users');
        }
    }
};
