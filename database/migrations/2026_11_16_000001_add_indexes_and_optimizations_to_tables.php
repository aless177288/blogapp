<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesAndOptimizationsToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unique('url');
            $table->index('published_at');
            $table->index('category_id');
        });

        Schema::table('photos', function (Blueprint $table) {
            $table->index('post_id');
        });

        Schema::table('post_tag', function (Blueprint $table) {
            $table->index(['post_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropUnique(['url']);
            $table->dropIndex(['published_at']);
            $table->dropIndex(['category_id']);
        });

        Schema::table('photos', function (Blueprint $table) {
            $table->dropIndex(['post_id']);
        });

        Schema::table('post_tag', function (Blueprint $table) {
            $table->dropIndex(['post_id', 'tag_id']);
        });
    }
}
