<div class="sidebar" data-color="purple" data-background-color="white" data-image="/assets/img/sidebar-1.jpg">

    <div class="logo"><a href="/dashboard" class="simple-text logo-normal">
            Easy Verify
        </a></div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="nav-item @if(isset($active)) @if($active == "dashboard")active @endif  @endif   ">
                <a class="nav-link" href="{{route("showDashboard")}}">
                    <i class="material-icons">dashboard</i>
                    <p>Dashboard</p>
                </a>
            </li>

            @if(Auth::user()->level == 1)
            <li class="nav-item  @if(isset($active)) @if($active == "users")active @endif  @endif  ">
                <a class="nav-link" href="{{route("allUsers")}}">
                    <i class="fa fa-users"></i>
                    <p>All Users</p>
                </a>
            </li>
                <li class="nav-item  @if(isset($active)) @if($active == "sales")active @endif  @endif  ">
                <a class="nav-link" href="#">
                    <i class="fa fa-money"></i>
                    <p>Sales</p>
                </a>
            </li>

            @endif


            @if(Auth::user()->level == 2)
                <li class="nav-item  @if(isset($active)) @if($active == "organisation")active @endif  @endif  ">
                    <a class="nav-link" href="{{route("showCreateOrganisation")}}">
                        <i class="fa fa-plus"></i>
                        <p>Create Organisation</p>
                    </a>
                </li>
                <li class="nav-item  @if(isset($active)) @if($active == "vieworganisation")active @endif  @endif  ">
                    <a class="nav-link" href="{{route("showAllOrganisations")}}">
                        <i class="fa fa-users"></i>
                        <p>View Organisation</p>
                    </a>
                </li>

                <li class="nav-item  @if(isset($active)) @if($active == "payment")active @endif  @endif  ">
                    <a class="nav-link" href="{{route("loadPaymentScreen")}}">
                        <i class="fa fa-money"></i>
                        <p>Buy Units</p>
                    </a>
                </li>
            @endif


            <li class="nav-item  @if(isset($active)) @if($active == "verify")active @endif  @endif  ">
                <a class="nav-link" href="{{route("loadVerification")}}">
                    <i class="material-icons">person</i>
                    <p>Verify</p>
                </a>
            </li>



            <li class="nav-item @if(isset($active)) @if($active == "logs")active @endif  @endif ">
                <a class="nav-link" href="{{route("showLog")}}">
                    <i class="material-icons">location_ons</i>
                    <p>logs</p>
                </a>
            </li>

            <li class="nav-item @if(isset($active)) @if($active == "topup")active @endif  @endif ">
                <a class="nav-link" href="{{route("TopLog")}}">
                    <i class="material-icons">location_ons</i>
                    <p>Top Up logs</p>
                </a>
            </li>
            <li class="nav-item  @if(isset($active)) @if($active == "settings")active @endif  @endif  ">
                <a class="nav-link" href="{{route("changePassword")}}">
                    <i class="material-icons">settings</i>
                    <p>Settings</p>
                </a>
            </li>

            <li class="nav-item active-pro ">
                <a class="nav-link" href="{{route("logout")}}">
                    <i class="fa fa-key"></i>
                    <p>Logout</p>
                </a>
            </li>

        </ul>
    </div>
</div>