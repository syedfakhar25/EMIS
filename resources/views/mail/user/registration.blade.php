@component('mail::message')
# New user has been register

Name: {{$user->first_name . ' ' . $user->middle_name . ' '. $user->last_name}}<br>
Registration Status: Pending <br>
Department: {{$user->department->dep_name}}

Please login to EMIS and verify the above user.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
