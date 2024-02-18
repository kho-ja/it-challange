<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('y_t_comments', function (Blueprint $table) {
            $table->id();
            $table->string('channelId');
            $table->string('videoId');
            $table->string('textOriginal');
            $table->string('sentiment');
            $table->string('authorDisplayName');
            $table->string('authorProfileImageUrl');
            $table->string('authorChannelUrl');
            $table->string('likeCount');
            $table->string('publishedAt');
            $table->string('updatedAt');
            $table->string('commentId');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('y_t_comments');
    }
};
