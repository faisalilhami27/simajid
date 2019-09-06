@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="layout-content">
        <div class="layout-content-body">
            <div class="row gutter-xs">
                <div class="col-xs-6 col-md-3">
                    <div class="card bg-primary no-border">
                        <div class="card-values">
                            <div class="p-x">
                                <small>Jumlah Pengurus</small>
                                <h3 class="card-title fw-l">{{ $getJumlahPengurus }}</h3>
                            </div>
                        </div>
                        <div class="card-chart">
                            <canvas data-chart="line" data-animation="false"
                                    data-labels='["Jun 21", "Jun 20", "Jun 19", "Jun 18", "Jun 17", "Jun 16", "Jun 15"]'
                                    data-values='[{"backgroundColor": "transparent", "borderColor": "#ffffff", "data": [25250, 23370, 25568, 28961, 26762, 30072, 25135]}]'
                                    data-scales='{"yAxes": [{ "ticks": {"max": 31072}}]}'
                                    data-hide='["legend", "points", "scalesX", "scalesY", "tooltips"]'
                                    height="35"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="card bg-danger no-border">
                        <div class="card-values">
                            <div class="p-x">
                                <small>Total Pemasukan Per Bulan</small>
                                <h3 class="card-title fw-l">Rp. {{ number_format($pemasukan, '0', '.', '.') }}</h3>
                            </div>
                        </div>
                        <div class="card-chart">
                            <canvas data-chart="line" data-animation="false"
                                    data-labels='["Jun 21", "Jun 20", "Jun 19", "Jun 18", "Jun 17", "Jun 16", "Jun 15"]'
                                    data-values='[{"backgroundColor": "transparent", "borderColor": "#ffffff", "data": [8796, 11317, 8678, 9452, 8453, 11853, 9945]}]'
                                    data-scales='{"yAxes": [{ "ticks": {"max": 12742}}]}'
                                    data-hide='["legend", "points", "scalesX", "scalesY", "tooltips"]'
                                    height="35"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="card bg-info no-border">
                        <div class="card-values">
                            <div class="p-x">
                                <small>Total Pengeluaran Per Bulan</small>
                                <h3 class="card-title fw-l">Rp. {{ number_format($pengeluaran, '0', '.', '.') }}</h3>
                            </div>
                        </div>
                        <div class="card-chart">
                            <canvas data-chart="line" data-animation="false"
                                    data-labels='["Jun 21", "Jun 20", "Jun 19", "Jun 18", "Jun 17", "Jun 16", "Jun 15"]'
                                    data-values='[{"backgroundColor": "transparent", "borderColor": "#ffffff", "data": [116196, 145160, 124419, 147004, 134740, 120846, 137225]}]'
                                    data-scales='{"yAxes": [{ "ticks": {"max": 158029}}]}'
                                    data-hide='["legend", "points", "scalesX", "scalesY", "tooltips"]'
                                    height="35"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="card bg-warning no-border">
                        <div class="card-values">
                            <div class="p-x">
                                <small>Saldo Bulan ini</small>
                                <h3 class="card-title fw-l">Rp. {{ number_format($saldo, '0', '.', '.') }}</h3>
                            </div>
                        </div>
                        <div class="card-chart">
                            <canvas data-chart="line" data-animation="false"
                                    data-labels='["Jun 21", "Jun 20", "Jun 19", "Jun 18", "Jun 17", "Jun 16", "Jun 15"]'
                                    data-values='[{"backgroundColor": "transparent", "borderColor": "#ffffff", "data": [13590442, 12362934, 13639564, 13055677, 12915203, 11009940, 11542408]}]'
                                    data-scales='{"yAxes": [{ "ticks": {"max": 14662531}}]}'
                                    data-hide='["legend", "points", "scalesX", "scalesY", "tooltips"]'
                                    height="35"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gutter-xs">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Pemasukan Per Bulan</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-chart">
                                <canvas id="myChart" height="150"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Pengeluaran Per Bulan</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="myChart1" height="150"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
