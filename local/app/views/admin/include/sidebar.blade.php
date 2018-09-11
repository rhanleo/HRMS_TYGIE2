<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <div class="logo-container" style="background: #00aeef">
            <img src="{{ url('assets/admin/layout/img/'.$setting->logo) }}" alt="" width="auto">
        </div> {{-- end of .logo-container --}}
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu {{ isset( $close_sidebar ) && $close_sidebar == true ? 'page-sidebar-menu-closed' : '' }}" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper">
                <div class="profile-sidebar">
                    <div class="img-container">
                        <div class="getImg" style="background-image: url( {{ URL::asset( 'assets/admin/layout/img/user.png' ); }} );border-radius: 100% !important"></div>
                    </div>
                    <div class="text">
                        <div class="username username-hide-on-mobile">{{ $loggedAdmin->name }}</div>
                        <ul class="links">
                            <li>
                                <a href="{{route('admin.profile_settings.edit',Auth::admin()->get()->id)}}">
                                    {{trans('menu.myProfile')}}
                                </a>
                            </li>
                            <li>
                                <a href="{{ URL::route('admin.logout') }}">{{trans('menu.logout')}}</a>
                            </li>
                        </ul>
                    </div> {{-- end of .text --}}
                    <div class="sidebar-toggler"></div>
                </div> {{-- end of .profile-sidebar --}}
            </li>
            <li class="start {{ $dashboardActive or ''}}">
                <a href="{{URL::to('admin')}}">
                    <i class="fa fa-home fa-fw"></i>
                    <span class="title">{{Lang::get('menu.dashboard')}}</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="{{ $employeesOpen or ''}}">
                <a href="javascript:;">
                    <i class="fa fa-users fa-fw"></i>
                    <span class="title">{{Lang::get('menu.employees')}}</span>
                    <!-- <span class="selected"></span> -->
                    <span class="arrow "></span>
                </a>

                <ul class="sub-menu">
                    <li class="{{ $markAttendanceActive or ''}}">
                        <a href="{{route('admin.employees.index')}}">{{'All'}}</a>
                    </li>
       
                    <li class="{{ $markAttendanceActive or ''}}">
                        <a href="javascript:;">
                      
                        <span class="title">{{'Internal'}}</span>
                        <!-- <span class="selected"></span> -->
                        <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="{{ $markAttendanceActive or ''}}">
                                <?php
                                $deptId = Department::Select('id')->Where('deptName', '=', 'Internal')->get();
                                foreach($deptId as $dept){
                                    $desigId = Designation::Where('deptID', '=', $dept['id'])->get();
                                    foreach($desigId as $desig){
                                        ?>
                                            <a href="{{route('admin.internal.index', $desig['id'])}}">{{$desig['designation']}}</a>
                                        <?php
                                    }
                                }
                                ?> 
                            </li>
                        </ul>
                    </li>
                    <!-- External -->
                    <li class="{{ $markAttendanceActive or ''}}">
                        <a href="javascript:;">
                      
                        <span class="title">{{'External'}}</span>
                        <!-- <span class="selected"></span> -->
                        <span class="arrow "></span>
                        </a>
                        <ul class="sub-menu">
                            <li class="{{ $markAttendanceActive or ''}}">

                                <?php
                                $deptId = Department::Select('id')->Where('deptName', '=', 'External')->get();
                                foreach($deptId as $dept){
                                    $desigId = Designation::Where('deptID', '=', $dept['id'])->get();
                                    foreach($desigId as $desig){
                                        ?>
                                            <a href="{{route('admin.external.index', $desig['id'])}}">{{$desig['designation']}}</a>
                                        <?php
                                    }
                                }
                                ?> 
                               
                            </li>
                            <li class="{{ $markAttendanceActive or ''}}">
                                <a href="{{route('admin.branches.index')}}">
                                    <span class="title">{{'Branches'}}</span>
                                    <span class="selected"></span>
                                </a>
                            </li>
                            
                        </ul>
                    </li>                    
                    
                </ul>
            </li>
            <li class="{{ $departmentOpen or ''}}">
                <a href="{{route('admin.employees.workinghistory')}}">
                    <i class="fa fa-history fa-fw"></i>
                    <span class="title">{{'Working History'}}</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="{{ $departmentOpen or ''}}">
                <a href="{{route('admin.departments.index')}}">
                    <i class="fa fa-briefcase fa-fw"></i>
                    <span class="title">{{Lang::get('menu.department')}}</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="{{ $awardsOpen or ''}}">
                <a href="{{route('admin.awards.index')}}">
                    <i class="fa fa-trophy fa-fw"></i>
                    <span class="title">{{Lang::get('menu.award')}}</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="{{ $appraisalOpen or ''}}">
                <a href="{{route('admin.appraisal.index')}}">
                    <i class="fa fa-file-text-o fa-fw" aria-hidden="true"></i>
                    <span class="title">Appraisal</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="{{ $expensesOpen or ''}}">
                <a href="{{route('admin.expenses.index')}}">
                    <i class="fa fa-money fa-fw"></i>
                    <span class="title">{{Lang::get('menu.expense')}}</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="{{ $holidayOpen or ''}}">
                <a href="{{route('admin.holidays.index')}}">
                    <i class="fa fa-send fa-fw"></i>
                    <span class="title">{{Lang::get('menu.holiday')}}</span>
                    <span class="selected"></span>
                </a>
            </li>

             <li class="{{ $holidayOpen or ''}}">
                <a href="{{route('admin.schedule.index')}}">
                <i class="fa fa-calendar fa-fw"></i>
                    <span class="title">{{'Schedule'}}</span>
                    <span class="selected"></span>
                </a>
            </li>


            <li class="{{ $attendanceOpen or ''}}">
                <a href="javascript:;">
                    <i class="fa fa-user fa-fw"></i>
                    <span class="title">{{Lang::get('menu.attendance')}}</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ $markAttendanceActive or ''}}">
                        <a href="{{route('admin.attendances.create')}}">{{Lang::get('menu.markAttendance')}}</a>
                    </li>
                    <li class="{{ $viewAttendanceActive or ''}}">
                        <a href="{{route('admin.attendances.index')}}">{{Lang::get('menu.viewAttendance')}}</a>
                    </li>
                    <li class="{{ $leaveTypeActive or ''}}">
                        <a href="{{route('admin.leavetypes.index')}}">{{Lang::get('menu.leaveTypes')}}</a>
                       
                    </li>
                </ul>
            </li>

            <li class="{{ $leaveApplicationOpen or ''}}">
                <a href="{{route('admin.leave_applications.index')}}">
                    <i class="fa fa-rocket fa-fw"></i>
                    <span class="title">{{Lang::get('menu.leaveApplication')}}</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="{{ $overtimeApplicationOpen or ''}}">
                <a href="{{route('admin.overtime_applications.index')}}">
                    <i class="fa fa-clock-o fa-fw"></i>
                    <span class="title">Overtime Application</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="{{ $payrollOpen or ''}}{{ $sssSettingsOpen or ''}}{{ $philHealthOpen or ''}}">
                <a href="javascript:void();">
                    <i class="fa fa-usd"></i>
                    <span class="title">{{ Lang::get('menu.payroll') }}</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ $payrollActive or ''}}">
                        <a href="{{route('admin.payrolls.index')}}">
                            <i class="fa fa-usd"></i> Payroll List
                        </a>
                    </li>
                    <li class="{{ $sssSettingsActive or '' }}">
                        <a href="{{ route( 'admin.sss_settings.index' ) }}">
                            <i class="fa fa-clipboard"></i>
                            SSS
                        </a>
                    </li>
                    <li>
                        <a href="{{ route( 'admin.philhealth.index' ) }}">
                            <i class="fa fa-clipboard"></i> PhilHealth
                        </a>
                    </li>
                </ul>
            </li>       



            <li class="{{ $noticeBoardOpen or ''}}">
                <a href="{{route('admin.noticeboards.index')}}">
                    <i class="fa fa-rocket fa-fw"></i>
                    <span class="title">{{Lang::get('menu.noticeBoard')}}</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="{{ $jobsOpen or ''}}">
                <a href="javascript:;">
                    <i class="fa fa-globe fa-fw"></i>
                    <span class="title">{{Lang::get('menu.jobsPosted')}}</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ $jobsPostedActive or ''}}">
                        <a href="{{route('admin.jobs.index')}}">{{Lang::get('menu.jobsPosted')}}</a>
                    </li>
                    <li class="{{ $jobsApplicationActive or ''}}">
                        <a href="{{route('admin.job_applications.index')}}">{{Lang::get('menu.jobApplications')}}</a>
                    </li>
                </ul>
            </li>
            @if(Auth::admin()->get()->level == 0)
            <li class="{{ $settingOpen or ''}}">
                <a href="javascript:;">
                    <i class="fa fa-cogs fa-fw"></i>
                    <span class="title">{{Lang::get('menu.settings')}}</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li class="{{ $settingActive or ''}}">
                        <a href="{{route('admin.settings.edit','setting')}}">{{Lang::get('menu.generalSetting')}}</a>
                    </li>
                    <li class="{{ $profileSettingActive or ''}}">
                        <a href="{{route('admin.profile_settings.edit',Auth::admin()->get()->id)}}">{{Lang::get('menu.profileSetting')}}</a>
                    </li>
                    <li class="{{ $notificationSettingActive or ''}}">
                        <a href="{{route('admin.notificationSettings.edit',Auth::admin()->get()->id)}}">{{Lang::get('menu.notificationSetting')}}</a>
                    </li>
               
                    {{-- <li class="{{ $themeSettingActive or ''}}">
                        <a href="{{route('admin.settings.theme')}}">{{Lang::get('menu.theme')}}</a>
                    </li> --}}
                    <li class="{{ $adminUserActive or ''}}">
                        <a href="{{route('admin.admin_users.index')}}">{{Lang::get('menu.adminUser')}}</a>
                    </li>
                    {{-- <li class="{{ $cpfSettingsActive or ''}}">
                        <a href="{{route('admin.cpf_settings.index')}}">CPF Settings</a>
                    </li> --}}

                </ul>
            </li>
            @endif
        </ul>
    </div> {{-- end of .page-sidebar --}}
</div> {{-- end of .page-sidebar-wrapper --}}
<!-- END SIDEBAR -->
