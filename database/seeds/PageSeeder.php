<?php

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::insert([
            'slug' => 'faq',
            'title' => 'FAQ',
            'description' => '<div class="row card-group-row">
            <div class="col-md-6 card-group-row__col">

                <div class="card card--elevated card-group-row__card">
                    <div class="card-body d-flex">
                        <span
                            class="icon-holder icon-holder--outline-muted rounded-circle d-inline-flex mr-16pt">
                            <i class="material-icons">question_answer</i>
                        </span>
                        <div class="flex">
                            <a class="card-title mb-4pt" href="">Do you offer a free trial?</a>
                            <p class="text-70 mb-0">We offer everyone a 7 day free trial! You can
                                take advantage of it by visiting our sign-up page! Lorem ipsum dolor
                                sit amet, consectetur adipisicing elit. Porro, ab!</p>
                        </div>
                    </div>
                    <div class="card-footer d-flex lh-1 px-16pt py-8pt">
                        <div class="flex text-muted"><small>7 people found this useful</small></div>
                        <a href="#" class="text-20"><i
                                class="material-icons icon-16pt">thumb_up</i></a>
                    </div>
                </div>

            </div>
            <div class="col-md-6 card-group-row__col">

                <div class="card card--elevated card-group-row__card">
                    <div class="card-body d-flex">
                        <span
                            class="icon-holder icon-holder--outline-muted rounded-circle d-inline-flex mr-16pt">
                            <i class="material-icons">question_answer</i>
                        </span>
                        <div class="flex">
                            <a class="card-title mb-4pt" href="">Can I gift a subscription to
                                someone?</a>
                            <p class="text-70 mb-0">Yes! We do offer certificates. Please email us
                                for more information. Lorem ipsum dolor sit amet, consectetur
                                adipisicing elit. Eos, ad!</p>
                        </div>
                    </div>
                    <div class="card-footer d-flex lh-1 px-16pt py-8pt">
                        <div class="flex text-muted"><small>7 people found this useful</small></div>
                        <a href="#" class="text-20"><i
                                class="material-icons icon-16pt">thumb_up</i></a>
                    </div>
                </div>

            </div>
            <div class="col-md-6 card-group-row__col">

                <div class="card card--elevated card-group-row__card">
                    <div class="card-body d-flex">
                        <span
                            class="icon-holder icon-holder--outline-muted rounded-circle d-inline-flex mr-16pt">
                            <i class="material-icons">question_answer</i>
                        </span>
                        <div class="flex">
                            <a class="card-title mb-4pt" href="">I have a great idea for an
                                application or website, but need help on where to begin. Can you
                                guys help me?</a>
                            <p class="text-70 mb-0">We advise posting personal requests in our
                                Community Forum Lorem ipsum dolor sit amet.</p>
                        </div>
                    </div>
                    <div class="card-footer d-flex lh-1 px-16pt py-8pt">
                        <div class="flex text-muted"><small>7 people found this useful</small></div>
                        <a href="#" class="text-20"><i
                                class="material-icons icon-16pt">thumb_up</i></a>
                    </div>
                </div>

            </div>
            <div class="col-md-6 card-group-row__col">

                <div class="card card--elevated card-group-row__card">
                    <div class="card-body d-flex">
                        <span
                            class="icon-holder icon-holder--outline-muted rounded-circle d-inline-flex mr-16pt">
                            <i class="material-icons">question_answer</i>
                        </span>
                        <div class="flex">
                            <a class="card-title mb-4pt" href="">I found a bug. Where can I report
                                that?</a>
                            <p class="text-70 mb-0">In the unlikely situation you stumble across a
                                bug, go ahead and shoot us an email. Lorem ipsum dolor sit amet.</p>
                        </div>
                    </div>
                    <div class="card-footer d-flex lh-1 px-16pt py-8pt">
                        <div class="flex text-muted"><small>7 people found this useful</small></div>
                        <a href="#" class="text-20"><i
                                class="material-icons icon-16pt">thumb_up</i></a>
                    </div>
                </div>

            </div>
        </div>'
        ],
        [
            'slug' => 'contact',
            'title' => 'Contact',
            'description' => ''
        ]);
    }
}
