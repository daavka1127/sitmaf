<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('companyName', 250);
            $table->string('ajliinHeseg', 150);
            $table->double('hursHuulalt', 12, 2)->nullable();
            $table->double('dalan', 12, 2)->nullable();
            $table->double('uhmal', 12, 2)->nullable();
            $table->double('suuriinUy', 12, 2)->nullable();
            $table->double('shuuduu', 12, 2)->nullable();
            $table->double('uhmaliinHamgaalalt', 12, 2)->nullable();
            $table->double('uuliinShuuduu', 12, 2)->nullable();
            $table->double('niit', 14, 2);
            $table->date('gereeOgnoo');
            $table->integer('hunHuch');
            $table->integer('mashinTehnik');
            $table->double('gHursHuulalt', 12, 2)->nullable();
            $table->double('gDalan', 12, 2)->nullable();
            $table->double('gUhmal', 12, 2)->nullable();
            $table->double('gSuuriinUy', 12, 2)->nullable();
            $table->double('gShuuduu', 12, 2)->nullable();
            $table->double('gUhmaliinHamgaalalt', 12, 2)->nullable();
            $table->double('gUuliinShuuduu', 12, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_companies');
    }
}
