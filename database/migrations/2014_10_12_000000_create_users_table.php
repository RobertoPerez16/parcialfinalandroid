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

            $table->string('identificacion',11);
            $table->string('nombre');
            $table->string('apellido');
            $table->string('email', 191)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->string('estado_civil')->nullable();
            $table->string('estrato')->nullable();
            $table->string('profesion')->nullable();
            $table->string('cargo')->nullable();
            $table->string('nivel_estudio')->nullable();
            $table->primary('identificacion');
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
