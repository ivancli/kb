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
            <div class="col-lg-4 col-md-6">
                <div class="tile-light p-10 m-b-15">
                    <div class="cover p-relative">
                        <img alt="" class="w-100" src="{{asset('build/img/default-profile-cover.jpg')}}">
                        <img alt="" src="{{url('media/profile/' . rawurlencode($user->name) . '/' . $user->id)}}" class="profile-pic">

                        <div class="profile-btn">
                            <a class="btn btn-alt btn-sm" href="{{url('user/profile/edit')}}"><i class="icon-bubble"></i>
                                <span>Edit Profile</span></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="p-5 p-l-15 m-t-15">
                                <h4><strong>{{ $user->name }}</strong></h4>
                            </div>

                            {{-- roles --}}
                            @if(count($user->roles) > 0)
                                <div class="p-5 p-l-15">
                                    @foreach($user->roles as $role)
                                        <div><i class="fa fa-tag role-tag"></i> &nbsp; {{ $role->display_name }}</div>
                                    @endforeach
                                </div>
                            @endif

                            {{-- description --}}
                            @if(!is_null($user->info))
                                <div class="p-5 p-l-15">
                                    {{ $user->info->description }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-6">

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

