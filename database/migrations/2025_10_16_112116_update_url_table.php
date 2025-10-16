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
        //
        Schema::table('url_shortener', function (Blueprint $table) {
            
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            $table->timestamp('created_at', precision: 0);
            
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
