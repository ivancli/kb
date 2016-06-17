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
    <link rel="stylesheet" href="{{asset('assets/external/package/DataTables-1.10.12/media/css/dataTables.bootstrap.min.css')}}">
@stop
@section('content')

    <div class="block-area">
        <div class="row">
            <div class="col-sm-12">
                <div class="tile">
                    <h2 class="tile-title">User List</h2>

                    <div class="tile-config dropdown">
                        <a class="tile-menu" href="#" data-toggle="dropdown"></a>
                        <ul class="dropdown-menu animated pull-right text-right">
                            <li><a href="#">Refresh</a></li>
                            <li><a href="#">Settings</a></li>
                        </ul>
                    </div>
                    <div class="listview narrow">
                        <div class="media">
                            <div class="media-body">
                                Show &nbsp;
                                <select class="control-inline form-control input-sm m-b-5" id="sel-status" onchange="statusFilterOnChange();">
                                    <option value="">all</option>
                                    <option value="active">active</option>
                                    <option value="inactive">inactive</option>
                                    <option value="locked">locked</option>
                                    <option value="deleted">deleted</option>
                                </select>
                                &nbsp; users
                            </div>
                        </div>
                    </div>
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
        </div>
    </div>

@stop
@section('script')
    <script type="text/javascript" src="{{asset('assets/external/package/DataTables-1.10.12/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/external/package/DataTables-1.10.12/media/js/dataTables.bootstrap.min.js')}}"></script>
    <script>
        var userTable = null;
        $(function () {
            userTable = $("#tbl-user").DataTable({
                "dom": '<>',
                "paging": false,
                "scrollX": false,
                "columns": [
                    {
                        "name": "ID"
                    },
                    {
                        "name": "Full name"
                    },
                    {
                        "name": "Email"
                    },
                    {
                        "name": "Status"
                    },
                    {
                        "name": "Register at"
                    },
                    {
                        "name": "Actions",
                        "orderable": false,
                        "width": 150

                    }
                ]
            });
            drawUserList();
        });

        function loadUserList() {
            $("#tbl-user").find("tbody").empty();
            loadUsers(function (users) {
                $.each(users, function (index, user) {
                    userTable.row.add([
                        $("<div>").append(
                                $("<div>").text(user.id)
                        ).html(),
                        $("<div>").append(
                                $("<div>").text(user.name)
                        ).html(),
                        $("<div>").append(
                                $("<div>").text(user.email)
                        ).html(),
                        $("<div>").append(
                                $("<div>").text(user.status)
                        ).html(),
                        $("<div>").append(
                                $("<div>").text(user.created_at)
                        ).html(),
                        $("<div>").append(
                                $("<div>").addClass("text-center").append(
                                        /* edit */
                                        $("<a>").attr({
                                            "href": "{{url('admin/user/')}}/" + user.id + "/edit"
                                        }).addClass("btn btn-sm btn-alt").append(
                                                $("<i>").addClass("fa fa-pencil")
                                        ),
                                        /* delete */
                                        user.status != "deleted" ?
                                                $("<button>").attr({
                                                    "onclick": "deleteUserOnClick(this); return false;",
                                                    "data-user": JSON.stringify(user)
                                                }).addClass("btn btn-sm btn-alt").append(
                                                        $("<i>").addClass("fa fa-times")
                                                )
                                                :
                                                $("<button>").attr({
                                                    "onclick": "reviveUserOnClick(this); return false;",
                                                    "data-user": JSON.stringify(user)
                                                }).addClass("btn btn-sm btn-alt").append(
                                                        $("<i>").addClass("fa fa-undo")
                                                ),
                                        /* unlock */
                                        user.status == "locked" ?
                                                $("<button>").attr({
                                                    "onclick": "unlockUserOnClick(this); return false;",
                                                    "data-user": JSON.stringify(user)
                                                }).addClass("btn btn-sm btn-alt").append(
                                                        $("<i>").addClass("fa fa-unlock-alt")
                                                )
                                                :
                                                ""
                                )
                        ).html()

                    ]);
                });
                userTable.draw();
            })
        }

        function loadUsers(callback) {
            $.ajax({
                'url': "{{url('admin/user')}}",
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
                            drawUserList();
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

        function reviveUserOnClick(el) {
            if (typeof $(el).attr("data-user") != 'undefined') {
                var user = JSON.parse($(el).attr("data-user"));

                confirmP("Revive User", "Are you sure you want to revive user: " + user.name + "?", {
                    affirmativeCallback: function () {
                        reviveUser(user.id, function () {
                            alertP("Revive User", user.name + " is now revived and inactive.");
                            drawUserList();
                        }, function (xhr) {
                            alertP("Revive User", "Unable to revive user: " + user.name + ". Error message: " + xhr.responseText + ". Please try again later.");
                        });
                    },
                    affirmativeDismiss: true,
                    negativeDismiss: true,
                    affirmativeText: "Yes, revive",
                    negativeText: "Cancel"
                })
            } else {
                alertP("Revive User", "Unable to revive user due to incorrect user information.");
            }
        }

        function unlockUserOnClick(el) {
            if (typeof $(el).attr("data-user") != 'undefined') {
                var user = JSON.parse($(el).attr("data-user"));
                confirmP("Unlock User", "Are you sure you want to unlock user: " + user.name + "?", {
                    affirmativeCallback: function () {
                        reviveUser(user.id, function () {
                            alertP("Unlock User", user.name + " is now unlocked and inactive.");
                            drawUserList();
                        }, function (xhr) {
                            alertP("Unlock User", "Unable to unlock user: " + user.name + ". Error message: " + xhr.responseText + ". Please try again later.");
                        });
                    },
                    affirmativeDismiss: true,
                    negativeDismiss: true,
                    affirmativeText: "Yes, unlock",
                    negativeText: "Cancel"
                })
            } else {
                alertP("Revive User", "Unable to revive user due to incorrect user information.");
            }
        }

        function deleteUser(id, successCallback, errorCallback) {
            $.ajax({
                'url': "{{url('admin/user')}}/" + id,
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
                        errorCallback(xhr);
                    }
                }
            })
        }

        function reviveUser(id, successCallback, errorCallback) {
            $.ajax({
                'url': "{{url('admin/user')}}/" + id + '/revive',
                'data': {
                    "_token": "{{ csrf_token() }}"
                },
                'type': "put",
                'cache': false,
                'success': function (response) {
                    if ($.isFunction(successCallback)) {
                        successCallback(response);
                    }
                },
                'error': function (xhr, status, error) {
                    if ($.isFunction(successCallback)) {
                        errorCallback(xhr);
                    }
                }
            })
        }

        function drawUserList() {
            if (userTable != null) {
                userTable.clear();
                loadUserList();
            }
        }

        function statusFilterOnChange() {
            console.info('$("#sel-status").val()', $("#sel-status").val());
            if (userTable != null) {
                userTable.columns("Status:name").search($("#sel-status").val());
                userTable.draw();
            }
        }
    </script>
@stop