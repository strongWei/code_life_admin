<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePullRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pull_requests', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('project_id');
            $table->string('content', 400);
            $table->unsignedTinyInteger('status')
                ->comment('0:open, 1:closed')
                ->default(0);
            $table->unsignedTinyInteger('priority')
                ->comment('0:low, 1:normal, 2:important, 3:critical')
                ->default(1);
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
        Schema::dropIfExists('pull_requests');
    }
}
