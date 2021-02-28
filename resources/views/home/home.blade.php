
@extends('layouts.app')
@section('content')


    

    <section class="content">
        <div class="container-fluid">
            <div class="row">
               
                <div class="col-12 col-sm-6 col-md-9 card-name-4">
                    <div class="content-header p-3">
                        <div class="box box-info">
                            <div class="box-header text-center">
                                <div class=" header js-dash-h"> <h5>{{ __("Bulathkohupitiya Public Library")}}&nbsp;<i class="fa fa-inbox">&nbsp;{{ __("Library Management System")}}</i></h5></div>
                                {{-- <div class=" header"> <h5><i class="fa fa-inbox">&nbsp;{{ __("Library Management System")}}</i></h5></div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col">
                            <!-- small box -->
                            <div class="small-box js-box-bg-1 elevation-5">
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
                            <div class="small-box js-box-bg-2 elevation-5">
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
                            <div class="small-box js-box-bg-3 elevation-5">
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
                            <div class="small-box js-box-bg-4 elevation-5">
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
                          
                            <div class="small-box js-box-bg-5 elevation-5">
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
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-12">
                            <div class="box-header text-center">
                                <h6 class="info-box-icon"><i class="fas fa-cog"></i>Quick Links</h6>
                            </div>
                            <hr>
                        </div>
                    </div>
                        
                    <div class="row pl-4 pr-2 js-dash-link">
                        
                        <a href="" class="col-md-2 btn btn-block btn-outline-dark bg-white mt-2 ml-2 mb-2 elevation-2">
                            <span class="info-box-icon pt-2"><i class="fas fa-plus fa-md"></i></span>
                            <span class="info-box-text pt-2">Add Resources</span>
                        </a>

                        <a href="" class="col-md-2 btn btn-block btn-outline-dark bg-white ml-2 mb-2 elevation-2">
                            <span class="info-box-icon  "><i class="fas fa-plus fa-md "></i></span>
                            <span class="info-box-text">Add Members</span>
                        </a>

                        <a href="" class="col-md-2 btn btn-block btn-outline-dark bg-white ml-2 mb-2 elevation-2">
                            <span class="info-box-icon  "><i class="fas fa-book fa-md"></i></span>
                            <span class="info-box-text">Catalog</span>
                        </a>

                        <a href="" class="col-md-2 btn btn-block btn-outline-dark bg-white ml-2 mb-2 elevation-2">
                            <span class="info-box-icon  "><i class="fas fa-cube fa-md"></i></span>
                            <span class="info-box-text">Supports</span>
                        </a>

                        <a href="" class="col-md-2 btn btn-block btn-outline-dark bg-white ml-2 mb-2 elevation-2">
                            <span class="info-box-icon  "><i class="fas fa-cart-plus fa-md"></i></span>
                            <span class="info-box-text">Issue</span>
                        </a>

                        <a href="" class="col-md-2 btn btn-block btn-outline-dark bg-white ml-2 mb-2 elevation-2">
                            <span class="info-box-icon  "><i class="fa fa-level-down fa-md"></i></span>
                            <span class="info-box-text">Return</span>
                        </a>

                        <a href="" class="col-md-2 btn btn-block btn-outline-dark bg-white ml-2 mb-2 elevation-2">
                            <span class="info-box-icon  "><i class="fas fa-file-text fa-md"></i></span>
                            <span class="info-box-text">Receipt</span>
                        </a>

                        <a href="" class="col-md-2 btn btn-block btn-outline-dark bg-white ml-2 mb-2 elevation-2">
                            <span class="info-box-icon  "><i class="fas fa-file fa-md"></i></span>
                            <span class="info-box-text">Reports</span>
                        </a>

                        <a href="" class="col-md-2 btn btn-block btn-outline-dark bg-white ml-2 mb-2 elevation-2">
                            <span class="info-box-icon  "><i class="fa fa-user-o fa-md"></i></span>
                            <span class="info-box-text">Staff</span>
                        </a>


                        <a href="" class="col-md-2 btn btn-block btn-outline-dark bg-white ml-2 mb-2 elevation-2">
                            <span class="info-box-icon  "><i class="fas fa-users fa-md pt-2"></i></span>
                            <span class="info-box-text">Members</span>
                        </a>

                        <a href="" class="col-md-2 btn btn-block btn-outline-dark bg-white ml-2 mb-2 elevation-2">
                            <span class="info-box-icon  "><i class="fas fa-user-circle fa-md"></i></span>
                            <span class="info-box-text">Member Account</span>
                        </a>

                        <a href="" class="col-md-2 btn btn-block btn-outline-dark bg-white ml-2 mb-2 elevation-2">
                            <span class="info-box-icon"><i class="fas fa-cog fa-md  pt-2"></i></span>
                            <span class="info-box-text">Setting</span>
                        </a>

                        <a href="" class="col-md-2 btn btn-block btn-outline-dark bg-white ml-2 mb-2 elevation-2">
                            <span class="info-box-icon  "><i class="fas fa-barcode fa-md pt-2"></i></span>
                            <span class="info-box-text">Code Genarate</span>
                        </a>

                        <a href="" class="col-md-2 btn btn-block btn-outline-dark bg-white ml-2 mb-2 elevation-2">
                            <span class="info-box-icon  "><i class="fas fa-list fa-md pt-2"></i></span>
                            <span class="info-box-text">Survey</span>
                        </a>

                        <a href="" class="col-md-2 btn btn-block btn-outline-dark bg-white ml-2 mb-2 elevation-2">
                            <span class="info-box-icon  "><i class="fas fa-cube fa-md"></i></span>
                            <span class="info-box-text">Member Support</span>
                        </a>

                        <a href="" class="col-md-2 btn btn-block btn-outline-dark bg-white ml-2 mb-2 elevation-2">
                            <span class="info-box-icon  "><i class="fas fa-bars fa-md"></i></span>
                            <span class="info-box-text">Resource Support</span>
                        </a>
                       
                    </div>
                    <div class="row pt-4 pb-2">
                        <div class="col-12 col-sm-6 col-md-12">
                            <hr>
                            <div class="box-header text-center bg-light">
                                <h6 class="info-box-icon"><i class="fas fa-cog"></i>Transaction Summary</h6>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div class="row pl-3 pr-3">
                        <div class="col-12 col-sm-12 col-md-6 pb-2">
                            <div id="chart" class="elevation-3"></div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 pb-2">
                            <div id="chart1" class="elevation-3"></div>
                        </div>
                    </div>
            </div>
        
            <div class="col-12 col-sm-6 col-md-3 p-2 js-dashboard-side">
                    <div class="code-js p-2 text-center">
                        <h4 class="text-center js-dashboard-side-text font-weight-bold">Code-JS LMS</h4>
                        <p class="text-left js-dashboard-side-text">
                            Code-JS LMS is an interactive solution that allows 
                            librarians and staff to keep real-time track of inventory and media assets<br>
                             and allows Members digital means of discovery and reading.
                        </p>
                        {{-- <img src="{{ asset('img/dashline2.png') }}" class="" width="100%"> --}}
                    </div>
                    <div class="responsive-calendar p-1 pl-4 pr-4">
                        <div class="controls bg-dark text-center form-inline">
                            <a class="text-center" data-go="prev"><span>&nbsp;<i class="fa fa-caret-left fa-lg" aria-hidden="true"></i>&emsp;</span></a>
                            <h5 class="text-center"><span data-head-year></span> <span data-head-month></span>&emsp;</h5>
                            <a class="text-center" data-go="next"><span>&nbsp;<i class="fa fa-caret-right fa-lg" aria-hidden="true"></i></span></a>
                        </div>
                        <div class="day-headers bg-info mt-0">
                        <div class="day header">Mon</div>
                        <div class="day header">Tue</div>
                        <div class="day header">Wed</div>
                        <div class="day header">Thu</div>
                        <div class="day header">Fri</div>
                        <div class="day header">Sat</div>
                        <div class="day header">Sun</div>
                        </div>
                        <div class="days bg-light text-dark" data-group="days">
                        
                        </div>
                    </div>
                    <!-- Responsive calendar - END -->
                    <br><br><br>
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
            colors: ['#33b2df', '#33b2df', '#33b2df', '#33b2df', '#33b2df', '#33b2df', '#33b2df', '#33b2df', '#33b2df', '#33b2df'],
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

                 data: [2500, 11600, 3400, 5500, 7900, 5500, 2500, 1025, 10254, 6524,5245, 3254]
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
