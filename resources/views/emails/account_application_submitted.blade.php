@component('mail::message')
# Account Application Submitted

Dear {{ $application->first_name }} {{ $application->last_name }},

Thank you for submitting your account opening application. Your tracking number is:

**{{ $trackingNumber }}**

We have received your application and our team will review it shortly. You will be notified of any updates via email.

If you have any questions, please reply to this email.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
