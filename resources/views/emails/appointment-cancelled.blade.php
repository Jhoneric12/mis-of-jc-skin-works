@component('mail::message')

# Appointment Cancelled

Dear {{ $appointment->patient->first_name }},

We regret to inform you that your appointment scheduled for {{ \Carbon\Carbon::parse($appointment->date)->format('M, d, Y') }} at {{ \Carbon\Carbon::parse($appointment->time)->format('g: i a') }} with Dr. {{ $appointment->specialist->first_name . " " . $appointment->specialist->last_name }} has been canceled by our staff.

Please contact our reception to reschedule your appointment or make a new appointment at your earliest convenience.

Thank you for your understanding.

Regards,<br>
{{ config('app.name') }}

@endcomponent
