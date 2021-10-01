<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_address', function (Blueprint $table) {
            $table->unsignedBigInteger('id',true);
            $table->string('url',200)->unique();
            $table->unsignedTinyInteger('status_code')->default(0);
            $table->boolean('visible')->default(0);
            $table->binary('content')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('web_address', function (Blueprint $table) {
            $table->dropIfExists();
        });
    }
}
