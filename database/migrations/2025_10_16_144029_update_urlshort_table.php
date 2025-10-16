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
            
            if(Schema::hasColumn('url_shortener','updated_at')){
                 $table->dropColumn('updated_at');
            }
            if(Schema::hasColumn('url_shortener','created_at')){
                $table->dropColumn('created_at');    
            }
           
            
            $table->dateTimeTz('updated_at',precision: 0)->nullable();
            $table->dateTimeTz('created_at',precision: 0)->nullable();
            
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
