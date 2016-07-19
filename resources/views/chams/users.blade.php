<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 5/06/2016
 * Time: 10:35 PM
 */
?>
@extends('layouts.neat')
@section('title')
    ICL KB - CHAMS
@stop
@section('link')
    <link rel="stylesheet" href="{{asset('assets/external/package/DataTables-1.10.12/media/css/dataTables.bootstrap.min.css')}}">
@stop
@section('content')
    <ol class="breadcrumb hidden-xs">
        <li><a href="{{url('chams')}}">Home</a></li>
        <li class="active">Users</li>
    </ol>
    <h4 class="page-title">CHAMS Users</h4>

    <div class="block-area">
        <div class="tab-container tile">
            <ul class="nav tab nav-tabs">
                <li class="active"><a href="#user-list">User List</a></li>
                <li class=""><a href="#add-user">Add User</a></li>
            </ul>

            <div class="tab-content tab-content-with-table">
                <div class="tab-pane active" id="user-list">
                    <div class="p-l-15 p-r-15">
                        <h3 class="block-title">Number of users - {{count($users)}}</h3>
                    </div>
                    <table class="table table-bordered table-striped" id="tbl-user">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Role</th>
                            <th>Job title</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                                <td>{{$user->info ? $user->info->phone : ""}}</td>
                                <td>
                                    @foreach($user->roles as $role)
                                        <div>{{$role->display_name}}</div>
                                    @endforeach
                                </td>
                                <td></td>
                                <td></td>
                                <td>{{$user->status}}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-alt"><i class="fa fa-search"></i></a>
                                    <a href="#" class="btn btn-sm btn-alt"><i class="fa fa-pencil"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="add-user">

                </div>
            </div>
        </div>
    </div>
@stop

@section('script')
    <script type="text/javascript" src="{{asset('assets/external/package/DataTables-1.10.12/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/external/package/DataTables-1.10.12/media/js/dataTables.bootstrap.min.js')}}"></script>
    <script type="text/javascript">
        var userTable = null;
        $(function () {
            userTable = $("#tbl-user").DataTable({
                "dom": '<>',
                "paging": false,
                "scrollX": false,
                "columns": [
                    {
                        "name": "Name"
                    },
                    {
                        "name": "Email"
                    },
                    {
                        "name": "Mobile"
                    },
                    {
                        "name": "Roles",
                        "type": "string",
                        "class": "text-center"
                    },
                    {
                        "name": "Job title"
                    },
                    {
                        "name": "Department"
                    },
                    {
                        "name": "Status",
                        "class": "text-center"
                    },
                    {
                        "name": "Actions",
                        "class": "text-center",
                        "orderable": false,
                        "width": 150
                    }
                ],
                "language": {
                    "zeroRecords": "No users in this list",
                    "emptyTable": "No users in this list"
                }
            });
        });
    </script>
@stop