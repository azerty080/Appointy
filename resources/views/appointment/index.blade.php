@extends('layouts.app')

@section('title', 'Afspraken')


@section('content')


    @if(session()->get('account_type') == 'klant')
        <h1>Gemaakte afspraken</h1>
    @else(session()->get('account_type') == 'business')
        <h1>Afspraken</h1>
    @endif
    
    @php
        $today = Carbon\Carbon::now()->format('Y-m-d');
        $tomorrow = Carbon\Carbon::now()->addDays(1)->format('Y-m-d');
    @endphp
    
    
    <div class="contentDiv">
        @if(session()->get('account_type') == 'klant')

            @php
                $clientCounterToday = 0;
                $clientCounterTomorrow = 0;
                $clientCounterLater = 0;
            @endphp

            
            
            
            <h2>Vandaag {{ Carbon\Carbon::parse($today)->format('d/m/Y') }}</h2>
            @foreach($appointments as $appointment)
            
                @if($appointment->date == $today)
                    
                    <div class="singleAppointment">
                        <h3>{{ $appointment->time }} <a href="{{ route('businessdetail', ['name' => $appointment->business->name, 'id' => $appointment->business->id]) }}">{{ $appointment->business->name }}</a></h3>
                        

                        <p>{{ $appointment->business->user->address }}, {{ $appointment->business->user->township }}</p>
                        
                    
                        <form class="remove-appointment-form" method="POST" action="{{ route('removeappointment') }}">
                            @csrf
                            
                            <input name="appointment_id" type="number" value="{{ $appointment->id }}" hidden>

                            <button type="submit" class="form-control-submit-button">ANNULEER</button>
                            
                        </form>
                    </div>
                    
                    @php $clientCounterToday++ @endphp
                @endif
            @endforeach

            @if($clientCounterToday == 0)
                <p class="no-appointments">U hebt geen afspraken vandaag</p>
            @endif

            


            <h2 class="topmargin">Morgen {{ Carbon\Carbon::parse($tomorrow)->format('d/m/Y') }}</h2>
            @foreach($appointments as $appointment)
                @if($appointment->date == $tomorrow)
                    
                    
                    <div class="singleAppointment">
                        <h3>{{ $appointment->time }} <a href="{{ route('businessdetail', ['name' => $appointment->business->name, 'id' => $appointment->business->id]) }}">{{ $appointment->business->name }}</a></h3>
                        

                        <p>{{ $appointment->business->user->address }}, {{ $appointment->business->user->township }}</p>
                        
                    
                        <form class="remove-appointment-form" method="POST" action="{{ route('removeappointment') }}">
                            @csrf
                            
                            <input name="appointment_id" type="number" value="{{ $appointment->id }}" hidden>

                            <button type="submit" class="form-control-submit-button">ANNULEER</button>
                            
                        </form>
                    </div>
                    
                    @php $clientCounterTomorrow++ @endphp
                @endif
            @endforeach

            @if($clientCounterTomorrow == 0)
                <p class="no-appointments">U hebt geen afspraken morgen</p>
            @endif



            
            <h2 class="topmargin">Latere afspraken</h2>
            @foreach($appointments as $appointment)
                @if($appointment->date > $tomorrow)
                
                    
                    <div class="singleAppointment">
                        <h3>{{ Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }} {{ $appointment->time }} <a href="{{ route('businessdetail', ['name' => $appointment->business->name, 'id' => $appointment->business->id]) }}">{{ $appointment->business->name }}</a></h3>
                        

                        <p>{{ $appointment->business->user->address }}, {{ $appointment->business->user->township }}</p>
                        
                    
                        <form class="remove-appointment-form" method="POST" action="{{ route('removeappointment') }}">
                            @csrf
                            
                            <input name="appointment_id" type="number" value="{{ $appointment->id }}" hidden>

                            <button type="submit" class="form-control-submit-button">ANNULEER</button>
                            
                        </form>
                    </div>
                    
                    @php $clientCounterLater++ @endphp
                @endif
            @endforeach

            @if($clientCounterLater == 0)
                <p class="no-appointments">U hebt geen afspraken meer</p>
            @endif





        @elseif(session()->get('account_type') == 'zaak')

            @php
                $businessCounterToday = 0;
                $businessCounterTomorrow = 0;
                $businessCounterLater = 0;
            @endphp


            <h2>Vandaag {{ Carbon\Carbon::parse($today)->format('d/m/Y') }}</h2>
            @foreach($appointments as $appointment)
            
                @if($appointment->date == $today)

                    @if($appointment->client_id == null)
                        <div class="singleAppointment businessAppointment">
                            <div class="standardClientInfo">
                                <h3>{{ $appointment->time }}</h3>

                                <p>{{ $appointment->firstname }} {{ $appointment->lastname }}</p>
                                <p>Reden: {{ $appointment->details }}</p>

                                <h4 onclick="openDetails({{ $appointment->id }})" class="showMoreDetails">MEER DETAILS</h4>
                                
                                <form class="remove-appointment-form" method="POST" action="{{ route('removeappointment') }}">
                                    @csrf
                                    
                                    <input name="appointment_id" type="number" value="{{ $appointment->id }}" hidden>
                                                        
                                    <button type="submit" class="form-control-submit-button">ANNULEER AFSPRAAK</button>
                                </form>
                            </div>
                            
                            <div class="extraClientInfo hide"  id="appointment{{ $appointment->id }}">
                                <div class="contactInfo">
                                    <p>Email: {{ $appointment->email }}</p>
                                    <p>Tel. {{ $appointment->phonenumber }}</p>
                                </div>

                                <div class="otherInfo">
                                    <p>Geboortejaar: {{ Carbon\Carbon::parse($appointment->birthdate)->format('Y') }}</p>
                                    <p>Adres: {{ $appointment->address }}, {{ $appointment->township }}</p>  
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="singleAppointment businessAppointment">
                            <div class="standardClientInfo">
                                <h3>{{ $appointment->time }}</h3>


                                <p>{{ $appointment->client->firstname }} {{ $appointment->client->lastname }}</p>
                                <p>Reden: {{ $appointment->details }}</p>

                                <h4 onclick="openDetails({{ $appointment->id }})" class="showMoreDetails">MEER DETAILS</h4>

                                <form class="remove-appointment-form" method="POST" action="{{ route('removeappointment') }}">
                                    @csrf
                                    
                                    <input name="appointment_id" type="number" value="{{ $appointment->id }}" hidden>

                                    <button type="submit" class="form-control-submit-button">ANNULEER AFSPRAAK</button>
                                </form>
                            </div>

                            
                            <div class="extraClientInfo hide"  id="appointment{{ $appointment->id }}">
                                <div class="contactInfo">
                                    <p>Email: {{ $appointment->client->user->email }}</p>
                                    <p>Tel. {{ $appointment->client->user->phonenumber }}</p>
                                </div>

                                <div class="otherInfo">
                                    <p>Geboortejaar: {{ Carbon\Carbon::parse($appointment->client->birthdate)->format('Y') }}</p>
                                    <p>Adres: {{ $appointment->client->user->address }}, {{ $appointment->client->user->township }}</p>  
                                </div>
                            </div>
                        </div>
                    @endif
                    
                    
                    @php $businessCounterToday++ @endphp
                @endif
            @endforeach

            @if($businessCounterToday == 0)
                <p class="no-appointments">U hebt geen afspraken vandaag</p>
            @endif

            


            <h2 class="topmargin">Morgen {{ Carbon\Carbon::parse($tomorrow)->format('d/m/Y') }}</h2>
            @foreach($appointments as $appointment)
                @if($appointment->date == $tomorrow)
                    
                    
                @if($appointment->client_id == null)
                    <div class="singleAppointment businessAppointment">
                        <div class="standardClientInfo">
                            <h3>{{ $appointment->time }}</h3>

                            <p>{{ $appointment->firstname }} {{ $appointment->lastname }}</p>
                            <p>Reden: {{ $appointment->details }}</p>

                            <h4 onclick="openDetails({{ $appointment->id }})" class="showMoreDetails">MEER DETAILS</h4>

                            <form class="remove-appointment-form" method="POST" action="{{ route('removeappointment') }}">
                                @csrf
                                
                                <input name="appointment_id" type="number" value="{{ $appointment->id }}" hidden>
                                                    
                                <button type="submit" class="form-control-submit-button">ANNULEER AFSPRAAK</button>
                            </form>
                        </div>

                        <div class="extraClientInfo hide"  id="appointment{{ $appointment->id }}">
                            <div class="contactInfo">
                                <p>Email: {{ $appointment->email }}</p>
                                <p>Tel. {{ $appointment->phonenumber }}</p>
                            </div>

                            <div class="otherInfo">
                                <p>Geboortejaar: {{ Carbon\Carbon::parse($appointment->birthdate)->format('Y') }}</p>
                                <p>Adres: {{ $appointment->address }}, {{ $appointment->township }}</p>  
                            </div>
                        </div>
                    </div>
                @else
                    <div class="singleAppointment businessAppointment">
                        <div class="standardClientInfo">
                            <h3>{{ $appointment->time }}</h3>

                            <p>{{ $appointment->client->firstname }} {{ $appointment->client->lastname }}</p>
                            <p>Reden: {{ $appointment->details }}</p>

                            <h4 onclick="openDetails({{ $appointment->id }})" class="showMoreDetails">MEER DETAILS</h4>

                            <form class="remove-appointment-form" method="POST" action="{{ route('removeappointment') }}">
                                @csrf
                                
                                <input name="appointment_id" type="number" value="{{ $appointment->id }}" hidden>

                                <button type="submit" class="form-control-submit-button">ANNULEER AFSPRAAK</button>
                            </form>
                        </div>

                        
                        <div class="extraClientInfo hide"  id="appointment{{ $appointment->id }}">
                            <div class="contactInfo">
                                <p>Email: {{ $appointment->client->user->email }}</p>
                                <p>Tel. {{ $appointment->client->user->phonenumber }}</p>
                            </div>

                            <div class="otherInfo">
                                <p>Geboortejaar: {{ Carbon\Carbon::parse($appointment->client->birthdate)->format('Y') }}</p>
                                <p>Adres: {{ $appointment->client->user->address }}, {{ $appointment->client->user->township }}</p>  
                            </div>
                        </div>
                    </div>
                @endif
                
                    
                    
                    @php $businessCounterTomorrow++ @endphp
                @endif
            @endforeach

            @if($businessCounterTomorrow == 0)
                <p class="no-appointments">U hebt geen afspraken morgen</p>
            @endif



            
            <h2 class="topmargin">Latere afspraken</h2>
            @foreach($appointments as $appointment)
                @if($appointment->date > $tomorrow)
                
                    
                @if($appointment->client_id == null)
                    <div class="singleAppointment businessAppointment">
                        <div class="standardClientInfo">
                            <h3>{{ Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }} {{ $appointment->time }}</h3>

                            <p>{{ $appointment->firstname }} {{ $appointment->lastname }}</p>
                            <p>Reden: {{ $appointment->details }}</p>

                            <h4 onclick="openDetails({{ $appointment->id }})" class="showMoreDetails">MEER DETAILS</h4>

                            <form class="remove-appointment-form" method="POST" action="{{ route('removeappointment') }}">
                                @csrf
                                
                                <input name="appointment_id" type="number" value="{{ $appointment->id }}" hidden>
                                                    
                                <button type="submit" class="form-control-submit-button">ANNULEER AFSPRAAK</button>
                            </form>
                        </div>
                  
                        <div class="extraClientInfo hide"  id="appointment{{ $appointment->id }}">
                            <div class="contactInfo">
                                <p>Email: {{ $appointment->email }}</p>
                                <p>Tel. {{ $appointment->phonenumber }}</p>
                            </div>

                            <div class="otherInfo">
                                <p>Geboortejaar: {{ Carbon\Carbon::parse($appointment->birthdate)->format('Y') }}</p>
                                <p>Adres: {{ $appointment->address }}, {{ $appointment->township }}</p>  
                            </div>
                        </div>
                    </div>
                @else
                    <div class="singleAppointment businessAppointment">
                        <div class="standardClientInfo">
                            <h3>{{ Carbon\Carbon::parse($appointment->date)->format('d/m/Y') }} {{ $appointment->time }}</h3>

                            <p>{{ $appointment->client->firstname }} {{ $appointment->client->lastname }}</p>
                            <p>Reden: {{ $appointment->details }}</p>

                            <h4 onclick="openDetails({{ $appointment->id }})" class="showMoreDetails">MEER DETAILS</h4>

                            <form class="remove-appointment-form" method="POST" action="{{ route('removeappointment') }}">
                                @csrf
                                
                                <input name="appointment_id" type="number" value="{{ $appointment->id }}" hidden>

                                <button type="submit" class="form-control-submit-button">ANNULEER AFSPRAAK</button>
                            </form>
                        </div>

                        <div class="extraClientInfo hide"  id="appointment{{ $appointment->id }}">
                            <div class="contactInfo">
                                <p>Email: {{ $appointment->client->user->email }}</p>
                                <p>Tel. {{ $appointment->client->user->phonenumber }}</p>
                            </div>

                            <div class="otherInfo">
                                <p>Geboortejaar: {{ Carbon\Carbon::parse($appointment->client->birthdate)->format('Y') }}</p>
                                <p>Adres: {{ $appointment->client->user->address }}, {{ $appointment->client->user->township }}</p>  
                            </div>
                        </div>
                    </div>
                @endif
                
                
                    
                    @php $businessCounterLater++ @endphp
                @endif
            @endforeach

            @if($businessCounterLater == 0)
                <p class="no-appointments">U hebt geen afspraken meer</p>
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