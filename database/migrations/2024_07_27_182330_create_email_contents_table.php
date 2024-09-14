<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailContentsTable extends Migration
{
    public function up()
    {
        Schema::create('email_contents', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('email_contents');
    }
}

