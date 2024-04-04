<x-mail::message>
    @component('mail::message')
    # Appointment Re-Scheduled
    
    Hello {{ $appointment->patient->first_name }},
    
    We are writing to inform you that your appointment has been re-scheduled by our staff. Here are the updated details:
    
    **Appointment ID:** {{ $appointment->id }}  
    **Service Name:** {{ $appointment->service->service_name }}  
    **Specialist:** Dr. {{ $appointment->specialist->first_name }} {{ $appointment->specialist->last_name }}  
    **Date:** {{\Carbon\Carbon::parse($appointment->date)->format('M, d, Y')}} 
    **Time:** {{\Carbon\Carbon::parse($appointment->time)->format('g: i a')}}
    
    If you have any questions or concerns regarding these changes, please don't hesitate to contact us.
    
    Thank you for choosing our service.
    
    Regards,  
    {{ config('app.name') }}
    @endcomponent
</x-mail::message>
