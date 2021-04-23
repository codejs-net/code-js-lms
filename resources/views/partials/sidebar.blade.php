<!-- @php 
    $istitute = session()->get('istitute');
    $user = session()->get('user');  
@endphp  -->

        <!-- Sidebar -->
    <div class="sidebar">

            <nav class="mt-2 js-sidebar-text">
            
                <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu" data-accordion="false">
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
                                <a href="{{ url('/home') }}" class="nav-link">
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
                                <a class="nav-link" href="{{ route('resource_catelog') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Resources Catelog</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('resource.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Search Resources</p>
                                </a>
                            </li>
                            <li class="nav-item">
                            <a href="{{ route('create_resource') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Resources</p>
                                </a>
                            </li> 
                           
                        </ul>
                    </li>
                   
                    <!-- Resources Lending -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>
                                 Lending
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{ route('issue.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Issue Resources</p>
                                </a>
                            </li>
                          
                            <li class="nav-item">
                                <a href="{{ route('return.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Return Resources</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('return.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Lending History</p>
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
                                    <p>Member Account</p>
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
                                <a class="nav-link" href="{{ route('member_catagory.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Members Support</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('designation.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Staff Support</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('resource_catagory.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Library Support</p>
                                </a>
                            </li>
                            
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
                            library Survay
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{ route('view_survey',0) }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Survey</p>
                                </a>
                            </li>
                           
                            <li class="nav-item">
                                <a href="{{ route('view_survey',1) }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>History</p>
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                    <!-- receipts -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase"></i>
                            <p>
                            Receipts
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{ route('view_survey',0) }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Receipts</p>
                                </a>
                            </li>
                            
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-cog"></i>
                            <p>
                            Settings
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('basic_setting') }}" class="nav-link">
                                    <i class="fa fa-wrench nav-icon"></i>
                                    <p>Basic Settings</p>
                                </a>
                            </li>
                            <li class="nav-item">
                            <a href="{{ route('lms_setting') }}" class="nav-link">
                                    <i class="fa fa-wrench nav-icon"></i>
                                    <p>LMS Settings</p>
                                </a>
                            </li>
                           
                            <li class="nav-item">
                                <a href="{{ route('lending_setting') }}" class="nav-link">
                                    <i class="fa fa-wrench nav-icon"></i>
                                    <p>Lending Settings</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('notification_setting') }}" class="nav-link">
                                    <i class="fa fa-wrench nav-icon"></i>
                                    <p>Notification Settings</p>
                                </a>
                            </li>
                            
                        </ul>
                    </li>

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-briefcase"></i>
                            <p>
                            Staff
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{ route('staff.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Staff</p>
                                </a>
                            </li>
                           
                            <li class="nav-item">
                                <a href="{{ route('staff.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Search Staff</p>
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-home"></i>
                            <p>
                            Centers
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{ route('center.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Center</p>
                                </a>
                            </li>
                           
                            <li class="nav-item">
                                <a href="{{ route('center.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Search Center</p>
                                </a>
                            </li>
                            
                        </ul>
                    </li>

                   
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
                                    <p>My Account</p>
                                </a>
                            </li>
                          
                            @can('user-list')
                            <li class="nav-item">
                            <a href="{{ route('staff_users') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Staff Users Account</p>
                                </a>
                            </li>
                            <li class="nav-item">
                            <a href="{{ route('member_users') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Member Users Account</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @can('role-list')
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-user-circle"></i>
                            <p>
                            Roles & Permisions
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

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
                                <a href="{{ route('rpt_resource_index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Resource Reports</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('rpt_resource_index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Member Reports</p>
                                </a>
                            </li>
                           
                            <li class="nav-item">
                                <a href="{{ route('rpt_resource_index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Lending Reports</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('rpt_support_index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Support Data Reports</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('rpt_resource_index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Survey Reports</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>User Reports</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Other Reports</p>
                                </a>
                            </li>

                        </ul>
                    </li>


                    <li class="nav-header"></li>
                    <!-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="fas fa-circle nav-icon"></i>
                            <p>Calculater</p>
                        </a>
                    </li> -->

                </ul>

                <hr />


            </nav>
            <!-- /.sidebar-menu -->
        </div>
  