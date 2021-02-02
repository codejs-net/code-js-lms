
@extends('layouts.app')
@section('content')



<div class="container-fluid">
<div class="card-body">

        <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="box box-info">
            <div class="box-header text-center">
                <div class=" header"> <h4><i class="fa fa-inbox">&nbsp;{{ __("Library Management System")}}</i></h4></div>
            </div>
        </div>
         
    </section>

        <!-- Main content -->
        <section class="content p-2">
            <!-- Small boxes (Stat box) -->
            <div class="row">
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
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col">
                    <!-- small box -->
                    <div class="small-box bg-red">
                        <div class="inner">
                            <h3>65</h3>

                            <p>Unique Visitors</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            
          

     </section>
     </div>
     
      <div class="card card-body">

        <div class="row text-center">
            <div class="col-md-6 text-center bg-gradient-white">
                <div id="chart1"></div>
                <!-- <img src="img/dash2.png" class="dash-image" alt="User Image" style="width: 80%;"> -->
            </div>
            <div class="col-md-6 text-center bg-gradient-white">
                <div id="chart"></div>
                
            </div>
                
        </div>

     </div>
    
     <div class="card card-body">
     
        <div class="row text-center">
            <div class="col-md-12">
                <!-- Widget: user widget style 1 -->
                <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-gradient-info">
                    @guest
                                
                    @else   
                    <h3 class="widget-user-username text-dark"><span class="">{{ Auth::user()->name }}</span></h3>
                    @endguest
                  
                </div>
                  <div class="widget-user-image">
                    <img class="img-circle elevation-2" src="{{ asset('img/user.png') }}" alt="User Avatar">
                  </div>
                  <div class="card-footer bg-gradient-light">
                  <div class="row">
                        <div class="col">
                        <div class="description-block">
                        <h5><span class="description-header badge badge-warning">12</span></h5>
                        <span class="description-text">Total Book Lending</span>
                        </div>
                        <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col">
                        <div class="description-block">
                        <h5><span class="description-header badge badge-danger">12</span></h5>
                        <span class="description-text">Total Book Retun</span>
                        </div>
                        <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col">
                        <div class="description-block">
                        <h5><span class="description-header badge badge-info">12</span></h5>
                        <span class="description-text">Total Books Add</span>
                        </div>
                        <!-- /.description-block -->
                        </div>
                        <!-- /.col -->
                        <div class="col">
                        <div class="description-block">
                        <h5><span class="description-header badge badge-success">12</span></h5>
                        <span class="description-text">Total Members Add</span>
                        </div>
                        <!-- /.description-block -->
                        </div>
                  </div>
                  <!-- /.row -->
                  </div>
                  </div>
                  <!-- /.widget-user -->
            </div>
           
      
            
                
        </div>

     </div>
     
</div>
            
            
            
            
       
                

@push('scripts')
 
<script type="text/javascript">

</script>

@endpush

@endsection

@section('script')
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
