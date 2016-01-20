@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-6">

            <h1>{{ trans('contactform.title') }}</h1>

            <div class="well">
                Notes for reviewer:
                <ul>
                    <li>You can set french version by appending ?locale=fr</li>
                    <li>You can set admin e-mail and recieve message by appending ?to=[email] to URL</li>
                </ul>
            </div>

            @if(\Session::has('message'))
                <div class="alert alert-success">{{\Session::get('message')}}</div>
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="" enctype="multipart/form-data">
                {{csrf_field()}}

                <div class="form-group">
                    <label for="name">{{ trans('contactform.name_field_title') }}*</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="" value="{{\Request::old("name")}}">
                </div>
                <div class="form-group">
                    <label for="surname">{{ trans('contactform.surname_field_title') }}</label>
                    <input type="surname" class="form-control" id="surname" name="surname" placeholder="" value="{{\Request::old("surname")}}">
                </div>
                <div class="form-group">
                    <label for="email">{{ trans('contactform.email_field_title') }}*</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="" value="{{\Request::old("email")}}">
                </div>
                <div class="form-group">
                    <label for="photo">{{ trans('contactform.photo_field_title') }}</label>
                    <input type="file" id="photo" name="photo">
                    <p class="help-block">{{ trans('contactform.photo_field_subtitle') }}</p>
                </div>
                <div class="form-group">
                    <label for="email">{{ trans('contactform.message_field_title') }}</label>
                    <textarea class="form-control" rows="3" id="message" name="message">{{\Request::old("message")}}</textarea>
                </div>
                <button type="submit" class="btn btn-success">{{ trans('contactform.send_button') }}</button>
            </form>

        </div>
    </div>
</div>
@append