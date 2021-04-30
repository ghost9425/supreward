<div id="slide-out" class="side-nav white fixed wide side-nav-light z-depth-0">
    <ul class="custom-scrollbar_">
        <!-- Side navigation links -->
        <li>
            <div id="ZoneAll">
                <ul class="accordion collapsible collapsible-accordion">
                    {{-- @if( $layoutUser->permission_id == 3 )
                    <li id="menuSelectCompany" class="menuMain">
                        <a href="{{ route('SelectCompany.index') }}" class="collapsible-header waves-effect {{ ($layout_page=='select_company')?'active':'' }}"><i class="sv-slim-icon fas fa-dashboard"></i>
                            <label class="main">Select Company</label>
                        </a>
                    </li>
                    @endif

                    @if( in_array($layoutUser->permission_id, [1,2]) )
                    <li id="menuDashboard" class="menuMain">
                        <a href="{{ route('Dashboard.index') }}" class="collapsible-header waves-effect {{ ($layout_page=='dashboard')?'active':'' }}"><i class="sv-slim-icon fas fa-dashboard"></i>
                            <label class="main">Dashboard</label>
                        </a>
                    </li>
                    @endif --}}

                    {{-- @if( $layoutUser->permission_id == 3 && !empty(session('select_company_id')) )
                    <li id="menuDaily" class="menuMain">
                        <a class="collapsible-header waves-effect arrow-r {{ ($layout_page=='daily')?'active':'' }}">
                            <i class="sv-slim-icon fas fa-member fa-angle-double-left"></i>
                            <label class="main">Daily</label>
                            <i class="fas fa-angle-down rotate-icon"></i>
                        </a>
                        <div class="collapsible-body">
                            <ul>
                                <li id="menuDailylist"><a href="{{ route('Daily.index') }}" class="waves-effect">
                                    <span class="sv-normal submain" >Daily list</span></a>
                                </li>
                                <li id="menu"><a href="{{ route('Daily.ImportCsv') }}" class="waves-effect">
                                    <span class="sv-normal submain" set-lan="text:Add Member">Import CSV</span></a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    @endif --}}

                    {{-- @if( in_array($layoutUser->permission_id, [1,2,3]) )
                    <li id="menuAccount" class="menuMain">
                        <a class="collapsible-header waves-effect arrow-r {{ ($layout_page=='profile')?'active':'' }}">
                            <i class="sv-slim-icon fas fa-member fa-angle-double-left"></i>
                            <label class="main">Account</label>
                            <i class="fas fa-angle-down rotate-icon"></i>
                        </a>
                        <div class="collapsible-body">
                            <ul>
                                <li id="menuProfile"><a href="{{ route('Profile.index') }}" class="waves-effect">
                                    <span class="sv-normal submain" >Profile</span></a>
                                </li>
                                <li id="menuPassword"><a href="{{ route('Profile.password') }}" class="waves-effect">
                                    <span class="sv-normal submain" set-lan="text:Add Member">Password</span></a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    <li id="menuDashboard" class="menuMain">
                        <a class="collapsible-header waves-effect arrow-r {{ ($layout_page=='report')?'active':'' }}">
                            <i class="sv-slim-icon fas fa-payment fa-angle-double-left"></i>
                            <label class="main">Report</label>
                            <i class="fas fa-angle-down rotate-icon"></i>
                        </a>
                        <div class="collapsible-body">
                            <ul>
                                <li id="menuCompanyAdd"><a href="{{ route('Report.company') }}" class="waves-effect">
                                    <span class="sv-normal submain" id="AddItem" set-lan="text:Add Company">Win/Lose Report</span></a>
                                </li>

                            </ul>
                        </div>
                    </li>
                    @endif --}}
                    {{-- <li id="menuCompany" class="menuMain">
                        <a href="{{ route('Company.index') }}" class="collapsible-header waves-effect {{ ($layout_page=='company')?'active':'' }}"><i class="sv-slim-icon fas fa-payment fa-angle-double-left"></i>
                            <label class="main">Company</label>
                        </a>
                    </li> --}}
                    <li id="menuCompany" class="menuMain">
                        <a class="collapsible-header waves-effect arrow-r {{ ($layout_page=='complaint')?'active':'' }}">
                            <i class="sv-slim-icon fas fa-payment fa-angle-double-left"></i>
                            <label set-lan="text:Company" class="main">Complaint</label>
                            <i class="fas fa-angle-down rotate-icon"></i>
                        </a>
                        <div class="collapsible-body">
                            <ul>
                                <li id="menuCompanyAdd">
                                    <a href="{{ route('Complaint.add') }}" class="waves-effect">
                                        <span class="sv-normal submain" id="AddItem" set-lan="text:Add Company">Add Complaint</span>
                                    </a>
                                </li>
                                <li id="menuCompany">
                                    {{-- <a href="{{ route('Complaint.index') }}" class="waves-effect"> --}}
                                        <a href="{{ route('Complaint.index') }}" class="waves-effect">
                                        <span class="sv-normal submain" set-lan="text:Add Member">Complaint list</span>
                                    </a>
                                </li>

                                {{-- <li id="menuCompany"><a href="{{ route('Company.product') }}" class="waves-effect">
                                    <span class="sv-normal submain" set-lan="text:Add Member">Product List</span></a>
                                </li> --}}

                            </ul>
                        </div>
                    </li>
                    {{-- <li id="menuUser" class="menuMain">
                        <a class="collapsible-header waves-effect arrow-r {{ ($layout_page=='user')?'active':'' }}">
                            <i class="sv-slim-icon fas fa-member"></i>
                            <label set-lan="text:Management" class="main">User</label>
                            <i class="fas fa-angle-down rotate-icon"></i>
                        </a>
                        <div class="collapsible-body">
                            <ul>
                                <li id="menuShareholderAdd"><a href="{{ route('User.add') }}" class="waves-effect">
                                    <span class="sv-normal submain" id="AddItem" set-lan="text:Add Shareholder">Add User</span></a>
                                </li>
                                <li id="menuMemberAdd"><a href="{{ route('User.index') }}" class="waves-effect">
                                    <span class="sv-normal submain" set-lan="text:Add Member">User List</span></a>
                                </li>
                            </ul>
                        </div>
                    </li> --}}

                    {{-- @if( in_array($layoutUser->permission_id, [1]) )
                    <li id="menuDashboard" class="menuMain">
                        <a href="{{ route('ImportCsv.index') }}" class="collapsible-header waves-effect {{ ($layout_page=='import_csv')?'active':'' }}"><i class="sv-slim-icon fas fa-dashboard"></i>
                            <label class="main">Import CSV</label>
                        </a>
                    </li>
                    @endif --}}

                    <li>
                        <a id="toggle" class="waves-effect">
                            <!-- <span set-lan="text:Online" style="color: #fff; float: left;" id="txtOnline">Online :</span> -->
                            <span style="color: #fff; float: left; margin-left: 5px;" id="txtNumOnline"></span>
                            <i class="sv-slim-icon fas fa-angle-double-left"></i>
                        </a>
                    </li>

                </ul>
            </div>
        </li>
        <!--/. Side navigation links -->
    </ul>
    <div class="sidenav-bg rgba-white-strong"></div>
</div>
