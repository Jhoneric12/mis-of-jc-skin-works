<x-mail::message>
    @component('mail::message')

    # Appointment Details
        
    Dear {{ $appointment->first_name }} {{ $appointment->last_name }},
        
    Your appointment has been successfully created. Here are the details:
        
    Service Name: {{ $appointment->service->service_name }}
    Specialist: Dr. {{ $appointment->specialist->first_name . " " . $appointment->specialist->last_name}}
    Date: {{\Carbon\Carbon::parse($appointment->date)->format('M, d, Y')}}
    Time: {{\Carbon\Carbon::parse($appointment->time)->format('g: i a')}}
        
    Thank you for choosing our service.
        
    Thanks,
    {{ config('app.name') }}
    @endcomponent
</x-mail::message>
