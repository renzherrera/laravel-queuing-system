@extends('layouts.app')

@section('content')
<div class="c-body">
    <main class="c-main">
        <div class="container-fluid">
            <div class="fade-in">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-info">
                            <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-value-lg">9.823</div>
                                    <div>Total Served</div>
                                </div>
                            <div class="btn-group">
                                <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <svg class="c-icon">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                                    </svg>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                            </div>
                            </div>

                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas class="chart chartjs-render-monitor" id="card-chart1" height="70" style="display: block; width: 202px; height: 70px;" width="202"></canvas>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-primary">
                            <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-value-lg">23</div>
                                    <div>Today Queued</div>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg class="c-icon">
                                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas class="chart chartjs-render-monitor" id="card-chart2" height="70" width="202" style="display: block; width: 202px; height: 70px;"></canvas>
                            </div>
                        </div>
                    </div>
    
                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-warning">
                            <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-value-lg">12</div>
                                    <div>Today Served</div>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg class="c-icon">
                                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3" style="height:70px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas class="chart chartjs-render-monitor" id="card-chart3" height="70" width="234" style="display: block; width: 234px; height: 70px;"></canvas>
                            </div>
                        </div>
                    </div>
    

                    <div class="col-sm-6 col-lg-3">
                        <div class="card text-white bg-danger">
                            <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-value-lg">3</div>
                                    <div>Today Missed</div>
                                </div>
                                <div class="btn-group">
                                    <button class="btn btn-transparent dropdown-toggle p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <svg class="c-icon">
                                             <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-settings"></use>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a></div>
                                </div>
                            </div>
                            <div class="c-chart-wrapper mt-3 mx-3" style="height:70px;"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                                <canvas class="chart chartjs-render-monitor" id="card-chart4" height="70" width="202" style="display: block; width: 202px; height: 70px;"></canvas>
                            </div>
                        </div>
                    </div>
    
    </div>
    </div>
    </div>
    </div>
    </main>
    <footer class="c-footer">
    <div><a href="https://coreui.io">CoreUI</a> © 2020 creativeLabs.</div>
    <div class="ml-auto">Powered by&nbsp;<a href="https://coreui.io/">CoreUI</a></div>
    </footer>
    </div>
@endsection
