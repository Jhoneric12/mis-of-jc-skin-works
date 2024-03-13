<x-mail::message>
    @component('mail::message')
    # Appointment Approved
    
    Dear {{ $appointment->patient->first_name }},
    
    We are pleased to inform you that your appointment has been approved.
    
    Appointment Details:
    - Date:{{ \Carbon\Carbon::parse($appointment->date)->format('M, d, Y') }}
    - Time: {{ \Carbon\Carbon::parse($appointment->time)->format('g:i A') }}
    - Specialist: Dr. {{ $appointment->specialist->last_name }}
    
    Thank you for choosing our service.
    
    Sincerely,  
    {{ config('app.name') }}
    @endcomponent
</x-mail::message>
