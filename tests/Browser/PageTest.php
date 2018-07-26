<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PageTest extends DuskTestCase
{
    /** @test */
    public function it_shows_the_correct_table_names()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->type('@parent-input', 'post')
                    ->type('@child-input', 'comment');

            $browser->assertSeeIn("@migration-parent-file-name", "create_posts_table")
                    ->assertSeeIn("@migration-child-file-name", "create_comments_table");
        });
    }

    /** @test */
    public function it_shows_a_correct_indefinite_article_for_the_child_text_and_the_parent_text()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->type('@parent-input', 'orange')
                    ->type('@child-input', 'author');

            $browser->assertSeeIn("@parent-indefinite-article", "An");
            $browser->assertSeeIn("@child-indefinite-article", "an");
        });
    }
}
