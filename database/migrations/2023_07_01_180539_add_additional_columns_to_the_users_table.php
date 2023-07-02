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
        Schema::table('users', static function (Blueprint $table) {
            $table->string('firstname')->nullable()->after('name');
            $table->string('surname')->nullable()->after('firstname');
            $table->string('patronymic')->nullable()->after('surname');
            $table->unsignedBigInteger('role_id')->default(1)->nullable()->index();

            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropColumns('users', ['firstname', 'surname', 'patronymic', 'role_id']);
    }
};
