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

        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 201', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/19155160']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 202', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/19199608']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 203', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23313577']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 204', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23313640']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 205', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23313661']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 206', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23313712']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 207', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23313772']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 208', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23329453']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 209', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23329549']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 210', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23329630']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 211', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23329675']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 212', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23329756']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 213', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23329819']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 214', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23329843']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 215', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23329897']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 216', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23329924']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 301', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23413300']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 302', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23413414']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 303', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23413582']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 304', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23413678']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 305', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23413729']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 306', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23413795']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 307', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23430421']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 308', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23430484']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 309', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23430577']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 310', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23430643']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 311', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23430661']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 312', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23430691']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 313', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23430727']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 314', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23430754']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 315', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23430772']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 401', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23447074']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 402', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23447185']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 403', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23447236']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 404', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23447323']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 405', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23447362']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 406', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23447452']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 407', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23447491']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 408', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23447530']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 409', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23529418']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 410', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23529463']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 411', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23529490']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 412', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23529529']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 413', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23529589']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 501', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23529634']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 502', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23529670']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 504', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23529706']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 505', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23529739']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 506', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23546251']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 507', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23546287']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 508', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23546305']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 509', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23546329']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 510', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23546338']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 511', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/23280970']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 512', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/19061950']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 513', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/19056259']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 601', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/18667216']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 605', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/19013002']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 606', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/19186828']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 609', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/19752745']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 610', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/19928833']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 611', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/19992034']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 613', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/20147977']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 701', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/24312706']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 703', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/24426805']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 705', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/24786253']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 706', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/24939754']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 708', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/25174993']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 709', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/25304515']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 710', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/25744399']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 712', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/26006743']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 713', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/26387512']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 714', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/26523919']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 715', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/26643997']))->save();
        (new Source(['title'  => 'Conlang Dialogue: The 100, Episode 716', 'author' => 'Peterson, David J.', 'date' => null, 'url' => 'https://archiveofourown.org/works/26746144']))->save();
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
