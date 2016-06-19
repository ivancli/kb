<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 13/06/2016
 * Time: 1:11 AM
 */
?>

@extends('layouts.neat')
@section('title')
    ICL KB - User
@stop
@section('link')
@stop
@section('content')
    <h4 class="page-title">Edit User: {{$user->name}}</h4>
    <div class="block-area">
        <div class="row">
            <div class="col-sm-12">
                <div class="tile">
                    <h2 class="tile-title">Edit User</h2>

                    <div class="tile-config dropdown">
                        <a class="tile-menu" href="#" data-toggle="dropdown"></a>
                        <ul class="dropdown-menu animated pull-right text-right">
                            <li><a href="#">Refresh</a></li>
                            <li><a href="#">Settings</a></li>
                        </ul>
                    </div>
                    <div class="p-15">
                        <div class="error-msgs">
                            <ul></ul>
                        </div>
                        {!! Form::model($user, array('route' => array('admin.user.update', $user->id), 'method' => 'patch', 'files' => true, 'onsubmit' => 'return false;', "id" => "frm-update-user")) !!}
                        @include('admin.user.forms.user')
                        <div class="form-group">
                            <label for="roles">Roles</label>
                            <select name="roles[]" id="roles" class="form-control input-sm" multiple="multiple">
                                @foreach($roles as $role)
                                    <option value="{{$role->id}}" {{$user->hasRole($role->name) ? "selected" : ""}}>{{$role->display_name}}</option>
                                @endforeach
                            </select>
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
    <script>
        function updateUserOnClick() {
            $.ajax({
                "url": $("#frm-update-user").attr("action"),
                "method": "put",
                "data": $("#frm-update-user").serialize(),
                "dataType": "json",
                "success": function (response) {
                    if (response.status == true) {
                        window.location.href = "{{url('admin/user')}}";
                    } else {
                        if (response.responseJSON) {
                            try {
                                var $error = response.responseJSON;
                                $.each($error, function (index, error) {
                                    $loginBox.find(".error-msgs ul").append(
                                            $("<li>").text(error)
                                    );
                                });
                                showLoginErrMsg();
                            } catch (e) {
                                $loginBox.find(".error-msgs ul").append(
                                        $("<li>").text("Unable to proceed authentication, please contact Ivan for more detail.")
                                );
                                showLoginErrMsg();
                            }
                        }
                    }
                },
                "error": function (xhr, status, error) {
                    if (xhr.responseJSON) {
                        try {
                            var $error = xhr.responseJSON;
                            $.each($error, function (index, error) {
                                $(".error-msgs ul").append(
                                        $("<li>").text(error)
                                );
                            });
                            showEditUserErrMsg();
                        } catch (e) {
                            $(".error-msgs ul").append(
                                    $("<li>").text("Unable to save user, please contact Ivan for more detail.")
                            );
                            showEditUserErrMsg();
                        }
                    }
                }
            })
        }

        function showEditUserErrMsg(callback) {
            $(".error-msgs").slideDown(function () {
                if ($.isFunction(callback)) {
                    callback();
                }
            });
        }
    </script>
@stop
