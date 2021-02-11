<!-- @php 
    $istitute = session()->get('istitute');
    $user = session()->get('user');  
@endphp  -->

        <!-- Sidebar -->
    <div class="sidebar">
        <!-- <div class="user-panel">
            <div class=" image">
                <img src="img/user.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Code-js</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div> -->
            <!-- Sidebar Menu -->
            <nav class="mt-2">
            
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- dashboard -->
                    <li class="nav-item has-treeview menu-open">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/home') }}" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Library</p>
                                </a>
                            </li>
                            

                        </ul>
                    </li>
                     <!-- resources -->
                     <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-windows"></i>
                            <p>
                                Resources
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{ route('create_resource') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Resources</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('resource.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Search Resources</p>
                                </a>
                            </li>
                           
                        </ul>
                    </li>
                   
                    <!-- Book Lending -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-handshake"></i>
                            <p>
                                Books Lending
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Issue Books</p>
                                </a>
                            </li>
                          
                            <li class="nav-item">
                                <a href="{{ route('codes.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Return Books</p>
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                    <!-- members -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                               Members
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{ route('create_member') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Member</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('members.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Search Member</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('codes.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Member Details</p>
                                </a>
                            </li>
                            
                        </ul>
                    </li>

                    <!-- Support Data -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-laptop"></i>
                            <p>
                                Support Data
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{ route('resource_catagory.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Resources Support</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! url('/createOT') !!}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Members Support</p>
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="{{ route('codes.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Impots</p>
                                </a>
                            </li> -->
                            
                        </ul>
                    </li>
                    <!-- Codes -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-barcode"></i>
                            <p>
                                Code Genarate
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{ route('Barcoderange') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Custom Codes</p>
                                </a>
                            </li>
                           
                            <li class="nav-item">
                                <a href="{{ route('codes.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Excel Impots</p>
                                </a>
                            </li>
                            
                        </ul>
                    </li>

                    <!-- Board Of Survay -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase"></i>
                            <p>
                            Board Of Survay
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{ route('Barcoderange') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Survey</p>
                                </a>
                            </li>
                           
                            <li class="nav-item">
                                <a href="{{ route('codes.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>History</p>
                                </a>
                            </li>
                            
                        </ul>
                    </li>

                    @can('role-list')
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-user-circle"></i>
                            <p>
                                User Account
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Users Account</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Roles & Permisions</p>
                                </a>
                            </li>
                           
                            
                        </ul>
                    </li>
                    
                    @endcan

                   
                   
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Reports
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Books Details Report</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Books Summary Report</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Members Details Report</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Members Summary Report</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Book Lending Report</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Fine Report</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Bord Of Survey Report</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>User Details Report</p>
                                </a>
                            </li>


                        </ul>
                    </li>


                    <li class="nav-header">CODE-JS</li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Calculater</p>
                        </a>
                    </li>

                </ul>

                <hr />


            </nav>
            <!-- /.sidebar-menu -->
        </div>
  