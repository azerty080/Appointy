@extends('layouts.app')

@section('title', 'kalender')


@section('content')

    <h1>
        @if($addedweeks != 0)<a href="{{ route('businesscalendar', ['name' => $name, 'id' => $id, 'addedweek' => $addedweeks - 1]) }}"><</a>@endif
        {{ Carbon\Carbon::now()->addWeek($addedweeks)->startOfWeek()->format('d/m/Y') }} - {{ Carbon\Carbon::now()->addWeek($addedweeks)->endOfWeek()->format('d/m/Y') }}
        <a href="{{ route('businesscalendar', ['name' => $name, 'id' => $id, 'addedweek' => $addedweeks + 1]) }}">></a>
    </h1>
   
    

    @php $today = Carbon\Carbon::now()->addHours(3) @endphp

    @php
        $mondaydate = Carbon\Carbon::now()->addWeek($addedweeks)->startOfWeek();
        $tuesdaydate = Carbon\Carbon::now()->addWeek($addedweeks)->startOfWeek()->addDays(1);
        $wednesdaydate = Carbon\Carbon::now()->addWeek($addedweeks)->startOfWeek()->addDays(2);
        $thursdaydate = Carbon\Carbon::now()->addWeek($addedweeks)->startOfWeek()->addDays(3);
        $fridaydate = Carbon\Carbon::now()->addWeek($addedweeks)->startOfWeek()->addDays(4);
        $saturdaydate = Carbon\Carbon::now()->addWeek($addedweeks)->startOfWeek()->addDays(5);
        $sundaydate = Carbon\Carbon::now()->addWeek($addedweeks)->startOfWeek()->addDays(6);
    @endphp

    <table>
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
                    <td>{{ $rowtime->format('H:i') }}</td>

                    <td>
                        @if((($mondaydate->isToday() && $today->lte($rowtime)) || $mondaydate->isFuture()) && !in_array($i, $mondayhours))
                            @if(count($monday) == 1)
                                @if(!$monday[0]->closed)
                                    @if($monday->opentime_in_min >= $i && $i <= $monday->closetime_in_min)
                                        <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'date' => $mondaydate->format('Y-m-d'), 'time' => $i]) }}">Boek een afspraak</a>
                                    @else
                                        o
                                    @endif
                                @else
                                    o
                                @endif
                            @else
                                @if(($monday[0]->opentime_in_min <= $i && $i < $monday[0]->closetime_in_min) || ($monday[1]->opentime_in_min <= $i && $i < $monday[1]->closetime_in_min))
                                    <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'date' => $mondaydate->format('Y-m-d'), 'time' => $i]) }}">Boek een afspraak</a>
                                @else
                                    o
                                @endif
                            @endif
                        @else
                            o
                        @endif
                    </td>

                    <td>
                        @if((($tuesdaydate->isToday() && $today->lte($rowtime)) || $tuesdaydate->isFuture()) && !in_array($i, $tuesdayhours))
                            @if(count($tuesday) == 1)
                                @if(!$tuesday[0]->closed)
                                    @if($tuesday->opentime_in_min >= $i && $i <= $tuesday->closetime_in_min)
                                        <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'date' => $tuesdaydate->format('Y-m-d'), 'time' => $i]) }}">Boek een afspraak</a>
                                    @else
                                        o
                                    @endif
                                @else
                                    o
                                @endif
                            @else
                                @if(($tuesday[0]->opentime_in_min <= $i && $i < $tuesday[0]->closetime_in_min) || ($tuesday[1]->opentime_in_min <= $i && $i < $tuesday[1]->closetime_in_min))
                                    <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'date' => $tuesdaydate->format('Y-m-d'), 'time' => $i]) }}">Boek een afspraak</a>
                                @else
                                    o
                                @endif
                            @endif
                        @else
                            o
                        @endif
                    </td>
                    
                    <td>
                        @if((($wednesdaydate->isToday() && $today->lte($rowtime)) || $wednesdaydate->isFuture()) && !in_array($i, $wednesdayhours))
                            @if(count($wednesday) == 1)
                                @if(!$wednesday[0]->closed)
                                    @if($wednesday->opentime_in_min >= $i && $i <= $wednesday->closetime_in_min)
                                        <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'date' => $wednesdaydate->format('Y-m-d'), 'time' => $i]) }}">Boek een afspraak</a>
                                    @else
                                        o
                                    @endif
                                @else
                                    o
                                @endif
                            @else
                                @if(($wednesday[0]->opentime_in_min <= $i && $i < $wednesday[0]->closetime_in_min) || ($wednesday[1]->opentime_in_min <= $i && $i < $wednesday[1]->closetime_in_min))
                                    <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'date' => $wednesdaydate->format('Y-m-d'), 'time' => $i]) }}">Boek een afspraak</a>
                                @else
                                    o
                                @endif
                            @endif
                        @else
                            o
                        @endif
                    </td>

                    <td>
                        @if((($thursdaydate->isToday() && $today->lte($rowtime)) || $thursdaydate->isFuture()) && !in_array($i, $thursdayhours))
                            @if(count($thursday) == 1)
                                @if(!$thursday[0]->closed)
                                    @if($thursday->opentime_in_min >= $i && $i <= $thursday->closetime_in_min)
                                        <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'date' => $thursdaydate->format('Y-m-d'), 'time' => $i]) }}">Boek een afspraak</a>
                                    @else
                                        o
                                    @endif
                                @else
                                    o
                                @endif
                            @else
                                @if(($thursday[0]->opentime_in_min <= $i && $i < $thursday[0]->closetime_in_min) || ($thursday[1]->opentime_in_min <= $i && $i < $thursday[1]->closetime_in_min))
                                    <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'date' => $thursdaydate->format('Y-m-d'), 'time' => $i]) }}">Boek een afspraak</a>
                                @else
                                    o
                                @endif
                            @endif
                        @else
                            o
                        @endif
                    </td>

                    <td>
                        @if((($fridaydate->isToday() && $today->lte($rowtime)) || $fridaydate->isFuture()) && !in_array($i, $fridayhours))
                            @if(count($friday) == 1)
                                @if(!$friday[0]->closed)
                                    @if($friday->opentime_in_min >= $i && $i <= $friday->closetime_in_min)
                                        <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'date' => $fridaydate->format('Y-m-d'), 'time' => $i]) }}">Boek een afspraak</a>
                                    @else
                                        o
                                    @endif
                                @else
                                    o
                                @endif
                            @else
                                @if(($friday[0]->opentime_in_min <= $i && $i < $friday[0]->closetime_in_min) || ($friday[1]->opentime_in_min <= $i && $i < $friday[1]->closetime_in_min))
                                    <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'date' => $fridaydate->format('Y-m-d'), 'time' => $i]) }}">Boek een afspraak</a>
                                @else
                                    o
                                @endif
                            @endif
                        @else
                            o
                        @endif
                    </td>

                    <td>
                        @if((($saturdaydate->isToday() && $today->lte($rowtime)) || $saturdaydate->isFuture()) && !in_array($i, $saturdayhours))
                            @if(count($saturday) == 1)
                                @if(!$saturday[0]->closed)
                                    @if($saturday->opentime_in_min >= $i && $i <= $saturday->closetime_in_min)
                                        <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'date' => $saturdaydate->format('Y-m-d'), 'time' => $i]) }}">Boek een afspraak</a>
                                    @else
                                        o
                                    @endif
                                @else
                                    o
                                @endif
                            @else
                                @if(($saturday[0]->opentime_in_min <= $i && $i < $saturday[0]->closetime_in_min) || ($saturday[1]->opentime_in_min <= $i && $i < $saturday[1]->closetime_in_min))
                                    <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'date' => $saturdaydate->format('Y-m-d'), 'time' => $i]) }}">Boek een afspraak</a>
                                @else
                                    o
                                @endif
                            @endif
                        @else
                            o
                        @endif
                    </td>

                    <td>
                        @if((($sundaydate->isToday() && $today->lte($rowtime)) || $sundaydate->isFuture()) && !in_array($i, $sundayhours))
                            @if(count($sunday) == 1)
                                @if(!$sunday[0]->closed)
                                    @if($sunday->opentime_in_min >= $i && $i <= $sunday->closetime_in_min)
                                        <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'date' => $sundaydate->format('Y-m-d'), 'time' => $i]) }}">Boek een afspraak</a>
                                    @else
                                        o
                                    @endif
                                @else
                                    o
                                @endif
                            @else
                                @if(($sunday[0]->opentime_in_min <= $i && $i < $sunday[0]->closetime_in_min) || ($sunday[1]->opentime_in_min <= $i && $i < $sunday[1]->closetime_in_min))
                                    <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'date' => $sundaydate->format('Y-m-d'), 'time' => $i]) }}">Boek een afspraak</a>
                                @else
                                    o
                                @endif
                            @endif
                        @else
                            o
                        @endif
                    </td>


                </tr>
                
            @endfor
            <tr>
                <td></td>
            </tr>
        </tbody>

    </table>



@stop