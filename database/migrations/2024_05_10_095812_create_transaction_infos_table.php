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
        Schema::create('transaction_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('transaction_id')->nullable()->comment('unique transaction identifier for a particular transaction request');
            $table->integer('amount')->default(0)->comment('requested transaction amount');
            $table->text('remarks')->nullable()->comment('for comment on a particular transaction like why failed or if success then success message etc');
            $table->tinyInteger('transaction_status')->default(1)->comment('1 for success transaction and 0 for failed and 2 for on process');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_infos');
    }
};
