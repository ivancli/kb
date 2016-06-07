<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 6/06/2016
 * Time: 9:53 PM
 */
?>
@extends('layouts.neat')
@section('title')
    ICL KB - User
@stop
@section('link')
@stop
@section('content')

    <div class="block-area">
        <h3 class="block-title">User List</h3>

        <div class="table-responsive overflow" style="overflow: hidden;" tabindex="5005">
            <table id="tbl-user" class="tile table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Registered at</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

@stop
@section('script')
    <script>
        $(function () {
            loadUsers(function (users) {
                $.each(users, function (index, user) {
                    $("#tbl-user").find("tbody").append(
                            $("<tr>").append(
                                    $("<td>").text(user.id),
                                    $("<td>").text(user.name),
                                    $("<td>").text(user.email),
                                    $("<td>").text(user.status),
                                    $("<td>").text(user.created_at),
                                    $("<td>").addClass("text-center").append(
                                            $("<a>").attr({
                                                "href": "{{url('user/')}}/" + user.id
                                            }).addClass("btn btn-sm btn-alt").append(
                                                    $("<i>").addClass("fa fa-pencil")
                                            ),
                                            $("<button>").attr({
                                                "onclick": "deleteUserOnClick(this); return false;",
                                                "data-user": JSON.stringify(user)
                                            }).addClass("btn btn-sm btn-alt").append(
                                                    $("<i>").addClass("fa fa-times")
                                            )
                                    )
                            )
                    )
                });
            })
        });

        function loadUsers(callback) {
            $.ajax({
                'url': "{{url('user')}}",
                'method': "get",
                'dataType': "json",
                'cache': false,
                'success': function (response) {
                    if ($.isFunction(callback)) {
                        callback(response);
                    }
                },
                'error': function (xhr, status, error) {
                    console.info('xhr', xhr);
                    console.info('status', status);
                    console.info('error', error);
                }
            })
        }

        function deleteUserOnClick(el) {
            if (typeof $(el).attr("data-user") != 'undefined') {
                var user = JSON.parse($(el).attr("data-user"));

                confirmP("Delete User", "Are you sure you want to delete user: " + user.name + "?", {
                    affirmativeCallback: function () {
                        deleteUser(user.id, function () {
                            alertP("Delete User", user.name + " is now deleted.");
                            $(el).closest("tr").remove();
                        }, function (xhr) {
                            alertP("Delete User", "Unable to delete user: " + user.name + ". Error message: " + xhr.responseText + ". Please try again later.");
                        });
                    },
                    affirmativeDismiss: true,
                    negativeDismiss: true,
                    affirmativeText: "Yes, delete",
                    negativeText: "Cancel"
                })
            } else {
                alertP("Delete User", "Unable to delete user due to incorrect user information.");
            }
        }

        function deleteUser(id, successCallback, errorCallback) {
            $.ajax({
                'url': "{{url('user')}}/" + id,
                'data': {
                    "_token": "{{ csrf_token() }}"
                },
                'type': "delete",
                'cache': false,
                'success': function (response) {
                    if ($.isFunction(successCallback)) {
                        successCallback(response);
                    }
                },
                'error': function (xhr, status, error) {
                    if ($.isFunction(successCallback)) {
                        successCallback(xhr);
                    }
                }
            })
        }
    </script>
@stop