<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->integer('vendor_id')->unsigned();
			$table->foreign('vendor_id')->references('id')->on('companies');
            $table->date('proposed_date1')->nullable();
            $table->date('proposed_date2')->nullable();
            $table->date('proposed_date3')->nullable();
            $table->string('proposed_postal_code')->nullable();
            $table->text('proposed_street_name')->nullable();
            $table->tinyInteger('confirmed_date_index')->nullable();
            $table->integer('confirmed_by')->unsigned()->nullable();
			$table->foreign('confirmed_by')->references('id')->on('users');
            $table->text('remarks')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->nullable();
            $table->integer('created_by')->unsigned();
			$table->foreign('created_by')->references('id')->on('users');
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
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign('events_vendor_id_foreign');
            $table->dropColumn('vendor_id');
            $table->dropForeign('events_confirmed_by_foreign');
            $table->dropColumn('confirmed_by');
        });
        Schema::dropIfExists('events');
    }
}
