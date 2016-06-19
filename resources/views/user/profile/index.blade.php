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
    <h4 class="page-title">
        @if(Auth::user() == $user)
            My Profile
        @else
            Profile - {{$user->name}}
        @endif
    </h4>

    <div class="block-area">
        <div class="row">
            <div class="col-sm-6">
                <div class="tile-light p-10 m-b-15">
                    <div class="cover p-relative">
                        <img alt="" class="w-100" src="{{asset('assets/internal/img/default-profile-cover.jpg')}}">
                        <img alt="" src="{{asset('assets/internal/img/blue-user-icon.png')}}" class="profile-pic">
                        <div class="profile-btn">
                            <a class="btn btn-alt btn-sm" href="{{url('user/profile/edit')}}"><i class="icon-bubble"></i> <span>Edit Profile</span></a>
                        </div>
                    </div>
                    <div class="p-5 m-t-15">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis eget risus rhoncus, cursus purus vitae, venenatis eros. Phasellus at tincidunt risus. Integer sed massa fermentum, feugiat arcu quis, ultrices nisi. Quisque commodo nisi scelerisque, tempus diam ac, dignissim tellus. Mauris adipiscing elit tortor, dignissim auctor diam mollis sed. Nulla eu dui non velit accumsan scelerisque eget et felis.
                    </div>
                </div>
            </div>
            <div class="col-sm-8">

            </div>
        </div>
    </div>
    View Profile
    {!! $user !!}
    <br>
    Is Auth User {{Auth::user() == $user}}



@stop
@section('script')
@stop

