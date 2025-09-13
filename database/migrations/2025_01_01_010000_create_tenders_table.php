<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('tenders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('created_by'); // user who submitted
            $table->enum('status', ['pending','approved','disapproved'])->default('pending'); // admin approves
            $table->unsignedBigInteger('party_id')->nullable(); // party (tender owner) who will handle applications
            $table->date('closing_date')->nullable();
            $table->timestamps();

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('party_id')->references('id')->on('users')->onDelete('set null');
        });
    }
    public function down() {
        Schema::dropIfExists('tenders');
    }
};
