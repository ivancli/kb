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
    <link rel="stylesheet" href="{{elixir('css/Cropper.css')}}">
@stop
@section('content')
    <h4 class="page-title">Edit Profile</h4>
    <div class="block-area">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                <div class="tile">
                    <h2 class="tile-title">Profile Picture</h2>

                    <div class="p-15 text-center">
                        <label for="new-profile-pic" class="lbl-new-profile-pic" onmouseover=""
                               ondrop="objectDropOnProfilePicture(this, event); return false;"
                               ondragstart="event.preventDefault(); return false;"
                               ondragover="event.preventDefault(); return false;">
                            <img src="{{url('media/profile/' . rawurlencode(Auth::user()->name) . '/' . Auth::user()->id)}}"
                                 alt="Current Profile Image" class="current-profile-pic">
                            <input id="new-profile-pic" type="file" accept="image/*"
                                   onchange="previewSelectedImage(this);">
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
                        {!! Form::model($user->info, array('route' => array('user.profile.update'), 'method' => 'put', 'onsubmit' => 'return false;', "id" => "frm-update-user-profile")) !!}

                        <div class="form-group">
                            {!! Form::label('title', 'Title') !!} &nbsp;
                            {!! Form::select('title', array("mr"=>"mr","mrs"=>"mrs","ms"=>"ms","mx"=>"mx","miss"=>"miss","madam"=>"madam","dr"=>"dr","prof"=>"prof"), old('title'), ['class' => 'control-inline form-control input-sm']) !!}

                        </div>
                        <div class="form-group">
                            {!! Form::label('dob', 'Date of birth') !!}
                            <div class="input-icon datetime-pick date-only">
                                {!! Form::text('dob', old('dob'), ['class' => 'form-control input-sm', 'placeholder' => 'dob', 'data-format' => "yyyy-MM-dd"]) !!}
                                <span class="add-on">
                                    <i class="sa-plus icon-calendar"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('gender', 'Gender') !!} &nbsp;
                            {!! Form::select('gender', array("male"=>"male","female"=>"female","other"=>"other"), old('gender'), ['class' => 'control-inline form-control input-sm']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('phone', 'Phone') !!} &nbsp;
                            {!! Form::text('phone', old('phone'), ['class' => 'form-control input-sm', 'placeholder' => 'phone']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('country', 'Country') !!} &nbsp;
                            {!! Form::select('country', $countries, old('country'), ['class' => 'form-control input-sm', 'id' => 'sel-country']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('state', 'State') !!} &nbsp;
                            {!! Form::text('state', old('state'), ['class' => 'form-control input-sm', 'placeholder' => 'state']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('suburb', 'Suburb') !!} &nbsp;
                            {!! Form::text('suburb', old('suburb'), ['class' => 'form-control input-sm', 'placeholder' => 'suburb']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Description') !!}
                            {!! Form::textarea('description', old('description'), ['class' => 'form-control input-sm', 'placeholder' => 'description']) !!}
                        </div>
                        {!! Form::submit('Save', ["class"=>"btn btn-default btn-sm", "href"=>"#", "onclick" => "updateUserProfileOnClick()"]) !!}
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
            <button class="btn btn-default btn-sm" onclick="uploadProfilePictureOnClick(); return false;">Upload
            </button>
        </div>
    </div>
    {{--/Cropper Popup Template--}}
@stop
@section('script')
    <script src="{{elixir('js/Cropper.js')}}" type="text/javascript"></script>
    <script src="{{elixir('js/profile.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        var cropper = null;
        $(function () {
            pageInit();
        });

        function pageInit() {
            var $dateOnly = $(".date-only");
            if ($dateOnly.length > 0) {
                $dateOnly.datetimepicker({
                    pickTime: false
                });
                $('.datetime-pick input:text').on('click', function () {
                    $(this).closest('.datetime-pick').find('.add-on i').click();
                });
            }
            getRESTCountries({
                "url": "{{asset("assets/internal/json/countries.json")}}"
            }, function (countries) {
                console.info('countries', countries);
                var $selCountry = $("#sel-country");
                $.each(countries, function (index, country) {
                    $selCountry.append(
                            $("<option>").attr({
                                "value": country.name
                            }).text(country.name)
                    );
                });
                $selCountry.select();
//                $("#sel-country").autocomplete({
//                    source: function (request, response) {
//                        var matcher = new RegExp("^" + $.ui.autocomplete.escapeRegex(request.term), "i");
//                        response($.grep(countries, function (item) {
//                            return matcher.test(item.name)
//                        }))
//                    },
//                }).data("ui-autocomplete")._renderItem = function (ul, item) {
//                    return $(ul).addClass("dropdown-menu inner").append(
//                            $("<li>").attr("data-value", item.name).append(
//                                    $("<a>").attr("href", "#").text(item.name)
//                            )
//                    );
//                };
            });
        }

        function previewSelectedImage(el) {
            if (getFileSizeFromInput(el) <= 0 || getFileSizeFromInput(el) > 950 * 1024) {
                alertP("File is too large", "Please select an image which is smaller than 1MB.");
                return false;
            }
            readURLFromInput(el, function (data) {
                var canvasData, cropBoxData;
                showCropperPopup(function () {
                    var $image = $(".modal .preview-profile-pic");
                    $image.one("load", function () {
                        cropper = $image.cropper({
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
                    $("#new-profile-pic").val("");
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

        function uploadProfilePictureOnClick() {
            var $image = $(".modal .preview-profile-pic");
            var canvas = $image.cropper("getCroppedCanvas");
            var imageData = canvas.toDataURL("image/png");
            /*remove data url header*/
            imageData = imageData.replace(/data\:image(.*?)base64\,/g, "");
            console.info("imageData", imageData);
            submitProfilePicture(imageData, function () {
                alertP("Profile Picture Upload", "You profile picture has been updated.");
                $(".profile-pic,.current-profile-pic").attr("src", "{{url('media/profile/' . rawurlencode(Auth::user()->name) . '/' . Auth::user()->id)}}" + "?" + randomString(10));
                $image.closest(".modal").modal("hide");
            });
        }

        function submitProfilePicture(data, callback) {
            $.ajax({
                "url": "{{url("user/profile")}}",
                "type": "put",
                "data": {
                    "_token": "{!! csrf_token() !!}",
                    "profile_pic": data
                },
                'cache': false,
                'dataType': "json",
                "success": function (response) {
                    console.info("success response", response);
                    if ($.isFunction(callback)) {
                        callback(response);
                    }
                },
                "error": function () {
                    alertP("Profile Picture Upload Failed", "Unable to upload profile picture, please try again later.");
                }
            })
        }

        function objectDropOnProfilePicture(el, e) {
            e.preventDefault();
            e.stopPropagation();
        }

        function updateUserProfileOnClick() {
            var params = $("#frm-update-user-profile").serialize();
            submitUserProfile(params, function (response) {
                if (response.status == true) {
                    alertP("Profile Updated", "You profile information has been updated.");
                }
            });
        }

        function submitUserProfile(data, callback) {
            $.ajax({
                "url": "{{url("user/profile")}}",
                "type": "put",
                "data": data,
                'cache': false,
                'dataType': "json",
                "success": function (response) {
                    if ($.isFunction(callback)) {
                        callback(response);
                    }
                },
                "error": function () {
                    alertP("Profile Update Failed", "Unable to update profile, please try again later.");
                }
            });
        }
    </script>
@stop