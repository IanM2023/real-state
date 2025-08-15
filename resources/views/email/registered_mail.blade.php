@component('mail::message')

Hi, {{ $save->username }} . Please new account password set

<p>It happens, Click the link below...</p>
    
@component('mail::button', ['url' => url('set_new_password/'. $save->remember_token)])
    Set Your Password
@endcomponent

Thank you.
    
@endcomponent