
@extends('layouts.app')
@section('content')


    

    <section class="content">
        <div class="container-fluid">
            <div class="row">
               
                <div class="col-12 col-sm-6 col-md-9 card-name-4">
                    <div class="content-header p-3">
                        <div class="box box-info">
                            <div class="box-header text-center">
                                <div class=" header"> <h4>{{ __("Bulathkohupitiya Public Library")}}&nbsp;<i class="fa fa-inbox">&nbsp;{{ __("Library Management System")}}</i></h4></div>
                                {{-- <div class=" header"> <h5><i class="fa fa-inbox">&nbsp;{{ __("Library Management System")}}</i></h5></div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3>150</h3>
                                    <p>Total Books</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                               
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>53<sup style="font-size: 20px">%</sup></h3>
        
                                    <p>Total members</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                               
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>44</h3>
        
                                    <p>Books Leading</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                               
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3>65</h3>
        
                                    <p>Unique Visitors</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col">
                            <!-- small box -->
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>150</h3>
        
                                    <p>Total Books</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>
                
                            <div class="info-box-content">
                                <span class="info-box-text">CPU Traffic</span>
                                <span class="info-box-number">
                                10
                                <small>%</small>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-thumbs-up"></i></span>
                
                            <div class="info-box-content">
                                <span class="info-box-text">Likes</span>
                                <span class="info-box-number">41,410</span>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                
                        <!-- fix for small devices only -->
                        {{-- <div class="clearfix hidden-md-up"></div> --}}
                
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-shopping-cart"></i></span>
                
                            <div class="info-box-content">
                                <span class="info-box-text">Sales</span>
                                <span class="info-box-number">760</span>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                            <div class="info-box mb-3">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>
                
                            <div class="info-box-content">
                                <span class="info-box-text">New Members</span>
                                <span class="info-box-number">2,000</span>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col-12 col-sm-12 col-md-12">
                            {{-- <div id="chart" class=""></div> --}}
                           
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 mt-2">
                           
                            {{-- <div id="chart1" class=""></div> --}}
                        </div>
                      </div>
        
                </div>
                <div class="col-12 col-sm-6 col-md-3 p-1">
                    
                    <img src="{{ asset('img/dashline1.png') }}" width="100%">
                    {{-- <div id="calendar" class="m-2"></div> --}}
                     <!-- Responsive calendar - START -->
                    <div class="responsive-calendar border border-white p-2">
                        <div class="controls bg-orange">
                            <a class="pull-center" data-go="prev"><span><i class="fa fa-caret-left fa-lg" aria-hidden="true"></i></span></a>
                            <h4><span data-head-year></span> <span data-head-month></span></h4>
                            <a class="pull-center" data-go="next"><span><i class="fa fa-caret-right fa-lg" aria-hidden="true"></i></span></a>
                            <hr/>
                        </div>
                        <div class="day-headers bg-white">
                        <div class="day header">Mon</div>
                        <div class="day header">Tue</div>
                        <div class="day header">Wed</div>
                        <div class="day header">Thu</div>
                        <div class="day header">Fri</div>
                        <div class="day header">Sat</div>
                        <div class="day header">Sun</div>
                        </div>
                        <div class="days" data-group="days">
                        
                        </div>
                    </div>
                    <!-- Responsive calendar - END -->

                </div>
            </div>
       
            

             

        </div>
    </section> 

            
            
            
        

@endsection

@section('script')
<script>
	$(document).ready(function(e){
        var month=moment().format("YYYY-MM");
        var todayy=moment().format("YYYY-MM-DD");
        console.log(todayy);
        $(".responsive-calendar").responsiveCalendar({
          time:month,
          events: {"'+todayy+'":{}}
        });
	});
</script>

<script>
 var options = {
            chart: {
                height: 280,
                type: 'bar'
            },
            plotOptions: {
                bar: {
                    barHeight: '100%',
                    distributed: true,
                    horizontal: false,
                    dataLabels: {
                        position: 'top',

                    },
                }
            },
            colors: ['#33b2df', '#546E7A', '#d4526e', '#13d8aa', '#A5978B', '#2b908f', '#f9a3a4', '#90ee7e', '#f48024', '#69d2e7'],
            dataLabels: {
                enabled: true,
                textAnchor: 'start',
                horizontal: true,
                style: {
                    colors: ['black']
                },
                formatter: function(val, opt) {
                    return  val
                },
                offsetX: -20,
                offsetY: -20,

                dropShadow: {
                  enabled: true
                }
            },
            series: [{

                 data: [28500, 11600, 32400, 5500, 7900, 5500, 2500, 0, 38000, 15780,0, 0]
            }],
            stroke: {
                width: 1,
              colors: ['#fff']
            },
            xaxis: {
                type: 'category',
                categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                style: {
                  colors: ['#fff'],
                  fontSize: '15px',
                  fontFamily: 'Helvetica, Arial, sans-serif',
                  
                    },
                },
            yaxis: {
                labels: {
                    show: false
                }
            },
            title: {
                text: 'Book return - 2021',
                align: 'center',
                floating: true
            },
            subtitle: {
                text: '',
                align: 'top',
            },
            tooltip: {
                theme: 'dark',
                x: {
                    show: false
                },
                y: {
                    title: {
                        formatter: function() {
                            return ''
                        }
                    }
                }
            }
        }

       var chart = new ApexCharts(
            document.querySelector("#chart"),
            options
        );
        
        chart.render();
// ------------------------------------------------------
var options1 = {
            chart: {
                height: 280,
                type: 'area',
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '100%',
                    endingShape: 'rounded'	
                },
            },
            dataLabels: {
                enabled: true,
                style: {
                colors: ['#f1f1f1']
                }

            },
            stroke: {
                show: true,
                width: 1,
                colors: ['#010101']
            },
            series: [ {
                name: 'Hours',
                data: [150, 165, 30, 210, 56, 94, 120, 40, 260, 20,0, 0]
            }],
            xaxis: {
                type: 'category',
                categories: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                style: {
                  colors: ['#fff'],
                  fontSize: '15px',
                  fontFamily: 'Helvetica, Arial, sans-serif',
                  
                    },
                },
            yaxis: {
                title: {
                    text: 'Hours'
                }
            },
            title: {
                text: 'Book Lending -2021',
                align: 'center',
                floating: true
            },
            fill: {
                opacity: 1

            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return "$ " + val + " thousands"
                    }
                }
            }
        }

        var chart1 = new ApexCharts(
            document.querySelector("#chart1"),
            options1
        );

        chart1.render();
</script>
@endsection
