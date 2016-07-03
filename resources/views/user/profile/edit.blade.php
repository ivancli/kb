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
    <link rel="stylesheet" href="{{asset('assets/external/package/Cropper/cropper.min.css')}}">
@stop
@section('content')
    <h4 class="page-title">Edit Profile</h4>
    <div class="block-area">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="tile">
                    <h2 class="tile-title">Profile Picture</h2>

                    <div class="p-15 text-center">
                        <label for="new-profile-pic">
                            <img src="{{url('media/profile/' . rawurlencode(Auth::user()->name) . '/' . Auth::user()->id)}}" alt="Current Profile Image" class="current-profile-pic">
                            <input id="new-profile-pic" type="file" accept="image/*" onchange="previewSelectedImage(this);">
                        </label>
                    </div>
                </div>
            </div>

            <div class="col-md-8 col-sm-6">
                <div class="tile">
                    <h2 class="tile-title">Personal Details</h2>

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


    {{--Cropper Popup Template--}}
    <div id="upload-profile-pic-content-template" class="modal-template">
        <div>
            <img class="preview-profile-pic" src="" alt="Picture">
        </div>
    </div>
    <div id="upload-profile-pic-footer-template" class="modal-template">
        <div class="text-right">
            <button class="btn btn-defualt btn-sm" data-dismiss="modal">Cancel</button>
            <button class="btn btn-default btn-sm">Upload</button>
        </div>
    </div>
    {{--/Cropper Popup Template--}}
@stop
@section('script')
    <script type="text/javascript" src="{{asset('assets/external/package/Cropper/cropper.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {

        });

        function previewSelectedImage(el) {
            readURLFromInput(el, function (data) {
                var canvasData, cropBoxData;
                showCropperPopup(function () {
                    var $image = $(".modal .preview-profile-pic");
                    $image.one("load", function () {
                        $image.cropper({
                            aspectRatio: 1,
                            autoCropArea: 0.5,
                            zoomOnWheel: false,
                            built: function () {
                                $image.cropper('setCanvasData', canvasData);
                                $image.cropper('setCropBoxData', cropBoxData);
                            }
                        });
                    }).attr("src", data);
                }, function () {
                    var $image = $(".modal .preview-profile-pic");
                    cropBoxData = $image.cropper('getCropBoxData');
                    canvasData = $image.cropper('getCanvasData');
                    $image.cropper('destroy');
                });
            });
        }

        function showCropperPopup(onShown, onHidden) {
            var $modal = popupHTML("Upload Profile Picture", $("#upload-profile-pic-content-template").html(), $("#upload-profile-pic-footer-template").html(), "modal-md");
            $modal.on("shown.bs.modal", function () {
                if ($.isFunction(onShown)) {
                    onShown();
                }
            }).on("hidden.bs.modal", function () {
                if ($.isFunction(onHidden)) {
                    onHidden();
                }
                $(this).remove();
            });
            $modal.modal({
                backdrop: "static"
            });
        }
    </script>
@stop
