<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentAccountToTicketsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->unsignedBigInteger('payment_account_id')->after('event_id')->nullable();

            $table->foreign('payment_account_id')
                ->references('id')
                ->on('payment_accounts')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         if (Schema::hasColumn('tickets', 'payment_account_id')) {

            Schema::table('tickets', function (Blueprint $table) {
                $table->dropColumn('payment_account_id');
            });
        }
    }
}
