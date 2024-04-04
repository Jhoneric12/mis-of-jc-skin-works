@component('mail::message')

# Reminder: Appointment Tomorrow

Dear {{ $appointment->patient->first_name }},

This is a reminder that you have an appointment scheduled for tomorrow.

Appointment Details:
- Date: {{ \Carbon\Carbon::parse($appointment->date)->format('M, d, Y') }}
- Time: {{ \Carbon\Carbon::parse($appointment->time)->format('g: i a') }}
- Service: {{ $appointment->service->service_name }}
- Specialist: Dr. {{ $appointment->specialist->first_name . " " . $appointment->specialist->last_name }}

Please ensure that you arrive on time for your appointment.

Thank you.

Regards,<br>
{{ config('app.name') }}

@endcomponent
