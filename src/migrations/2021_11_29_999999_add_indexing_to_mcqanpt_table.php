<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class addIndexingToMcqanptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* mcqanpt table */
        if (Schema::hasTable('fmt_mcqanpt_ans')) {
            Schema::table('fmt_mcqanpt_ans', function (Blueprint $table) {
                $table->index('question_id');
                $table->index('active');
                $table->index('arrange');
                $table->index('media_id');
            });
        }
        if (Schema::hasTable('fmt_mcqanpt_ques')) {
            Schema::table('fmt_mcqanpt_ques', function (Blueprint $table) {
                $table->index('media_id');
                $table->index('active');
            });
        }
        /* end of mcqanpt table */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('fmt_mcqanpt_ques');
    }
}
