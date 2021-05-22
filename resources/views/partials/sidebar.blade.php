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
                                {{__('Dashboard')}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/home') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Library')}}</p>
                                </a>
                            </li>
                            

                        </ul>
                    </li>
                     <!-- resources -->
                     <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-windows"></i>
                            <p>
                                {{__('Resources')}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('resource-catalogue')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('resource_catelog') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Resources Catelog')}}</p>
                                </a>
                            </li>
                            @endcan
                            @can('resource-list')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('resource.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Search Resources')}}</p>
                                </a>
                            </li>
                            @endcan
                            @can('resource-create')
                            <li class="nav-item">
                            <a href="{{ route('create_resource') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Add Resources')}}</p>
                                </a>
                            </li> 
                            @endcan
                        </ul>
                    </li>
                   
                    <!-- Resources Lending -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-shopping-cart"></i>
                            <p>
                                 {{__('Lending')}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('Lenging-issue')
                            <li class="nav-item">
                            <a href="{{ route('issue.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Issue Resources')}}</p>
                                </a>
                            </li>
                            @endcan
                            @can('Lenging-return')
                            <li class="nav-item">
                                <a href="{{ route('return.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Return Resources')}}</p>
                                </a>
                            </li>
                            @endcan
                            @can('lenging-list')
                            <li class="nav-item">
                                <a href="{{ route('lending.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Search Lending')}}</p>
                                </a>
                            </li>
                            @endcan
                            @can('lenging-list')
                            <li class="nav-item">
                                <a href="{{ route('lending_history') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Lending History')}}</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    <!-- members -->
                    @can('member-list')
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-address-card-o"></i>
                            <p>
                               {{__('Members')}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                           
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('members.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Search Member')}}</p>
                                </a>
                            </li>
                
                            @can('member-create')
                            <li class="nav-item">
                                <a href="{{ route('create_member') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Add Member')}}</p>
                                </a>
                            </li>
                            @endcan
                          
                            <li class="nav-item">
                                <a href="{{ route('codes.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Member Account')}}</p>
                                </a>
                            </li>
                         
                            
                        </ul>
                    </li>
                    @endcan
                    <!-- Support Data -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-laptop"></i>
                            <p>
                                {{__('Support Data')}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('resource_support_data-list')
                            <li class="nav-item">
                            <a href="{{ route('resource_catagory.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Resources Support')}}</p>
                                </a>
                            </li>
                            @endcan
                            @can('member_support_data-list')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('member_catagory.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Members Support')}}</p>
                                </a>
                            </li>
                            @endcan
                            @can('staff_support_data-list')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('designation.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Staff Support')}}</p>
                                </a>
                            </li>
                            @endcan
                            @can('library_support_data-list')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('titles.index') }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Library Support')}}</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    <!-- Codes -->
                    @can('code-genarate')
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-barcode"></i>
                            <p>
                                {{__('Code Genarate')}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                           
                            <li class="nav-item">
                            <a href="{{ route('Barcoderange') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Genarate Codes')}}</p>
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                    @endcan
                    <!-- Board Of Survay -->
                    @can('survey-list')
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-check-square-o"></i>
                            <p>
                            {{__('library Survay')}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                           
                            <li class="nav-item">
                            <a href="{{ route('view_survey',0) }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Survey')}}</p>
                                </a>
                            </li>
                           
                            <li class="nav-item">
                                <a href="{{ route('view_survey',1) }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('History')}}</p>
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                    @endcan
                    <!-- receipts -->
                    @can('receipt-list')
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-file-o"></i>
                            <p>
                            {{__('Receipts')}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                            <a href="{{ route('view_survey',0) }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Receipts')}}</p>
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                    @endcan
                    
                    {{-- staff --}}
                    @can('staff-list')
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                            {{__('Staff')}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('staff-create')
                            <li class="nav-item">
                            <a href="{{ route('staff.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Add Staff')}}</p>
                                </a>
                            </li>
                            @endcan
                            <li class="nav-item">
                                <a href="{{ route('staff.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Search Staff')}}</p>
                                </a>
                            </li>
                            
                        </ul>
                    </li>
                    @endcan

                    {{-- center --}}
                    @can('center-list')
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-home"></i>
                            <p>
                            {{__('Centers')}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            
                            <li class="nav-item">
                                <a href="{{ route('center.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Search Center')}}</p>
                                </a>
                            </li>
                            @can('center-create')
                            <li class="nav-item">
                                <a href="{{ route('center.create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Add Center')}}</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan
                   
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-user-circle"></i>
                            <p>
                                {{__('User Account')}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                          
                            <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('My Account')}}</p>
                                </a>
                            </li>
                          
                            @can('user-list')
                            <li class="nav-item">
                            <a href="{{ route('staff_users') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Staff Users')}} Account</p>
                                </a>
                            </li>
                            <li class="nav-item">
                            <a href="{{ route('member_users') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Member Users Account')}}</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @can('role-list')
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-lock"></i>
                            <p>
                            {{__('Roles & Permisions')}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Roles & Permisions')}}</p>
                                </a>
                            </li>
 
                        </ul>
                    </li>
                    @endcan

                    @can('activity-log')
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-tasks"></i>
                            <p>
                            {{__('Activity Log')}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ route('roles.index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Search Log')}}</p>
                                </a>
                            </li>
 
                        </ul>
                    </li>
                    @endcan
                    {{-- setting --}}
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-cog"></i>
                            <p>
                            {{__('Settings')}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('basic_setting-list')
                            <li class="nav-item">
                                <a href="{{ route('basic_setting') }}" class="nav-link">
                                    <i class="fa fa-wrench nav-icon"></i>
                                    <p>{{__('Basic Settings')}}</p>
                                </a>
                            </li>
                            @endcan
                            @can('lms_setting-list')
                            <li class="nav-item">
                            <a href="{{ route('lms_setting') }}" class="nav-link">
                                    <i class="fa fa-wrench nav-icon"></i>
                                    <p>{{__('LMS Settings')}}</p>
                                </a>
                            </li>
                            @endcan
                            @can('lending_setting-list')
                            <li class="nav-item">
                                <a href="{{ route('lending_setting') }}" class="nav-link">
                                    <i class="fa fa-wrench nav-icon"></i>
                                    <p>{{__('Lending Settings')}}</p>
                                </a>
                            </li>
                            @endcan
                            @can('notification_setting-list')
                            <li class="nav-item">
                                <a href="{{ route('notification_setting') }}" class="nav-link">
                                    <i class="fa fa-wrench nav-icon"></i>
                                    <p>{{__('Notification Settings')}}</p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>

                    {{-- backup --}}
                    @can('activity-log')
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fa fa-tasks"></i>
                            <p>
                            {{__('Backup & Restore')}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ route('backup_db') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Backup DataBase')}}</p>
                                </a>
                            </li>
 
                        </ul>
                    </li>
                    @endcan
                   
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                {{__('Reports')}}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('resource-report')
                            <li class="nav-item">
                                <a href="{{ route('rpt_resource_index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Resource Reports')}}</p>
                                </a>
                            </li>
                            @endcan
                            @can('member-report')
                            <li class="nav-item">
                                <a href="{{ route('rpt_resource_index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Member Reports')}}</p>
                                </a>
                            </li>
                            @endcan
                            @can('lending-report')
                            <li class="nav-item">
                                <a href="{{ route('rpt_lending_index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Lending Reports')}}</p>
                                </a>
                            </li>
                            @endcan
                            @can('resource_support_data-report')
                            <li class="nav-item">
                                <a href="{{ route('rpt_support_index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Resource Support Data Reports')}}</p>
                                </a>
                            </li>
                            @endcan
                            @can('member_support_data-report')
                            <li class="nav-item">
                                <a href="{{ route('rpt_support_index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Member Support Data Reports')}}</p>
                                </a>
                            </li>
                            @endcan
                            @can('staff_support_data-report')
                            <li class="nav-item">
                                <a href="{{ route('rpt_support_index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Staff Support Data Reports')}}</p>
                                </a>
                            </li>
                            @endcan
                            @can('library_support_data-report')
                            <li class="nav-item">
                                <a href="{{ route('rpt_support_index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Library Support Data Reports')}}</p>
                                </a>
                            </li>
                            @endcan
                            @can('survey-report')
                            <li class="nav-item">
                                <a href="{{ route('rpt_resource_index') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Survey Reports')}}</p>
                                </a>
                            </li>
                            @endcan
                            @can('user-report')
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('User Reports')}}</p>
                                </a>
                            </li>
                            @endcan
                            @can('log-report')
                            <li class="nav-item">
                                <a class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('Log Reports')}}</p>
                                </a>
                            </li>
                            @endcan
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
  