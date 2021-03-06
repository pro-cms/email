<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('project')->index();
            $table->text('from');
            $table->text('to');
            $table->text('cc')->nullable();
            $table->text('bcc')->nullable();
            $table->text('attachments')->nullable();
            $table->string('subject')->nullable()->index();
            $table->longText('body')->nullable();
            $table->string('provider')->default('mailgun')->index();
            $table->enum('status', ['pending', 'queued', 'sent', 'failed'])->default('pending');
            $table->integer('retries')->default(0)->index();
            $table->string('remote_identifier')->nullable();
            $table->text('notes')->nullable();
            $table->integer('bounces_count')->default(0)->index();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('emails');
    }
}