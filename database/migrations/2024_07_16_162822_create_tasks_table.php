<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('order_id')->nullable()->constrained();
            $table->foreignUlid('item_id')->nullable()->constrained();
            $table->string('print_data');
            $table->tinyInteger('completion_status')->default(0)->comment('0:タスク未終了, 1:タスク完了, 2:ラベル印刷完了');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
