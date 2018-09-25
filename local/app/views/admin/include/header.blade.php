<div class="page-banner">
    <div class="left-banner">
        <h3 class="page-title">{{$pageTitle}}</h3>
        <ul class="page-breadcrumb">
            @if($slug != 'dashboard')
                <li>
                    <i class="fa fa-tachometer"></i>
                    <a href="{{route('admin.dashboard.index')}}">{{Lang::get('core.dashboard')}}</a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <?php
                    try {
                        $slug = strtolower($pageTitle);
                        $main_slug = route('admin.'.$slug.'.index');
                    } catch (Exception $e) {
                        $main_slug = '';
                    }
                ?>
                @if($main_slug != '')
                <li>
                    <a href="{{ $main_slug }}">{{ $pageTitle }}</a>
                </li>
                @endif
            @endif
        </ul>
    </div> {{-- end of .left-banner --}}
    <div class="right-banner">
        <ul>
            <li class="dropdown dropdown-extended dropdown-notification" id="header_notification_bar">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <span class="label">Notifications:</span>
                    @if(count($pending_applications)>0 || count($cashadvance_applications)>0)
                        <span class="badge badge-default">
                            {{count($pending_applications) + count($cashadvance_applications)}}
                        </span>
                    @endif
                </a>
                <div class="dropdown-menu">
                    <ul>
                        <li class="external">
                            <h3><span class="bold">{{count($pending_applications) + count($cashadvance_applications )}} pending</span> notifications</h3>
                        </li>
                        @if( count( $pending_applications . $cashadvance_applications) > 0 )
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 250px;" data-handle-color="#637283">
                                    @foreach($pending_applications as $pending)
                                    <li>
                                        <a style="padding: 10px 0;" data-toggle="modal" href="{{url('admin/leave_applications')}}" onclick="show_application_notification({{ $pending->id }});return false;">
                                            <span class="time">{{date('d-M-Y',strtotime($pending->created_at))}}</span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-success">
                                                    <i class="fa fa-bell-o"></i>
                                                </span>
                                                <strong>{{$pending->employeeDetails->firstName . ' ' . $pending->employeeDetails->lastName}} </strong> has applied for leave on

                                                @if(isset($pending->end_date) && $pending->end_date != null)
                                                    {{ date('d-M-Y',strtotime($pending->start_date)) }} to {{ date('d-M-Y',strtotime($pending->end_date)) }}
                                                @else
                                                    {{date('d-M-Y',strtotime($pending->start_date))}}
                                                @endif
                                            </span>
                                        </a>
                                    </li>
                                    @endforeach
                                    @foreach($cashadvance_applications as $cash)
                                    <li>
                                        <a style="padding: 10px 0;" data-toggle="modal" href="{{route('admin.cashadvance.index')}}" onclick="show_application_notification({{ $cash->id }});return false;">
                                            <span class="time">{{date('d-M-Y',strtotime($cash->created_at))}}</span>
                                            <span class="details">
                                                <span class="label label-sm label-icon label-success">
                                                    <i class="fa fa-bell-o"></i>
                                                </span>
                                                <strong>{{$cash->getEmployeeDetails->firstName . ' ' . $cash->getEmployeeDetails->lastName}} </strong> has applied for Cash Advance

                                                
                                            </span>
                                        </a>
                                    </li>
                                    @endforeach

                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
            <li class="dropdown dropdown-language">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <span class="label">Language:</span>
                    <span class="langname">
                    {{$setting->getLangName->language}} </span>
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-default">
                    @foreach($languages as $lang)
                        @if($lang->locale !=$setting->locale)
                            <li>
                                <a href="javascript:;" onclick="changeLanguage('{{$lang->locale}}')">{{ $lang->language }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </li>
        </ul> {{-- end of #header-notification-bar --}}
    </div> {{-- end of .right-banner --}}
</div> {{-- end of .page-banner --}}