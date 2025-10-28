@component('mail::message')
# New Contact Form Submission

You have received a new message from your website's contact form.

**From Name:** {{ $data['user_name'] }}
**From Email:** {{ $data['user_email'] }}
**Service Needed:** {{ $data['user_service'] }}
**Message:**
{{ $data['user_message'] }}

---
This email was sent from your website {{ config('app.name') }}.
@endcomponent