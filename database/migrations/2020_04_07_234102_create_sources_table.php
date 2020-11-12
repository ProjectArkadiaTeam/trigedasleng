<?php

use App\Source;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sources', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title');
            $table->string('author');
            $table->date('date')->nullable();
            $table->string('url');
            $table->timestamps();
        });

        // Retrieve the seasons that should be imported
        $fileData = file_get_contents(dirname(__DIR__, 2) . '/bin/json/sources.json');
        $sources = json_decode($fileData, true);
        $params = [];
        foreach($sources as $source){
            $params[] = [
                'title' => $source['title'],
                'author' => $source['author'],
                'date' => $source['date'],
                'url' => $source['url'],
            ];
        }

        // If there are rows to insert, do so
        print $params[0]['title'];
        if(!empty($params)){
            foreach ($params as $source)
            {
                Source::create($source);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sources');
    }
}
