@extends('layouts.app')

@section('title', 'Afspraken')


@section('content')

    <h1>Gemaakte afspraken</h1>
    
    <div class="contentDiv">
        @if(session()->get('account_type') == 'klant')

            @php $clientAppointmentCounter = 0; @endphp

            
            <h2 class="leftmargin">Vandaag</h2>
            @foreach($appointments as $appointment)
                @if(!Carbon\Carbon::parse($appointment->date)->isPast())
                    
                    
                    <div class="singleAppointment">
                        <p>{{ Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }} om {{ $appointment->time }}</p>

                        <p>Bij {{ $appointment->business->name }} op {{ $appointment->business->user->address }} te {{ $appointment->business->user->township }}</p>
                        <a href="{{ route('businessdetail', ['name' => $appointment->business->name, 'id' => $appointment->business->id]) }}">{{ $appointment->business->name }}</a>
                    
                    
                        <form class="remove-appointment-form" method="POST" action="{{ route('removeappointment') }}">
                            @csrf
                            
                            <input name="appointment_id" type="number" value="{{ $appointment->id }}" hidden>

                            <div class="form-group">
                                <button type="submit" class="form-control-submit-button">ANNULEER</button>
                            </div>
                        </form>
                    </div>
                    
                    @php $clientAppointmentCounter++ @endphp
                @endif
            @endforeach


            
            <h2 class="topmargin leftmargin">Morgen</h2>
            @foreach($appointments as $appointment)
                @if(!Carbon\Carbon::parse($appointment->date)->isPast())
                    
                    
                    <div class="singleAppointment">
                        <p>{{ Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }} om {{ $appointment->time }}</p>

                        <p>Bij {{ $appointment->business->name }} op {{ $appointment->business->user->address }} te {{ $appointment->business->user->township }}</p>
                        <a href="{{ route('businessdetail', ['name' => $appointment->business->name, 'id' => $appointment->business->id]) }}">{{ $appointment->business->name }}</a>
                    
                    
                        <form class="remove-appointment-form" method="POST" action="{{ route('removeappointment') }}">
                            @csrf
                            
                            <input name="appointment_id" type="number" value="{{ $appointment->id }}" hidden>

                            <div class="form-group">
                                <button type="submit" class="form-control-submit-button">ANNULEER</button>
                            </div>
                        </form>
                    </div>
                    
                    @php $clientAppointmentCounter++ @endphp
                @endif
            @endforeach


            
            <h2 class="topmargin leftmargin">Latere afspraken</h2>




            @foreach($appointments as $appointment)
                @if(!Carbon\Carbon::parse($appointment->date)->isPast())
                    @if($clientTodayCounter == 0)
                        <h2 class="leftmargin">Vandaag</h2>
                        @php $clientTodayCounter++ @endphp
                    @elseif($clientTomorrowCounter == 0)
                        <h2 class="topmargin leftmargin">Morgen</h2>
                        @php $clientTomorrowCounter++ @endphp
                    @elseif($clientLaterCounter == 0)
                        <h2 class="topmargin leftmargin">Later</h2>
                        @php $clientLaterCounter++ @endphp
                    @endif
                    
                    <div class="singleAppointment">
                        <p>{{ Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }} om {{ $appointment->time }}</p>

                        <p>Bij {{ $appointment->business->name }} op {{ $appointment->business->user->address }} te {{ $appointment->business->user->township }}</p>
                        <a href="{{ route('businessdetail', ['name' => $appointment->business->name, 'id' => $appointment->business->id]) }}">{{ $appointment->business->name }}</a>
                    
                    
                        <form class="remove-appointment-form" method="POST" action="{{ route('removeappointment') }}">
                            @csrf
                            
                            <input name="appointment_id" type="number" value="{{ $appointment->id }}" hidden>

                            <div class="form-group">
                                <button type="submit" class="form-control-submit-button">ANNULEER</button>
                            </div>
                        </form>
                    </div>
                    
                    @php $clientAppointmentCounter++ @endphp
                @endif
            @endforeach

            @if($clientAppointmentCounter == 0)
                <p>U hebt geen afspraken meer</p>
            @endif



        @elseif(session()->get('account_type') == 'zaak')
            <h2 class="botmargin">Afspraken als zaak</h2>

            @php
                $businessTodayCounter = 0;
                $businessTomorrowCounter = 0;
                $businessLaterCounter = 0;
                $businessAppointmentCounter = 0
            @endphp


            @foreach($appointments as $appointment)

                @if(!Carbon\Carbon::parse($appointment->date)->isPast())
                    @if($businessTodayCounter == 0)
                        <h2 class="leftmargin">Vandaag</h2>
                        @php $businessTodayCounter++ @endphp
                    @elseif($businessTomorrowCounter == 0)
                        <h2 class="topmargin leftmargin">Morgen</h2>
                        @php $businessTomorrowCounter++ @endphp
                    @elseif($businessLaterCounter == 0)
                        <h2 class="topmargin leftmargin">Later</h2>
                        @php $businessLaterCounter++ @endphp
                    @endif


                    @if($appointment->client_id == null)
                        <div class="singleAppointment">
                            <p>Afspraak op {{ Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }} om {{ $appointment->time }}</p>

                            <p>Met {{ $appointment->firstname }} {{ $appointment->lastname }}</p>
                            <p>Reden: {{ $appointment->details }}</p>

                            <h4 onclick="openDetails({{ $appointment->id }})" class="showMoreDetails">Meer details</h4>

                            <div class="extraClientInfo hide"  id="appointment{{ $appointment->id }}">
                                <p>Geboortedatum: {{ Carbon\Carbon::parse($appointment->birthdate)->format('d/m/Y') }}</p>
                                <p>Email: {{ $appointment->email }}</p>
                                <p>Telefoonnummer: {{ $appointment->phonenumber }}</p>

                                <p>Gemeente: {{ $appointment->township }}</p>
                                <p>Adres: {{ $appointment->address }}</p>   
                            </div>
                            
                            
                            <form class="remove-appointment-form" method="POST" action="{{ route('removeappointment') }}">
                                @csrf
                                
                                <input name="appointment_id" type="number" value="{{ $appointment->id }}" hidden>
                                                   
                                <div class="form-group">
                                    <button type="submit" class="form-control-submit-button">ANNULEER</button>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="singleAppointment">
                            <p>Afspraak op {{ Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }} om {{ $appointment->time }}</p>

                            <p>Met {{ $appointment->client->firstname }} {{ $appointment->client->lastname }}</p>
                            <p>Reden: {{ $appointment->details }}</p>

                            <h4 onclick="openDetails({{ $appointment->id }})" class="showMoreDetails">Meer details</h4>

                            <div class="extraClientInfo hide"  id="appointment{{ $appointment->id }}">
                                <p>Geboortedatum: {{ Carbon\Carbon::parse($appointment->client->birthdate)->format('d/m/Y') }}</p>
                                
                                <p>Email: {{ $appointment->client->user->email }}</p>
                                <p>Telefoonnummer: {{ $appointment->client->user->phonenumber }}</p>

                                <p>Gemeente: {{ $appointment->client->user->township }}</p>
                                <p>Adres: {{ $appointment->client->user->address }}</p>  
                            </div>
                            
                            
                            <form class="remove-appointment-form" method="POST" action="{{ route('removeappointment') }}">
                                @csrf
                                
                                <input name="appointment_id" type="number" value="{{ $appointment->id }}" hidden>
                                                   
                                <div class="form-group">
                                    <button type="submit" class="form-control-submit-button">ANNULEER</button>
                                </div>
                            </form>
                        </div>
                    @endif

                    @php $businessAppointmentCounter++ @endphp
                @endif

            @endforeach
            
            @if($businessAppointmentCounter == 0)
                <p>U hebt geen afspraken meer</p>
            @endif

        @else
            <p>Je moet ingelogd zijn om je afspraken te bekijken</p>
        @endif
    </div>    

@stop





@section('script')
    
    <script>
        
        function openDetails(id) {
            var div = document.getElementById("appointment" + id);

            div.classList.toggle('hide');
        }


        function showForm(id) {
            var div = document.getElementById("form" + id);

            div.classList.toggle('hide');
        }
        
        function clickedNo(id) {
            var div = document.getElementById("form" + id);

            div.classList.toggle('hide');
        }
    </script>
    
@stop