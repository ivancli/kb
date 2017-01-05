<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 28/05/2016
 * Time: 11:05 PM
 */
?>
@extends('layouts.neat')
@section('content')

        <!-- Breadcrumb -->
<ol class="breadcrumb hidden-xs">
    <li><a href="#">Home</a></li>
    <li><a href="#">Library</a></li>
    <li class="active">Data</li>
</ol>

<h4 class="page-title">DASHBOARD</h4>

<!-- Shortcuts -->
<div class="block-area shortcut-area">
    <a class="shortcut tile" href="#">
        <img src="{{asset('build/img/shortcuts/money.png')}}" alt="">
        <small class="t-overflow">Purchases</small>
    </a>
</div>

<hr class="whiter" />

<!-- Quick Stats -->
<div class="block-area">
    <div class="row">
        <div class="col-md-3 col-xs-6">
            <div class="tile quick-stats">
                <div id="stats-line-2" class="pull-left"></div>
                <div class="data">
                    <h2 data-value="98">0</h2>
                    <small>Tickets Today</small>
                </div>
            </div>
        </div>
    </div>

</div>

<hr class="whiter" />

<!-- Main Widgets -->

<div class="block-area">
    <div class="row">
        <div class="col-md-8">
            <!-- Main Chart -->
            <div class="tile">
                <h2 class="tile-title">Statistics</h2>
                <div class="tile-config dropdown">
                    <a data-toggle="dropdown" href="#" class="tile-menu"></a>
                    <ul class="dropdown-menu pull-right text-right">
                        <li><a class="tile-info-toggle" href="#">Chart Information</a></li>
                        <li><a href="#">Refresh</a></li>
                        <li><a href="#">Settings</a></li>
                    </ul>
                </div>
                <div class="p-10">
                    <div id="line-chart" class="main-chart" style="height: 250px"></div>

                    <div class="chart-info">
                        <ul class="list-unstyled">
                            <li class="m-b-10">
                                Total Sales 1200
                                <span class="pull-right text-muted t-s-0">
                                    <i class="fa fa-chevron-up"></i>
                                    +12%
                                </span>
                            </li>
                            <li>
                                <small>
                                    Local 640
                                    <span class="pull-right text-muted t-s-0"><i class="fa m-l-15 fa-chevron-down"></i> -8%</span>
                                </small>
                                <div class="progress progress-small">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"></div>
                                </div>
                            </li>
                            <li>
                                <small>
                                    Foreign 560
                                    <span class="pull-right text-muted t-s-0">
                                        <i class="fa m-l-15 fa-chevron-up"></i>
                                        -3%
                                    </span>
                                </small>
                                <div class="progress progress-small">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 60%"></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="col-md-4">
            <!-- USA Map -->
            <div class="tile">
                <h2 class="tile-title">Live Visits</h2>
                <div class="tile-config dropdown">
                    <a data-toggle="dropdown" href="#" class="tile-menu"></a>
                    <ul class="dropdown-menu pull-right text-right">
                        <li><a href="#">Refresh</a></li>
                        <li><a href="#">Settings</a></li>
                    </ul>
                </div>

                <div id="usa-map"></div>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@stop