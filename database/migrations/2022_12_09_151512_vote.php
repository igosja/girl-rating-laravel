<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    private const TABLE = 'votes';

    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create(self::TABLE, static function (Blueprint $table) {
            $table->id();
            $table->bigInteger('girl_one_id')->unsigned();
            $table->bigInteger('girl_two_id')->unsigned();
            $table->bigInteger('girl_winner_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table(self::TABLE, static function (Blueprint $table) {
            $table->foreign('girl_one_id')->references('id')->on('girls');
            $table->foreign('girl_two_id')->references('id')->on('girls');
            $table->foreign('girl_winner_id')->references('id')->on('girls');
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists(self::TABLE);
    }
};
