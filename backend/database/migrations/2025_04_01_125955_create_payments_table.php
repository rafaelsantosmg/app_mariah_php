<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('payments', function (Blueprint $table) {
      $table->id();
      $table->timestamps();
      $table->string('method')->nullable();
      $table->string('installment')->nullable();
      $table->foreignId('sale_id')->nullable()->constrained('sales')->onDelete('set null');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('payments');
  }
};
