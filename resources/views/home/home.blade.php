
@extends('layouts.app')
@section('style')
<!-- calendar -->
<link href="{{ asset('plugins/calendar/css/calendar.css') }}" rel="stylesheet">
@endsection
@section('content')
@php
$theme = session()->get('theme');
$locale = session()->get('locale');
$lang="_".$locale;
$title="title".$lang;
$member="member".$lang;
@endphp

    <section class="content">
        <div class="container-fluid">
            <div class="row">
               
                <div class="col-12 col-sm-6 col-md-9 js-bg">
                    <div class="content-header pl-3 pb-1 mt-2">
                        <div class="box box-info">
                            <div class="box-header text-left ml-4 pl-3">
                                <div class=" header js-dash-h"> <h5><i class="fa fa-inbox"></i>&nbsp;{{ __("Public Library")}}&nbsp;-&nbsp;{{ __("Library Management System")}}</h5></div>
                                <!-- <div class=" header"> <h5><i class="fa fa-inbox">&nbsp;{{ __("Library Management System")}}</i></h5></div> -->
                            </div>
                        </div>
                    </div>
                    <!-- ------------------------------------------------------------------- -->
                    <div class="row ml-1">
                    <div class="col-12 col-sm-12 col-md-12 ">
                            <div class="js-img-box text-left elevation-2">
                                    <div class="js-box">
                                        <img src="{{ asset('img/js-box.png') }}" class="js-box-img">
                                    </div>
                                    <h4 class="text-left js-dashboard-side-text-heding font-weight-bold">Code-JS LMS</h4>
                                    <p class="js-dashboard-side-text col-md-10 mt-1">
                                        Code-JS LMS is an interactive solution that allows librarians and staff to keep real-time track of inventory and media assets and allows Members digital means of discovery and reading.
                                        an interactive solution that allows Code-JS LMS is an interactive solution that allows 
                                        librarians and staff to keep real-time track of inventory and media assets
                                    </p>
                    
                            </div> 
                        </div>
                    </div>
                    <!-- ------------------------------------------------------------------- -->
                    <div class="row p-3 mb-4 ml-2">
                        <div class="col">
                            <!-- small box -->
                            <div class="small-box js-box-bg-1 elevation-5">
                                <div class="inner js-box-text">
                                    <h3>{{$rcount}}</h3>
                                    <p>Total Resources</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-star-o"></i>
                                </div>
                               
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col">
                            <!-- small box -->
                            <div class="small-box js-box-bg-2 elevation-5">
                                <div class="inner js-box-text">
                                    <h3>{{$mcount}}</h3>
                                    <p>Total members</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user-o"></i>
                                </div>
                               
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col">
                            <!-- small box -->
                            <div class="small-box js-box-bg-3 elevation-5">
                                <div class="inner js-box-text">
                                    <h3>{{$issucount}}</h3>
        
                                    <p>Issue-Today</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-cart-arrow-down"></i>
                                </div>
                               
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col">
                            <!-- small box -->
                            <div class="small-box js-box-bg-4 elevation-5">
                                <div class="inner js-box-text">
                                    <h3>{{$rtncount}}</h3>
        
                                    <p>Retund-Today</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-shopping-bag"></i>
                                </div>
                                
                            </div>
                        </div>
                        <div class="col">
                            <div class="small-box js-box-bg-5 elevation-5">
                                <div class="inner js-box-text">
                                    <h3>Rs&nbsp;{{$income}}</h3>
        
                                    <p>Income-today</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-money"></i>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-12">
                            <div class="box-header text-left ml-5 pl-3">
                                <h6 class="info-box-icon"><u>Quick Links</u></h6>
                                <!-- <h6 class="info-box-icon"><i class="fas fa-cog"></i>&nbsp;Quick Links</h6> -->
                            </div>
                            <!-- <hr> -->
                        </div>
                    </div>
                        
                    <div class="row pl-2 ml-3 pr-2 js-dash-link">
                        
                        <a href="{{ route('create_resource') }}" class="col-md-2 btn btn-block  mt-2 js-dash-link-btn elevation-2">
                            {{-- <span class="info-box-icon pt-2"><i class="fas fa-plus fa-md"></i></span> --}}
                            <span class="info-box-text pt-2">Add Resources</span>
                        </a>

                        <a href="{{ route('create_member') }}" class="col-md-2 btn btn-block js-dash-link-btn elevation-2">
                            {{-- <span class="info-box-icon  "><i class="fas fa-plus fa-md "></i></span> --}}
                            <span class="info-box-text">Add Members</span>
                        </a>

                        <a href="{{ route('resource_catelog') }}" class="col-md-2 btn btn-block  js-dash-link-btn elevation-2">
                            {{-- <span class="info-box-icon  "><i class="fas fa-book fa-md"></i></span> --}}
                            <span class="info-box-text">Catalog</span>
                        </a>

                        <a href="{{ route('resource_catagory.index') }}" class="col-md-2 btn btn-block  js-dash-link-btn elevation-2">
                            {{-- <span class="info-box-icon  "><i class="fas fa-cube fa-md"></i></span> --}}
                            <span class="info-box-text">Supports</span>
                        </a>

                        <a href="{{ route('issue.index') }}" class="col-md-2 btn btn-block  js-dash-link-btn elevation-2">
                            {{-- <span class="info-box-icon  "><i class="fas fa-cart-plus fa-md"></i></span> --}}
                            <span class="info-box-text">Issue</span>
                        </a>

                        <a href="{{ route('return.index') }}" class="col-md-2 btn btn-block  js-dash-link-btn elevation-2">
                            {{-- <span class="info-box-icon  "><i class="fa fa-level-down fa-md"></i></span> --}}
                            <span class="info-box-text">Return</span>
                        </a>

                        <a href="" class="col-md-2 btn btn-block  js-dash-link-btn elevation-2">
                            {{-- <span class="info-box-icon  "><i class="fas fa-file-text fa-md"></i></span> --}}
                            <span class="info-box-text">Receipt</span>
                        </a>

                        <a href="{{ route('rpt_lending_index') }}" class="col-md-2 btn btn-block   js-dash-link-btn elevation-2">
                            {{-- <span class="info-box-icon  "><i class="fas fa-file fa-md"></i></span> --}}
                            <span class="info-box-text">Lending Reports</span>
                        </a>

                        <a href="{{ route('staff.index') }}" class="col-md-2 btn btn-block  js-dash-link-btn elevation-2">
                            {{-- <span class="info-box-icon  "><i class="fa fa-user fa-md"></i></span> --}}
                            <span class="info-box-text">Staff</span>
                        </a>


                        <a href="{{ route('members.index') }}" class="col-md-2 btn btn-block js-dash-link-btn elevation-2">
                            {{-- <span class="info-box-icon  "><i class="fas fa-users fa-md pt-2"></i></span> --}}
                            <span class="info-box-text">Members</span>
                        </a>
                      
                       
                    </div>
                    <div class="row mt-3 pt-4">
                        <div class="col-12 col-sm-6 col-md-12">
                           
                            <div class="box-header text-left ml-5 pl-3">
                                <!-- <h6 class="info-box-icon"><i class="fas fa-cog"></i>&nbsp;Transaction Summary</h6> -->
                                <h6 class="info-box-icon"><u>Transaction Summary</u></h6>
                            </div>
                            <!-- <hr> -->
                        </div>
                    </div>
                    @can('dashboard')
                    <div class="row pl-4 pr-4 mb-4">
                       <div class="col-12 col-sm-12 col-md-6 p-3">
                            <div class="js-chart elevation-3">
                                <div id="chart" class="pt-4"></div>
                            </div>
                       </div>
                       <div class="col-12 col-sm-12 col-md-6 p-3">
                            <div class="js-chart elevation-3">
                                <div id="chart1" class="pt-4"></div>
                            </div>
                       </div>
                    </div>
                    @endcan
            </div>
        
            <div class="col-12 col-sm-6 col-md-3 p-3 js-rightbar-bg">
                    <div class="js-dashboard-side text-center elevation-2">
                        <div id="MyClockDisplay" class="clock text-center" onload="showTime()"></div>
                    </div>
                   
                    <div class="calendar mt-3 mb-3 pb-3">
                        <div class="header">
                            <a data-action="prev-month" href="javascript:void(0)" title="Previous Month"><i></i></a>
                            <div class="text" data-render="month-year"></div>
                            <a data-action="next-month" href="javascript:void(0)" title="Next Month"><i></i></a>
                        </div>
                        <div class="months" data-flow="left">
                            <div class="month month-a">
                                <div class="render render-a"></div>
                            </div>
                            <div class="month month-b">
                                <div class="render render-b"></div>
                            </div>
                        </div>
                    </div>

                    {{-- ---------------notificetion--------------------- --}}
                    <div class="row dash-notify">
                        <div class="col-md-12" id="notificetion">
                            
                        </div>
                    </div>
                        
               
            </div>
        </div>
       
            

             

        </div>
    </section> 

            
            
            
        

@endsection

@section('script')

<!-- calendar -->
<script src="{{ asset('plugins/calendar/js/calendar.js') }}"defer></script>

<script>
$(document).ready(function()
{
    var op="";
    $.ajax
    ({
        type: "GET",
        url: "{{route('latast_lending')}}", 
        async: false,
        success:function(data){
            console.log(data);
            for(var i=0;i<4;i++)
            {
                op+= '<div class="card card-notify">';
                op+= '<div class="card-header card-notify-header1 px-2 py-1">';
                op+= '<h5 class="card-title">'+(i+1)+'-{{trans('Latest Resource Issue') }}</h5>';
                op+= '<div class="card-tools">';
                op+= '<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times">';
                op+= '</i></button></div></div>';
                op+= '<div class="card-body px-2 py-1">';
                op+= data.issue[i].accessionNo+'-'+data.issue[i].{{$title}}+'&nbsp;{{trans('Issue to') }} '+data.issue[i].{{$member}};
                op+= '</div></div>';                  
            }
           for(var j=0;j<4;j++)
           {
                op+= '<div class="card card-notify">';
                op+= '<div class="card-header card-notify-header1 px-2 py-1">';
                op+= '<h5 class="card-title">'+(j+1)+'-{{trans('Latest Resource Return') }}</h5>';
                op+= '<div class="card-tools">';
                op+= '<button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times">';
                op+= '</i></button></div></div>';
                op+= '<div class="card-body px-2 py-1">';
                op+= data.return[j].accessionNo+'-'+ data.return[j].{{$title}}+'&nbsp;{{trans('Return by') }} '+data.return[j].{{$member}};
                op+= '</div></div>';               
           }
            
        },
        error:function(data){
        }
    })
    $("#notificetion").append(op);
});


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
            @if($theme=="js-orange-light")
            colors: ['#fd7e14', '#fd7e14', '#fd7e14', '#fd7e14', '#fd7e14', '#fd7e14', '#fd7e14', '#fd7e14', '#fd7e14', '#fd7e14'],
            @elseif($theme=="js-orange-dark")
            colors: ['#fd7e14', '#fd7e14', '#fd7e14', '#fd7e14', '#fd7e14', '#fd7e14', '#fd7e14', '#fd7e14', '#fd7e14', '#fd7e14'],
            @elseif($theme=="js-blue-light")
            colors: ['#33b2df', '#33b2df', '#33b2df', '#33b2df', '#33b2df', '#33b2df', '#33b2df', '#33b2df', '#33b2df', '#33b2df'],
            @elseif($theme=="js-blue-dark")
            colors: ['#268dfc', '#268dfc', '#268dfc', '#268dfc', '#268dfc', '#268dfc', '#268dfc', '#268dfc', '#268dfc', '#268dfc'],
            @elseif($theme=="js-green-light")
            colors: ['#28a745', '#28a745', '#28a745', '#28a745', '#28a745', '#28a745', '#28a745', '#28a745', '#28a745', '#28a745'],
            @elseif($theme=="js-green-dark")
            colors: ['#28a745', '#28a745', '#28a745', '#28a745', '#28a745', '#28a745', '#28a745', '#28a745', '#28a745', '#28a745'],
            @elseif($theme=="js-dark")
            colors: ['#343a40', '#343a40', '#343a40', '#343a40', '#343a40', '#343a40', '#343a40', '#343a40', '#343a40', '#343a40'],
            @elseif($theme=="js-default")
            colors: ['#268dfc', '#268dfc', '#268dfc', '#268dfc', '#268dfc', '#268dfc', '#268dfc', '#268dfc', '#268dfc', '#268dfc'],
            @elseif($theme=="js-light")
            colors: ['#6c757d', '#6c757d', '#6c757d', '#6c757d', '#6c757d', '#6c757d', '#6c757d', '#6c757d', '#6c757d', '#6c757d'],
            @endif
           
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
                name: 'Issued',
                data: [<?php echo $i_summary; ?>]
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
                title: {
                    text: 'Issued Count'
                }
            },
            title: {
                text: 'Resource Issue-'+ new Date().getFullYear(),
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
                    formatter: function (val) {
                    return val+ " Resources"
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
            @if($theme=="js-orange-light")
            colors: ['#fd7e14'],
            @elseif($theme=="js-orange-dark")
            colors: ['#fd7e14'],
            @elseif($theme=="js-green-light")
            colors: ['#069c2e'],
            @elseif($theme=="js-green-dark")
            colors: ['#069c2e'],
            @elseif($theme=="js-blue-light")
            colors: ['#268dfc'],
            @elseif($theme=="js-blue-dark")
            colors: ['#268dfc'],
            @elseif($theme=="js-default")
            colors: ['#268dfc'],
            @elseif($theme=="js-light")
            colors: ['#6c757d'],
            @elseif($theme=="js-dark")
            colors: ['#6c757d'],
            @endif

            dataLabels: {
                enabled: true,
                style: {
                colors: ['#010102']
                }

            },
            stroke: {
                show: true,
                width: 1,
                colors: ['#010101']
            },
            series: [ {
                name: 'Returned',
                data: [<?php echo $r_summary; ?>]
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
                    text: 'Returned Count'
                }
            },
            title: {
                text: 'Resource Returned-'+ new Date().getFullYear(),
                align: 'center',
                floating: true
            },
            fill: {
                opacity: 1

            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return val+ " Resources"
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
