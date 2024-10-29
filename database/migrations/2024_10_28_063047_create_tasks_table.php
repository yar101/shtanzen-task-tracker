<?php

use App\Models\Status;
use App\Models\Task;
use App\Models\User;
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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body')->nullable();
            $table->foreignIdFor(User::class, 'created_by')->nullable();
            $table->foreignIdFor(User::class, 'updated_by')->nullable();
            $table->foreignIdFor(Status::class)->default('2');
            $table->date('deadline_start')->default(now());
            $table->date('deadline_end')->nullable();
            $table->integer('cost')->default(0)->nullable();
            $table->foreignIdFor(Task::class, 'parent_id')->nullable();
            $table->string('currency');
            $table->text('comment')->nullable();
            $table->string('priority')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
