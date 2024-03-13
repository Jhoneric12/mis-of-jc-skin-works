<x-mail::message>
    @component('mail::message')
    # Appointment Expired
    
    Dear {{ $appointment->patient->first_name }},
    
    We regret to inform you that your appointment scheduled for {{ \Carbon\Carbon::parse($appointment->date)->format('l, F jS, Y') }} at {{ \Carbon\Carbon::parse($appointment->time)->format('g:i A') }} has expired.
    
    Please contact us to reschedule your appointment or make your new appointment.
    
    Thank you for your understanding.
    
    Sincerely,  
    {{ config('app.name') }}
    @endcomponent
</x-mail::message>
