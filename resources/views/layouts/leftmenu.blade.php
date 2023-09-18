<ul class="nav font-weight-bold">
    <li class="{{ 'dashboard' == request()->path() ? 'active' : ''  }}">
        <a href="/dashboard">
            <i class="now-ui-icons design_app"></i>
            <p>Dashboard</p>
        </a>
    </li>
    @if(Auth::user()->usertype == 'admin' || Auth::user()->usertype == 'department_admin' )
        @if(Auth::user()->usertype=='admin')
            <li class="{{ 'departments' == request()->path() ? 'active' : ''  }}" title="Departments">
                <a href="/departments">
                    <i class="now-ui-icons location_map-big"></i>
                    <p>Departments</p>
                </a>
            </li>
        @endif

        <hr style="width: 90%;border-color: rgba(255, 255, 255, 0.5);">
        <li class="{{ 'register/admin' == request()->path() ? 'active' : ''  }}" title="Departments">
            <a href="/register/admin">
                <i class="fa fa-user-plus"></i>
                <p>Register User</p>
            </a>
        </li>
        <li class="{{ 'reports' == request()->path() ? 'active' : ''  }}" title="Departments">
            <a href="{{ route('report.designationWise') }}">
                <i class="now-ui-icons location_map-big"></i>
                <p>Reports</p>
            </a>
        </li>

        @if(auth()->user()->usertype == "department_admin")
            <li class="{{ 'reports/district' == request()->path() ? 'active' : ''  }}" title="Departments">
                <a href="{{ route('report.district',['dep_id'=> auth()->user()->dep_id]) }}">
                    <i class="now-ui-icons location_map-big"></i>
                    <p>Report Designation Wise District</p>
                </a>
            </li>
        @endif

       <li class="{{ 'cadres' == request()->path() ? 'active' : ''  }}" title="Cadres">
            <a href="{{ route('cadres.index') }}">
                  <i class="fa fa-users"></i>
                <p>Cadres</p>
            </a>
        </li>

        @if(auth()->user()->dep_id == 86 || auth()->user()->dep_id == 87 || auth()->user()->dep_id == 88 || auth()->user()->dep_id == 89 || auth()->user()->usertype == 'admin')
        <li class="{{ 'sub-departments.index' == request()->path() ? 'active' : ''  }}" title="Sub Departments">
            <a href="{{ route('sub-departments.index') }}">
                  <i class="fa fa-users"></i>
                <p>Sub Departments</p>
            </a>
        </li>
            @endif


        @if(auth()->user()->usertype == 'department_admin')
            <li class="{{ 'designation.index' == request()->path() ? 'active' : ''  }}" title="Sub Departments">
                <a href="{{ route('designation.index') }}">
                    <i class="fa fa-users"></i>
                    <p>Designation</p>
                </a>
            </li>
        @endif


        <li class="{{ 'employees' == request()->path() ? 'active' : ''  }}">
            <a href="/employees">
                <i class="fas fa-user-tie"></i>
                <p>Employees</p>
            </a>
        </li>
    @endif
    @if(Auth::user()->verified == 1)
        <hr style="width: 90%;border-color: rgba(255, 255, 255, 0.5);">
        <li class="{{ 'employees/'.Auth::user()->id . '/edit' == request()->path() ? 'active' : ''  }}" title="Personal Information">
            <a href="/employees/{{Auth::user()->id}}/edit">
                <i class="now-ui-icons users_circle-08"></i>
                <p>Personal Information</p>
            </a>
        </li>
        <li class="{{ 'employement-details/'.Auth::user()->id . '/edit' == request()->path() ? 'active' : ''  }}" title="Employment Details">
            <a href="/employement-details/{{Auth::user()->id}}/edit">
                <i class="now-ui-icons business_badge"></i>
                <p>Employment Details </p>
            </a>
        </li>
        <li class="{{ 'qualifications/'.Auth::user()->id . '/edit' == request()->path() ? 'active' : ''  }}" title="Academic Qualifications">
            <a href="/qualifications/{{Auth::user()->id}}/edit">
                <i class="now-ui-icons education_hat"></i>
                <p>Academic Qualifications </p>
            </a>
        </li>
        <li class="{{ 'professional_qualifications/'.Auth::user()->id . '/edit' == request()->path() ? 'active' : ''  }}" title="Professional Qualifications">
            <a href="/professional_qualifications/{{Auth::user()->id}}/edit">
                <i class="now-ui-icons business_briefcase-24"></i>
                <p>Professional Qualifications</p>
            </a>
        </li>


        <li class="{{ 'trainings/'.Auth::user()->id . '/edit' == request()->path() ? 'active' : ''  }}" title="Trainings">
            <a href="/trainings/{{Auth::user()->id}}/edit">
                <i class="now-ui-icons business_briefcase-24"></i>
                <p>Trainings</p>
            </a>
        </li>

        @if(Auth::user()->usertype == 'user' && Auth::user()->dep_id == 4 || Auth::user()->usertype == 'admin')
            <li class="{{ 'teaching_details/'.Auth::user()->id == request()->path()  ? 'active' : ''  }}"  title="Teaching Details">
                <a href="/teaching_details/{{Auth::user()->id}}">
                    <i class="now-ui-icons business_bulb-63"></i>
                    <p>Teaching Details</p>
                </a>
            </li>
            <li class="{{ 'result_history/'.Auth::user()->id  == request()->path()? 'active' : ''  }}" title="Result History">
                <a href="/result_history/{{Auth::user()->id}}">
                    <i class="now-ui-icons files_paper"></i>
                    <p>Result History</p>
                </a>
            </li>
        @endif

        <li class="{{ 'promotion_history/'.Auth::user()->id  == request()->path() ? 'active' : ''  }}" title="Promotion History">
            <a href="/promotion_history/{{Auth::user()->id}}">
                <i class="now-ui-icons business_briefcase-24"></i>
                <p>Promotion History</p>
            </a>
        </li>
        <li class="{{ 'transfer_history/'. Auth::user()->id == request()->path() ? 'active' : ''  }}" title="Transfer History">
            <a href="/transfer_history/{{Auth::user()->id}}">
                <i class="now-ui-icons sport_user-run"></i>
                <p>Transfer History</p>
            </a>
        </li>
        <li class="{{ 'employee_profile/'. Auth::user()->id == request()->path() ? 'active' : ''  }}"  title="Profile">
            <a href="/employee_profile/{{ Auth::user()->id}}">
                <i class="now-ui-icons users_single-02"></i>
                <p>Profile</p>
            </a>
        </li>
    @endif
    <hr style="width: 90%;border-color: rgba(255, 255, 255, 0.5);">
    <li class="{{ 'logout' == request()->path() ? 'active' : ''  }}">
        <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
            <i class="now-ui-icons gestures_tap-01"></i>
            <p>Logout</p>
        </a>
    </li>
</ul>
