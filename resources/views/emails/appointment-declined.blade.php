<x-mail::message>
    @component('mail::message')
    # Appointment Declined
    
    Dear {{ $appointment->patient->first_name }},
    
    We regret to inform you that your appointment has been declined.
    
    **Appointment Details:**
    - **Date:** {{ \Carbon\Carbon::parse($appointment->date)->format('M, d, Y') }}
    - **Time:** {{ \Carbon\Carbon::parse($appointment->time)->format('g:i A') }}
    - **Specialist:** Dr. {{ $appointment->specialist->last_name }}
    
    Please contact us for further assistance or make a new appointment.
    
    Sincerely,  
    {{ config('app.name') }}
    @endcomponent
</x-mail::message>
