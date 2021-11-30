<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('username', 25)->unique();
            $table->boolean('is_admin');
            $table->string('email')->unique();
            $table->string('password', 200);
            $table->string('no_telepon', 20)->unique();
            $table->string('alamat')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kota_kab')->nullable();
            $table->string('provinsi')->nullable();
            $table->char('kode_pos', 5)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
