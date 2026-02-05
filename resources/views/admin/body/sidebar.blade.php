 @php
    $id = Auth::user()->id;
    $userid = App\Models\User::find($id);
    $status = $userid->status;

@endphp
 <div class="left-side-menu">

                <div class="h-100" data-simplebar>

                    <!-- User box -->
                   

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul id="side-menu">

                            <li class="menu-title">Navigation</li>
                 

                            <li>
                                <a href="{{ route('admin.dashboard') }}">
                                    <i class="mdi mdi-view-dashboard-outline"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>
                            @if($status == 'active') 
                            <li class="menu-title mt-2">Menu</li>

                             
                            <li>
                                <a href="#sidebarEcommerce" data-bs-toggle="collapse">
                                    <i class="mdi mdi-cart-outline"></i>
                                    <span> Branch </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarEcommerce">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('all.branch') }}">All Branch</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('add.branch') }}">Add Branch</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>

                            <li class="menu-title mt-2">Custom</li>

                            <li>
                                <a href="#sidebarAuth" data-bs-toggle="collapse">
                                    <i class="mdi mdi-account-circle-outline"></i>
                                    <span> Branch Manager's </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarAuth">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('all.manager') }}">All Manageres</a>
                                        </li>

                                         <li>
                                            <a href="{{ route('add.manager') }}">Add Manager</a>
                                        </li>
                                        
                                        
                                    </ul>
                                </div>
                            </li>

                            <li class="menu-title mt-2">Employee Settings</li>

                            <li>
                                <a href="#employee" data-bs-toggle="collapse">
                                    <i class="mdi mdi-bookmark-multiple-outline"></i>
                                    <span> Employee </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="employee">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('all.employees') }}">All Employees</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('add.employee') }}">Add Employee</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>

                            @endif
 

                            <li class="menu-title mt-2">Components</li>

                            <li>
                                <a href="#sidebarForms" data-bs-toggle="collapse">
                                    <i class="mdi mdi-bookmark-multiple-outline"></i>
                                    <span> Forms </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="sidebarForms">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="forms-elements.html">General Elements</a>
                                        </li>
                                        <li>
                                            <a href="forms-advanced.html">Advanced</a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </li>

                           

                            
 
                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>