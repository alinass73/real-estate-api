<?php

use App\Enums\Category;
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
        Schema::create('real_estates', function (Blueprint $table) {
            $table->id();
            $table->enum('category', [Category::APARTMENT->value, Category::VILLA->value, Category::PENTHOUSE->value])->default(Category::VILLA);
            $table->double('price');
            $table->string('address');
            $table->integer('bedroom');
            $table->integer('bathroom');
            $table->bigInteger('area');
            $table->integer('floor');
            $table->integer('parking');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('real_estates');
    }
};
