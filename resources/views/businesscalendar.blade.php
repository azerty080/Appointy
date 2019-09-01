@extends('layouts.app')

@section('title', 'Kalender')


@section('content')


    <div class="contentDiv">

        <h1 class="calendarWeek">
            @if($addedweeks != 0)<a href="{{ route('businesscalendar', ['name' => $name, 'id' => $id, 'addedweek' => $addedweeks - 1]) }}"><</a>@endif
            {{ Carbon\Carbon::now()->addWeek($addedweeks)->startOfWeek()->format('d/m/Y') }} - {{ Carbon\Carbon::now()->addWeek($addedweeks)->endOfWeek()->format('d/m/Y') }}
            <a href="{{ route('businesscalendar', ['name' => $name, 'id' => $id, 'addedweek' => $addedweeks + 1]) }}">></a>
        </h1>
    
        
        @php $today = Carbon\Carbon::now()->addHours(1) @endphp

        @php
            $mondaydate = Carbon\Carbon::now()->addWeek($addedweeks)->startOfWeek();
            $tuesdaydate = Carbon\Carbon::now()->addWeek($addedweeks)->startOfWeek()->addDays(1);
            $wednesdaydate = Carbon\Carbon::now()->addWeek($addedweeks)->startOfWeek()->addDays(2);
            $thursdaydate = Carbon\Carbon::now()->addWeek($addedweeks)->startOfWeek()->addDays(3);
            $fridaydate = Carbon\Carbon::now()->addWeek($addedweeks)->startOfWeek()->addDays(4);
            $saturdaydate = Carbon\Carbon::now()->addWeek($addedweeks)->startOfWeek()->addDays(5);
            $sundaydate = Carbon\Carbon::now()->addWeek($addedweeks)->startOfWeek()->addDays(6);
        @endphp


        <table class="calendar fullcalendar">
            <thead>
                <tr>
                    <th></th>
                    
                    <th>Ma {{ $mondaydate->format('d/m') }}</th>
                    <th>Di {{ $tuesdaydate->format('d/m') }}</th>
                    <th>Wo {{ $wednesdaydate->format('d/m') }}</th>
                    <th>Do {{ $thursdaydate->format('d/m') }}</th>
                    <th>Vr {{ $fridaydate->format('d/m') }}</th>
                    <th>Za {{ $saturdaydate->format('d/m') }}</th>
                    <th>Zo {{ $sundaydate->format('d/m') }}</th>
                </tr>
            </thead>

            <tbody>
                
                @for($i = $earliesthour; $i < $latesthour; $i += $appointmentduration)
                    @php
                        $startofweek = Carbon\Carbon::now()->addWeek($addedweeks)->startOfWeek();


                        $rowhour = floor($i/60);
                        $rowmin = $i%60;
                        
                        if($rowhour < 10) {
                            $rowhour = '0' . $rowhour;
                        }

                        if($rowmin == 0) {
                            $rowmin = '00';
                        }

                        $rowtime = Carbon\Carbon::parse($rowhour . ':' . $rowmin);

                    @endphp
                    
                    <tr>
                        <td class="hour">{{ $rowtime->format('H:i') }}</td>

                        <td
                            @if((($mondaydate->isToday() && $today->lte($rowtime)) || $mondaydate->isFuture()) && !in_array($i, $mondayhours))
                                @if(count($monday) == 1)
                                    @if(!$monday[0]->closed)
                                        @if($monday[0]->opentime_in_min <= $i && $i < $monday[0]->closetime_in_min)
                                            class="available">

                                            <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                                @csrf

                                                <input name="id" type="number" value="{{ $id }}" hidden>
                                                
                                                <input name="name" type="text" value="{{ $name }}" hidden>
                                                
                                                <input name="day" type="date" value="{{ $mondaydate->format('Y-m-d') }}" hidden>
                                                
                                                <input name="time" type="number" value="{{ $i }}" hidden>
                                                
                                                <button type="submit">Boek afspraak</button>
                                            </form>
                                        @else
                                            class="closed"><p>gesloten</p>
                                        @endif
                                    @else
                                        class="closed"><p>gesloten</p>
                                    @endif
                                @else
                                    @if(($monday[0]->opentime_in_min <= $i && $i < $monday[0]->closetime_in_min) || ($monday[1]->opentime_in_min <= $i && $i < $monday[1]->closetime_in_min))
                                        class="available"> 
                                
                                        <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                            @csrf

                                            <input name="id" type="number" value="{{ $id }}" hidden>
                                            
                                            <input name="name" type="text" value="{{ $name }}" hidden>
                                            
                                            <input name="day" type="date" value="{{ $mondaydate->format('Y-m-d') }}" hidden>
                                            
                                            <input name="time" type="number" value="{{ $i }}" hidden>
                                            
                                            <button type="submit">Boek afspraak</button>
                                        </form>
                                    @else
                                        class="closed"><p>gesloten</p>
                                    @endif
                                @endif
                            
                            @elseif(($mondaydate->isToday() && $today > $rowtime) || $mondaydate->format('Y-m-d') < $today->format('Y-m-d'))
                                class="past">
                            @elseif(in_array($i, $mondayhours))
                                class="occupied"><p>bezet</p>
                            @else
                                class="past">
                            @endif
                        </td>

                        <td
                            @if((($tuesdaydate->isToday() && $today->lte($rowtime)) || $tuesdaydate->isFuture()) && !in_array($i, $tuesdayhours))
                                @if(count($tuesday) == 1)
                                    @if(!$tuesday[0]->closed)
                                        @if($tuesday[0]->opentime_in_min <= $i && $i < $tuesday[0]->closetime_in_min)
                                            class="available"> 

                                            <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                                @csrf

                                                <input name="id" type="number" value="{{ $id }}" hidden>
                                                
                                                <input name="name" type="text" value="{{ $name }}" hidden>
                                                
                                                <input name="day" type="date" value="{{ $tuesdaydate->format('Y-m-d') }}" hidden>
                                                
                                                <input name="time" type="number" value="{{ $i }}" hidden>
                                                
                                                <button type="submit">Boek afspraak</button>
                                            </form>
                                        @else
                                            class="closed"><p>gesloten</p>
                                        @endif
                                    @else
                                        class="closed"><p>gesloten</p>
                                    @endif
                                @else
                                    @if(($tuesday[0]->opentime_in_min <= $i && $i < $tuesday[0]->closetime_in_min) || ($tuesday[1]->opentime_in_min <= $i && $i < $tuesday[1]->closetime_in_min))
                                        class="available">

                                        <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                            @csrf

                                            <input name="id" type="number" value="{{ $id }}" hidden>
                                            
                                            <input name="name" type="text" value="{{ $name }}" hidden>
                                            
                                            <input name="day" type="date" value="{{ $tuesdaydate->format('Y-m-d') }}" hidden>
                                            
                                            <input name="time" type="number" value="{{ $i }}" hidden>
                                            
                                            <button type="submit">Boek afspraak</button>
                                        </form>
                                    @else
                                        class="closed"><p>gesloten</p>
                                    @endif
                                @endif
                            
                            @elseif(($tuesdaydate->isToday() && $today > $rowtime) || $tuesdaydate->format('Y-m-d') < $today->format('Y-m-d'))
                                class="past">
                            @elseif(in_array($i, $tuesdayhours))
                                class="occupied"><p>bezet</p>
                            @else
                                class="past">
                            @endif
                        </td>
                        
                        <td
                            @if((($wednesdaydate->isToday() && $today->lte($rowtime)) || $wednesdaydate->isFuture()) && !in_array($i, $wednesdayhours))
                                @if(count($wednesday) == 1)
                                    @if(!$wednesday[0]->closed)
                                        @if($wednesday[0]->opentime_in_min <= $i && $i < $wednesday[0]->closetime_in_min)
                                            class="available">

                                            <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                                @csrf

                                                <input name="id" type="number" value="{{ $id }}" hidden>
                                                
                                                <input name="name" type="text" value="{{ $name }}" hidden>
                                                
                                                <input name="day" type="date" value="{{ $wednesdaydate->format('Y-m-d') }}" hidden>
                                                
                                                <input name="time" type="number" value="{{ $i }}" hidden>
                                                
                                                <button type="submit">Boek afspraak</button>
                                            </form>
                                        @else
                                            class="closed"><p>gesloten</p>
                                        @endif
                                    @else
                                        class="closed"><p>gesloten</p>
                                    @endif
                                @else
                                    @if(($wednesday[0]->opentime_in_min <= $i && $i < $wednesday[0]->closetime_in_min) || ($wednesday[1]->opentime_in_min <= $i && $i < $wednesday[1]->closetime_in_min))
                                        class="available">

                                        <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                            @csrf

                                            <input name="id" type="number" value="{{ $id }}" hidden>
                                            
                                            <input name="name" type="text" value="{{ $name }}" hidden>
                                            
                                            <input name="day" type="date" value="{{ $wednesdaydate->format('Y-m-d') }}" hidden>
                                            
                                            <input name="time" type="number" value="{{ $i }}" hidden>
                                            
                                            <button type="submit">Boek afspraak</button>
                                        </form>
                                    @else
                                        class="closed"><p>gesloten</p>
                                    @endif
                                @endif
                            
                            @elseif(($wednesdaydate->isToday() && $today > $rowtime) || $wednesdaydate->format('Y-m-d') < $today->format('Y-m-d'))
                                class="past">
                            @elseif(in_array($i, $wednesdayhours))
                                class="occupied"><p>bezet</p>
                            @else
                                class="past">
                            @endif
                        </td>

                        <td
                            @if((($thursdaydate->isToday() && $today->lte($rowtime)) || $thursdaydate->isFuture()) && !in_array($i, $thursdayhours))
                                @if(count($thursday) == 1)
                                    @if(!$thursday[0]->closed)
                                        @if($thursday[0]->opentime_in_min <= $i && $i < $thursday[0]->closetime_in_min)
                                            class="available">
                   
                                            <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                                @csrf

                                                <input name="id" type="number" value="{{ $id }}" hidden>
                                                
                                                <input name="name" type="text" value="{{ $name }}" hidden>
                                                
                                                <input name="day" type="date" value="{{ $thursdaydate->format('Y-m-d') }}" hidden>
                                                
                                                <input name="time" type="number" value="{{ $i }}" hidden>
                                                
                                                <button type="submit">Boek afspraak</button>
                                            </form>
                                        @else
                                            class="closed"><p>gesloten</p>
                                        @endif
                                    @else
                                        class="closed"><p>gesloten</p>
                                    @endif
                                @else
                                    @if(($thursday[0]->opentime_in_min <= $i && $i < $thursday[0]->closetime_in_min) || ($thursday[1]->opentime_in_min <= $i && $i < $thursday[1]->closetime_in_min))
                                        class="available">
                        
                                        <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                            @csrf

                                            <input name="id" type="number" value="{{ $id }}" hidden>
                                            
                                            <input name="name" type="text" value="{{ $name }}" hidden>
                                            
                                            <input name="day" type="date" value="{{ $thursdaydate->format('Y-m-d') }}" hidden>
                                            
                                            <input name="time" type="number" value="{{ $i }}" hidden>
                                            
                                            <button type="submit">Boek afspraak</button>
                                        </form>
                                    @else
                                        class="closed"><p>gesloten</p>
                                    @endif
                                @endif
                            
                            @elseif(($thursdaydate->isToday() && $today > $rowtime) || $thursdaydate->format('Y-m-d') < $today->format('Y-m-d'))
                                class="past">
                            @elseif(in_array($i, $thursdayhours))
                                class="occupied"><p>bezet</p>
                            @else
                                class="past">
                            @endif
                        </td>

                        <td
                            @if((($fridaydate->isToday() && $today->lte($rowtime)) || $fridaydate->isFuture()) && !in_array($i, $fridayhours))
                                @if(count($friday) == 1)
                                    @if(!$friday[0]->closed)
                                        @if($friday[0]->opentime_in_min <= $i && $i < $friday[0]->closetime_in_min)
                                            class="available">
                               
                                            <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                                @csrf

                                                <input name="id" type="number" value="{{ $id }}" hidden>
                                                
                                                <input name="name" type="text" value="{{ $name }}" hidden>
                                                
                                                <input name="day" type="date" value="{{ $fridaydate->format('Y-m-d') }}" hidden>
                                                
                                                <input name="time" type="number" value="{{ $i }}" hidden>
                                                
                                                <button type="submit">Boek afspraak</button>
                                            </form>
                                        @else
                                            class="closed"><p>gesloten</p>
                                        @endif
                                    @else
                                        class="closed"><p>gesloten</p>
                                    @endif
                                @else
                                    @if(($friday[0]->opentime_in_min <= $i && $i < $friday[0]->closetime_in_min) || ($friday[1]->opentime_in_min <= $i && $i < $friday[1]->closetime_in_min))
                                        class="available">
                        
                                        <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                            @csrf

                                            <input name="id" type="number" value="{{ $id }}" hidden>
                                            
                                            <input name="name" type="text" value="{{ $name }}" hidden>
                                            
                                            <input name="day" type="date" value="{{ $fridaydate->format('Y-m-d') }}" hidden>
                                            
                                            <input name="time" type="number" value="{{ $i }}" hidden>
                                            
                                            <button type="submit">Boek afspraak</button>
                                        </form>
                                    @else
                                        class="closed"><p>gesloten</p>
                                    @endif
                                @endif
                            
                            @elseif(($fridaydate->isToday() && $today > $rowtime) || $fridaydate->format('Y-m-d') < $today->format('Y-m-d'))
                                class="past">
                            @elseif(in_array($i, $fridayhours))
                                class="occupied"><p>bezet</p>
                            @else
                                class="past">
                            @endif
                        </td>

                        <td
                            @if((($saturdaydate->isToday() && $today->lte($rowtime)) || $saturdaydate->isFuture()) && !in_array($i, $saturdayhours))
                                @if(count($saturday) == 1)
                                    @if(!$saturday[0]->closed)
                                        @if($saturday[0]->opentime_in_min <= $i && $i < $saturday[0]->closetime_in_min)
                                            class="available">
                                 
                                            <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                                @csrf

                                                <input name="id" type="number" value="{{ $id }}" hidden>
                                                
                                                <input name="name" type="text" value="{{ $name }}" hidden>
                                                
                                                <input name="day" type="date" value="{{ $saturdaydate->format('Y-m-d') }}" hidden>
                                                
                                                <input name="time" type="number" value="{{ $i }}" hidden>
                                                
                                                <button type="submit">Boek afspraak</button>
                                            </form>
                                        @else
                                            class="closed"><p>gesloten</p>
                                        @endif
                                    @else
                                        class="closed"><p>gesloten</p>
                                    @endif
                                @else
                                    @if(($saturday[0]->opentime_in_min <= $i && $i < $saturday[0]->closetime_in_min) || ($saturday[1]->opentime_in_min <= $i && $i < $saturday[1]->closetime_in_min))
                                        class="available">
                            
                                        <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                            @csrf

                                            <input name="id" type="number" value="{{ $id }}" hidden>
                                            
                                            <input name="name" type="text" value="{{ $name }}" hidden>
                                            
                                            <input name="day" type="date" value="{{ $saturdaydate->format('Y-m-d') }}" hidden>
                                            
                                            <input name="time" type="number" value="{{ $i }}" hidden>
                                            
                                            <button type="submit">Boek afspraak</button>
                                        </form>
                                    @else
                                        class="closed"><p>gesloten</p>
                                    @endif
                                @endif
                            
                            @elseif(($saturdaydate->isToday() && $today > $rowtime) || $saturdaydate->format('Y-m-d') < $today->format('Y-m-d'))
                                class="past">
                            @elseif(in_array($i, $saturdayhours))
                                class="occupied"><p>bezet</p>
                            @else
                                class="past">
                            @endif
                        </td>

                        <td
                            @if((($sundaydate->isToday() && $today->lte($rowtime)) || $sundaydate->isFuture()) && !in_array($i, $sundayhours))
                                @if(count($sunday) == 1)
                                    @if(!$sunday[0]->closed)
                                        @if($sunday[0]->opentime_in_min <= $i && $i < $sunday[0]->closetime_in_min)
                                            class="available">
                               
                                            <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                                @csrf

                                                <input name="id" type="number" value="{{ $id }}" hidden>
                                                
                                                <input name="name" type="text" value="{{ $name }}" hidden>
                                                
                                                <input name="day" type="date" value="{{ $sundaydate->format('Y-m-d') }}" hidden>
                                                
                                                <input name="time" type="number" value="{{ $i }}" hidden>
                                                
                                                <button type="submit">Boek afspraak</button>
                                            </form>
                                        @else
                                            class="closed"><p>gesloten</p>
                                        @endif
                                    @else
                                        class="closed"><p>gesloten</p>
                                    @endif
                                @else
                                    @if(($sunday[0]->opentime_in_min <= $i && $i < $sunday[0]->closetime_in_min) || ($sunday[1]->opentime_in_min <= $i && $i < $sunday[1]->closetime_in_min))
                                        class="available">
                            
                                        <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                            @csrf

                                            <input name="id" type="number" value="{{ $id }}" hidden>
                                            
                                            <input name="name" type="text" value="{{ $name }}" hidden>
                                            
                                            <input name="day" type="date" value="{{ $sundaydate->format('Y-m-d') }}" hidden>
                                            
                                            <input name="time" type="number" value="{{ $i }}" hidden>
                                            
                                            <button type="submit">Boek afspraak</button>
                                        </form>
                                    @else
                                        class="closed"><p>gesloten</p>
                                    @endif
                                @endif
                            
                            @elseif(($sundaydate->isToday() && $today > $rowtime) || $sundaydate->format('Y-m-d') < $today->format('Y-m-d'))
                                class="past">
                            @elseif(in_array($i, $sundayhours))
                                class="occupied"><p>bezet</p>
                            @else
                                class="past">
                            @endif
                        </td>


                    </tr>
                    
                @endfor
            </tbody>

        </table>


        

        
        @php $today = Carbon\Carbon::now()->addHours(1) @endphp

        @php
            $calendardate = Carbon\Carbon::now()->addDays($addedweeks);
        @endphp
        
        <h1 class="calendarDay">
            @if($addedweeks != 0)<a href="{{ route('businesscalendar', ['name' => $name, 'id' => $id, 'addedweek' => $addedweeks - 1]) }}"><</a>@endif

            @switch($calendardate->dayOfWeek)
                @case(1)
                    Ma 
                    @break

                @case(2)
                    Di 
                    @break

                @case(3)
                    Wo 
                    @break

                @case(4)
                    Do 
                    @break

                @case(5)
                    Vr 
                    @break

                @case(6)
                    Za 
                    @break

                @case(0)
                    Zo 
                    @break
            @endswitch

            {{ Carbon\Carbon::now()->addDays($addedweeks)->format('d/m') }}
            
            <a href="{{ route('businesscalendar', ['name' => $name, 'id' => $id, 'addedweek' => $addedweeks + 1]) }}">></a>
        </h1>



        

        <table class="calendar mobilecalendar">
            <thead>
                <tr>
                    <th></th>
                    
                    <th>
                        @switch($calendardate->dayOfWeek)
                            @case(1)
                                Ma
                                @break

                            @case(2)
                                Di
                                @break

                            @case(3)
                                Wo
                                @break

                            @case(4)
                                Do
                                @break

                            @case(5)
                                Vr
                                @break

                            @case(6)
                                Za
                                @break

                            @case(0)
                                Zo
                                @break
                        @endswitch
                            
                        {{ $calendardate->format('d/m') }}
                    </th>


                </tr>
            </thead>

            <tbody>
                
                @for($i = $earliesthour; $i < $latesthour; $i += $appointmentduration)
                    @php
                        $startofweek = Carbon\Carbon::now()->addDays($addedweeks);


                        $rowhour = floor($i/60);
                        $rowmin = $i%60;
                        
                        if($rowhour < 10) {
                            $rowhour = '0' . $rowhour;
                        }

                        if($rowmin == 0) {
                            $rowmin = '00';
                        }

                        $rowtime = Carbon\Carbon::parse($rowhour . ':' . $rowmin);

                    @endphp
                    
                    <tr>
                        <td class="hour">{{ $rowtime->format('H:i') }}</td>

                        @switch($calendardate->dayOfWeek)
                            @case(1)
                                <td
                                    @if((($calendardate->isToday() && $today->lte($rowtime)) || $calendardate->isFuture()) && !in_array($i, $mondayhours))
                                        @if(count($monday) == 1)
                                            @if(!$monday[0]->closed)
                                                @if($monday[0]->opentime_in_min <= $i && $i < $monday[0]->closetime_in_min)
                                                    class="available">

                                                    <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                                        @csrf

                                                        <input name="id" type="number" value="{{ $id }}" hidden>
                                                        
                                                        <input name="name" type="text" value="{{ $name }}" hidden>
                                                        
                                                        <input name="day" type="date" value="{{ $calendardate->format('Y-m-d') }}" hidden>
                                                        
                                                        <input name="time" type="number" value="{{ $i }}" hidden>
                                                        
                                                        <button type="submit">Boek afspraak</button>
                                                    </form>
                                                @else
                                                    class="closed"><p>gesloten</p>
                                                @endif
                                            @else
                                                class="closed"><p>gesloten</p>
                                            @endif
                                        @else
                                            @if(($monday[0]->opentime_in_min <= $i && $i < $monday[0]->closetime_in_min) || ($monday[1]->opentime_in_min <= $i && $i < $monday[1]->closetime_in_min))
                                                class="available"> 
                                        
                                                <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                                    @csrf

                                                    <input name="id" type="number" value="{{ $id }}" hidden>
                                                    
                                                    <input name="name" type="text" value="{{ $name }}" hidden>
                                                    
                                                    <input name="day" type="date" value="{{ $calendardate->format('Y-m-d') }}" hidden>
                                                    
                                                    <input name="time" type="number" value="{{ $i }}" hidden>
                                                    
                                                    <button type="submit">Boek afspraak</button>
                                                </form>
                                            @else
                                                class="closed"><p>gesloten</p>
                                            @endif
                                        @endif
                                    
                                    @elseif(($calendardate->isToday() && $today > $rowtime) || $calendardate->format('Y-m-d') < $today->format('Y-m-d'))
                                        class="past">
                                    @elseif(in_array($i, $mondayhours))
                                        class="occupied"><p>bezet</p>
                                    @else
                                        class="past">
                                    @endif
                                </td>
                                @break



                            @case(2)
                                <td
                                    @if((($calendardate->isToday() && $today->lte($rowtime)) || $calendardate->isFuture()) && !in_array($i, $tuesdayhours))
                                        @if(count($tuesday) == 1)
                                            @if(!$tuesday[0]->closed)
                                                @if($tuesday[0]->opentime_in_min <= $i && $i < $tuesday[0]->closetime_in_min)
                                                    class="available"> 

                                                    <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                                        @csrf

                                                        <input name="id" type="number" value="{{ $id }}" hidden>
                                                        
                                                        <input name="name" type="text" value="{{ $name }}" hidden>
                                                        
                                                        <input name="day" type="date" value="{{ $calendardate->format('Y-m-d') }}" hidden>
                                                        
                                                        <input name="time" type="number" value="{{ $i }}" hidden>
                                                        
                                                        <button type="submit">Boek afspraak</button>
                                                    </form>
                                                @else
                                                    class="closed"><p>gesloten</p>
                                                @endif
                                            @else
                                                class="closed"><p>gesloten</p>
                                            @endif
                                        @else
                                            @if(($tuesday[0]->opentime_in_min <= $i && $i < $tuesday[0]->closetime_in_min) || ($tuesday[1]->opentime_in_min <= $i && $i < $tuesday[1]->closetime_in_min))
                                                class="available">

                                                <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                                    @csrf

                                                    <input name="id" type="number" value="{{ $id }}" hidden>
                                                    
                                                    <input name="name" type="text" value="{{ $name }}" hidden>
                                                    
                                                    <input name="day" type="date" value="{{ $calendardate->format('Y-m-d') }}" hidden>
                                                    
                                                    <input name="time" type="number" value="{{ $i }}" hidden>
                                                    
                                                    <button type="submit">Boek afspraak</button>
                                                </form>
                                            @else
                                                class="closed"><p>gesloten</p>
                                            @endif
                                        @endif
                                    
                                    @elseif(($calendardate->isToday() && $today > $rowtime) || $calendardate->format('Y-m-d') < $today->format('Y-m-d'))
                                        class="past">
                                    @elseif(in_array($i, $tuesdayhours))
                                        class="occupied"><p>bezet</p>
                                    @else
                                        class="past">
                                    @endif
                                </td>
                                @break
                                


                                                                
                            @case(3)
                                <td
                                    @if((($calendardate->isToday() && $today->lte($rowtime)) || $calendardate->isFuture()) && !in_array($i, $wednesdayhours))
                                        @if(count($wednesday) == 1)
                                            @if(!$wednesday[0]->closed)
                                                @if($wednesday[0]->opentime_in_min <= $i && $i < $wednesday[0]->closetime_in_min)
                                                    class="available">

                                                    <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                                        @csrf

                                                        <input name="id" type="number" value="{{ $id }}" hidden>
                                                        
                                                        <input name="name" type="text" value="{{ $name }}" hidden>
                                                        
                                                        <input name="day" type="date" value="{{ $calendardate->format('Y-m-d') }}" hidden>
                                                        
                                                        <input name="time" type="number" value="{{ $i }}" hidden>
                                                        
                                                        <button type="submit">Boek afspraak</button>
                                                    </form>
                                                @else
                                                    class="closed"><p>gesloten</p>
                                                @endif
                                            @else
                                                class="closed"><p>gesloten</p>
                                            @endif
                                        @else
                                            @if(($wednesday[0]->opentime_in_min <= $i && $i < $wednesday[0]->closetime_in_min) || ($wednesday[1]->opentime_in_min <= $i && $i < $wednesday[1]->closetime_in_min))
                                                class="available">

                                                <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                                    @csrf

                                                    <input name="id" type="number" value="{{ $id }}" hidden>
                                                    
                                                    <input name="name" type="text" value="{{ $name }}" hidden>
                                                    
                                                    <input name="day" type="date" value="{{ $calendardate->format('Y-m-d') }}" hidden>
                                                    
                                                    <input name="time" type="number" value="{{ $i }}" hidden>
                                                    
                                                    <button type="submit">Boek afspraak</button>
                                                </form>
                                            @else
                                                class="closed"><p>gesloten</p>
                                            @endif
                                        @endif
                                    
                                    @elseif(($calendardate->isToday() && $today > $rowtime) || $calendardate->format('Y-m-d') < $today->format('Y-m-d'))
                                        class="past">
                                    @elseif(in_array($i, $wednesdayhours))
                                        class="occupied"><p>bezet</p>
                                    @else
                                        class="past">
                                    @endif
                                </td>
                                @break



                                                                
                            @case(4)
                                <td
                                    @if((($calendardate->isToday() && $today->lte($rowtime)) || $calendardate->isFuture()) && !in_array($i, $thursdayhours))
                                        @if(count($thursday) == 1)
                                            @if(!$thursday[0]->closed)
                                                @if($thursday[0]->opentime_in_min <= $i && $i < $thursday[0]->closetime_in_min)
                                                    class="available">
                        
                                                    <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                                        @csrf

                                                        <input name="id" type="number" value="{{ $id }}" hidden>
                                                        
                                                        <input name="name" type="text" value="{{ $name }}" hidden>
                                                        
                                                        <input name="day" type="date" value="{{ $calendardate->format('Y-m-d') }}" hidden>
                                                        
                                                        <input name="time" type="number" value="{{ $i }}" hidden>
                                                        
                                                        <button type="submit">Boek afspraak</button>
                                                    </form>
                                                @else
                                                    class="closed"><p>gesloten</p>
                                                @endif
                                            @else
                                                class="closed"><p>gesloten</p>
                                            @endif
                                        @else
                                            @if(($thursday[0]->opentime_in_min <= $i && $i < $thursday[0]->closetime_in_min) || ($thursday[1]->opentime_in_min <= $i && $i < $thursday[1]->closetime_in_min))
                                                class="available">
                                
                                                <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                                    @csrf

                                                    <input name="id" type="number" value="{{ $id }}" hidden>
                                                    
                                                    <input name="name" type="text" value="{{ $name }}" hidden>
                                                    
                                                    <input name="day" type="date" value="{{ $calendardate->format('Y-m-d') }}" hidden>
                                                    
                                                    <input name="time" type="number" value="{{ $i }}" hidden>
                                                    
                                                    <button type="submit">Boek afspraak</button>
                                                </form>
                                            @else
                                                class="closed"><p>gesloten</p>
                                            @endif
                                        @endif
                                    
                                    @elseif(($calendardate->isToday() && $today > $rowtime) || $calendardate->format('Y-m-d') < $today->format('Y-m-d'))
                                        class="past">
                                    @elseif(in_array($i, $thursdayhours))
                                        class="occupied"><p>bezet</p>
                                    @else
                                        class="past">
                                    @endif
                                </td>
                                @break



                                                                
                            @case(5)
                                <td
                                    @if((($calendardate->isToday() && $today->lte($rowtime)) || $calendardate->isFuture()) && !in_array($i, $fridayhours))
                                        @if(count($friday) == 1)
                                            @if(!$friday[0]->closed)
                                                @if($friday[0]->opentime_in_min <= $i && $i < $friday[0]->closetime_in_min)
                                                    class="available">
                                    
                                                    <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                                        @csrf

                                                        <input name="id" type="number" value="{{ $id }}" hidden>
                                                        
                                                        <input name="name" type="text" value="{{ $name }}" hidden>
                                                        
                                                        <input name="day" type="date" value="{{ $calendardate->format('Y-m-d') }}" hidden>
                                                        
                                                        <input name="time" type="number" value="{{ $i }}" hidden>
                                                        
                                                        <button type="submit">Boek afspraak</button>
                                                    </form>
                                                @else
                                                    class="closed"><p>gesloten</p>
                                                @endif
                                            @else
                                                class="closed"><p>gesloten</p>
                                            @endif
                                        @else
                                            @if(($friday[0]->opentime_in_min <= $i && $i < $friday[0]->closetime_in_min) || ($friday[1]->opentime_in_min <= $i && $i < $friday[1]->closetime_in_min))
                                                class="available">
                                
                                                <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                                    @csrf

                                                    <input name="id" type="number" value="{{ $id }}" hidden>
                                                    
                                                    <input name="name" type="text" value="{{ $name }}" hidden>
                                                    
                                                    <input name="day" type="date" value="{{ $calendardate->format('Y-m-d') }}" hidden>
                                                    
                                                    <input name="time" type="number" value="{{ $i }}" hidden>
                                                    
                                                    <button type="submit">Boek afspraak</button>
                                                </form>
                                            @else
                                                class="closed"><p>gesloten</p>
                                            @endif
                                        @endif
                                    
                                    @elseif(($calendardate->isToday() && $today > $rowtime) || $calendardate->format('Y-m-d') < $today->format('Y-m-d'))
                                        class="past">
                                    @elseif(in_array($i, $fridayhours))
                                        class="occupied"><p>bezet</p>
                                    @else
                                        class="past">
                                    @endif
                                </td>
                                @break


                                                                
                            @case(6)
                                <td
                                    @if((($calendardate->isToday() && $today->lte($rowtime)) || $calendardate->isFuture()) && !in_array($i, $saturdayhours))
                                        @if(count($saturday) == 1)
                                            @if(!$saturday[0]->closed)
                                                @if($saturday[0]->opentime_in_min <= $i && $i < $saturday[0]->closetime_in_min)
                                                    class="available">
                                        
                                                    <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                                        @csrf

                                                        <input name="id" type="number" value="{{ $id }}" hidden>
                                                        
                                                        <input name="name" type="text" value="{{ $name }}" hidden>
                                                        
                                                        <input name="day" type="date" value="{{ $calendardate->format('Y-m-d') }}" hidden>
                                                        
                                                        <input name="time" type="number" value="{{ $i }}" hidden>
                                                        
                                                        <button type="submit">Boek afspraak</button>
                                                    </form>
                                                @else
                                                    class="closed"><p>gesloten</p>
                                                @endif
                                            @else
                                                class="closed"><p>gesloten</p>
                                            @endif
                                        @else
                                            @if(($saturday[0]->opentime_in_min <= $i && $i < $saturday[0]->closetime_in_min) || ($saturday[1]->opentime_in_min <= $i && $i < $saturday[1]->closetime_in_min))
                                                class="available">
                                    
                                                <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                                    @csrf

                                                    <input name="id" type="number" value="{{ $id }}" hidden>
                                                    
                                                    <input name="name" type="text" value="{{ $name }}" hidden>
                                                    
                                                    <input name="day" type="date" value="{{ $calendardate->format('Y-m-d') }}" hidden>
                                                    
                                                    <input name="time" type="number" value="{{ $i }}" hidden>
                                                    
                                                    <button type="submit">Boek afspraak</button>
                                                </form>
                                            @else
                                                class="closed"><p>gesloten</p>
                                            @endif
                                        @endif
                                    
                                    @elseif(($calendardate->isToday() && $today > $rowtime) || $calendardate->format('Y-m-d') < $today->format('Y-m-d'))
                                        class="past">
                                    @elseif(in_array($i, $saturdayhours))
                                        class="occupied"><p>bezet</p>
                                    @else
                                        class="past">
                                    @endif
                                </td>
                                @break

                                                                
                            @case(0)
                                <td
                                    @if((($calendardate->isToday() && $today->lte($rowtime)) || $calendardate->isFuture()) && !in_array($i, $sundayhours))
                                        @if(count($sunday) == 1)
                                            @if(!$sunday[0]->closed)
                                                @if($sunday[0]->opentime_in_min <= $i && $i < $sunday[0]->closetime_in_min)
                                                    class="available">
                                    
                                                    <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                                        @csrf

                                                        <input name="id" type="number" value="{{ $id }}" hidden>
                                                        
                                                        <input name="name" type="text" value="{{ $name }}" hidden>
                                                        
                                                        <input name="day" type="date" value="{{ $calendardate->format('Y-m-d') }}" hidden>
                                                        
                                                        <input name="time" type="number" value="{{ $i }}" hidden>
                                                        
                                                        <button type="submit">Boek afspraak</button>
                                                    </form>
                                                @else
                                                    class="closed"><p>gesloten</p>
                                                @endif
                                            @else
                                                class="closed"><p>gesloten</p>
                                            @endif
                                        @else
                                            @if(($sunday[0]->opentime_in_min <= $i && $i < $sunday[0]->closetime_in_min) || ($sunday[1]->opentime_in_min <= $i && $i < $sunday[1]->closetime_in_min))
                                                class="available">
                                    
                                                <form method="POST" action="{{ route('appointmentform', ['name' => $name, 'id' => $id]) }}">
                                                    @csrf

                                                    <input name="id" type="number" value="{{ $id }}" hidden>
                                                    
                                                    <input name="name" type="text" value="{{ $name }}" hidden>
                                                    
                                                    <input name="day" type="date" value="{{ $calendardate->format('Y-m-d') }}" hidden>
                                                    
                                                    <input name="time" type="number" value="{{ $i }}" hidden>
                                                    
                                                    <button type="submit">Boek afspraak</button>
                                                </form>
                                            @else
                                                class="closed"><p>gesloten</p>
                                            @endif
                                        @endif
                                    
                                    @elseif(($calendardate->isToday() && $today > $rowtime) || $calendardate->format('Y-m-d') < $today->format('Y-m-d'))
                                        class="past">
                                    @elseif(in_array($i, $sundayhours))
                                        class="occupied"><p>bezet</p>
                                    @else
                                        class="past">
                                    @endif
                                </td>
                                @break
                            
                            
                            
                            @default
                                <td>Er ging iets fout</td>

                        @endswitch

                    </tr>
                    
                @endfor
            </tbody>

        </table>
    </div>

@stop