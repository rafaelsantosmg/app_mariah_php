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
    Schema::create('products', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('description')->nullable();
      $table->float('cost_price');
      $table->float('sale_price');
      $table->float('profit_margin');
      $table->string('image')->nullable();
      $table->integer('stock')->default(0);
      $table->timestamps();
      $table->enum('stock_type', ['KG', 'UN'])->default('UN');
      $table->string('code')->unique()->nullable();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('products');
  }
};