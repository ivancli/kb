<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 19/06/2016
 * Time: 3:11 PM
 */
?>

@extends('layouts.neat')
@section('title')
    ICL KB - Edit Profile
@stop
@section('link')
@stop
@section('content')
    <h4 class="page-title">Edit Profile</h4>
    <div class="block-area">
        <div class="row">
            <div class="col-sm-12">
                <div class="tile">
                    <h2 class="tile-title">Edit Profile</h2>

                    <div class="tile-config dropdown">
                        <a class="tile-menu" href="#" data-toggle="dropdown"></a>
                        <ul class="dropdown-menu animated pull-right text-right">
                            <li><a href="#">Reset</a></li>
                        </ul>
                    </div>
                    <div class="p-15">
                        <div class="error-msgs">
                            <ul></ul>
                        </div>
                        {!! Form::model($user, array('route' => array('admin.user.update', $user->id), 'method' => 'patch', 'files' => true, 'onsubmit' => 'return false;', "id" => "frm-update-user")) !!}

                        <div class="form-group">
                            {!! Form::label('name', 'Full name') !!}
                            {!! Form::text('name', old('name'), ['class' => 'form-control input-sm', 'placeholder' => 'full name']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', 'Email') !!}
                            {!! Form::text('email', old('email'), ['class' => 'form-control input-sm', 'placeholder' => 'email', 'disabled' => 'disabled']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('status', 'Status') !!} &nbsp;
                            {!! Form::select('status', array('active' => 'active', 'inactive' => 'inactive', 'locked' => 'locked', 'deleted' => 'deleted'), old('status'), ['class' => 'control-inline form-control input-sm m-b-5']) !!}
                        </div>
                        {!! Form::submit('Save', ["class"=>"btn btn-default btn-sm", "href"=>"#", "onclick" => "updateUserOnClick()"]) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop
@section('script')
@stop
