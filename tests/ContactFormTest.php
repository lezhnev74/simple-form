<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ContactFormTest extends TestCase
{
    /**
     * Test form opens ok in different languages
     *
     * @return void
     */
    public function test_form_accessible()
    {

        $this->visit('/')->see(trans('contactform.title'));

        $this->visit('/?locale=fr')->see(trans('contactform.title',[],[],'fr'));
    }


    /**
     * Test that form will not send email without required fields
     */
    public function test_required_fields() {

        $this
            ->visit('/')
            ->press(trans('contactform.send_button'))
            ->dontSee(trans('contactform.success_message'))
            ->see(trans('validation.required',['attribute'=>'name']))
            ->see(trans('validation.required',['attribute'=>'email']));

        $this
            ->visit('/')
            ->type('Dmitriy','name')
            ->type('worng@email','email')
            ->press(trans('contactform.send_button'))
            ->dontSee(trans('contactform.success_message'))
            ->dontSee(trans('validation.required',['attribute'=>'name']))
            ->see(trans('validation.email',['attribute'=>'email']));

        $this
            ->visit('/')
            ->attach(base_path('tests/res/favicon.ico'),'photo')
            ->press(trans('contactform.send_button'))
            ->see(trans('validation.image',['attribute'=>'photo']));

    }

    /**
     * Test that form will send the email
     */
    public function test_success_form_sending() {

        $this
            ->visit('/')
            ->type('Dmitriy','name')
            ->type('Lezhnev','surname')
            ->type('good@email.com','email')
            ->attach(base_path('tests/res/photo.png'),'photo')
            ->press(trans('contactform.send_button'))
            ->see(trans('contactform.success_message'));

    }
}
