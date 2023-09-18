@if((auth()->user()->usertype == 'department_admin' || auth()->user()->usertype == 'admin') && $ed->verified != 1)
    <a href="{{url($link . $ed->id )}}" class="btn btn-outline-warning btn-sm" title="Not Verified: Click to verify."><i class="fa fa-user-check"></i> Verify</a>
@elseif((auth()->user()->usertype == 'department_admin' || auth()->user()->usertype == 'admin') && $ed->verified == 1)
    <a href="javascript:;" class="btn btn-outline-success btn-sm" title="Verified"><i class="fa fa-user-check"></i> Verified</a>
@endif
@if(auth()->user()->usertype == 'user' && $ed->verified != 1)
    <a href="javascript:;" class="btn btn-outline-warning btn-sm"> Not Verified</a>
@elseif(auth()->user()->usertype == 'user' && $ed->verified == 1)
    <a href="javascript:;" class="btn btn-outline-success btn-sm"><i class="fa fa-user-check"></i> Verified</a>
@endif
