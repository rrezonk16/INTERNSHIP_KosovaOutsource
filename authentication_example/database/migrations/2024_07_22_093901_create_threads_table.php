<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThreadsTable extends Migration
{
   
    public function up()
    {
        Schema::create('threads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade'); 
            $table->integer('likes')->default(0);
            $table->text('description'); 
            $table->timestamps();
        });
    }

 
    public function down()
    {
        Schema::dropIfExists('threads');
    }
}
