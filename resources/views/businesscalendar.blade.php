@extends('layouts.app')

@section('title', 'kalender')


@section('content')

    <h1>
        @if($addedweeks != 0)<a href="{{ route('businesscalendar', ['name' => $name, 'id' => $id, 'addedweek' => $addedweeks - 1]) }}"><</a>@endif
        {{ Carbon\Carbon::now()->addWeek($addedweeks)->startOfWeek()->format('d/m/Y') }} - {{ Carbon\Carbon::now()->addWeek($addedweeks)->endOfWeek()->format('d/m/Y') }}
        <a href="{{ route('businesscalendar', ['name' => $name, 'id' => $id, 'addedweek' => $addedweeks + 1]) }}">></a>
    </h1>
   
    
    <!--
    {{ date('d/m/Y') }}
    <p>{{ date("d/m/Y", strtotime("now")) }}</p>
    <p>{{ date("d/m/Y", strtotime("10 September 2000")) }}</p>
    <p>{{ date("d/m/Y", strtotime("+1 day")) }}</p>
    <p>{{ date("d/m/Y", strtotime("+1 week")) }}</p>
    <p>{{ date("d/m/Y", strtotime("+1 week 2 days 4 hours 2 seconds")) }}</p>
    <p>{{ date("d/m/Y", strtotime("next Thursday")) }}</p>
    <p>{{ date("d/m/Y", strtotime("last Monday")) }}</p>
    <p>{{ date("d/m/Y", strtotime("Monday")) }}</p>
-->
    @php $today = Carbon\Carbon::now() @endphp
    
    <p>{{ $date = Carbon\Carbon::now() }}</p>
    <p>{{ $date->startOfWeek()->format('d-m-Y') }}</p>
    <p>{{ $date->endOfWeek()->format('d-m-Y') }}</p>

    <p>------</p>

    <p>{{ $date->addWeek(1)->format('d-m-Y') }}</p>

    <p>{{ $date->endOfWeek()->dayOfWeek }}</p>
    
    <p>------</p>
    <p>------</p>


    <p>{{ $date->addDays(1)->format('d-m-Y') }}</p>

    @php $startofweek = Carbon\Carbon::now()->addWeek($addedweeks)->startOfWeek() @endphp

    +++
    <p>{{ $date->addWeek(-1)->format('d-m-Y') }}</p>
    +++
    <table>
        <thead>
            <tr>
                <th></th>
                

                <th>Ma {{ $startofweek->format('d/m') }}</th>
                <th>Di {{ $startofweek->addDays(1)->format('d/m') }}</th>
                <th>Wo {{ $startofweek->addDays(1)->format('d/m') }}</th>
                <th>Do {{ $startofweek->addDays(1)->format('d/m') }}</th>
                <th>Vr {{ $startofweek->addDays(1)->format('d/m') }}</th>
                <th>Za {{ $startofweek->addDays(1)->format('d/m') }}</th>
                <th>Zo {{ $startofweek->addDays(1)->format('d/m') }}</th>
            </tr>
        </thead>

        <tbody>

            @for($i = $earliesthour; $i < $latesthour; $i += $appointmentduration)
                @php $startofweek = Carbon\Carbon::now()->addWeek($addedweeks)->startOfWeek() @endphp

                <tr>
                    <td>{{ floor($i/60) }}:@if($i%60 == 0)00 @else{{ $i%60 }} @endif</td>


                    <td>
                        @if($startofweek->isPast())
                            o
                        @else
                            @if(count($monday) == 1)
                                @if(!$monday[0]->closed)
                                    @if($monday->opentime_in_min >= $i && $i <= $monday->closetime_in_min)
                                        <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'day' => 'monday', 'time' => $i]) }}">Boek een afspraak</a>
                                    @else
                                        o
                                    @endif
                                @else
                                    o
                                @endif
                            @else
                                @if(($monday[0]->opentime_in_min <= $i && $i < $monday[0]->closetime_in_min) || ($monday[1]->opentime_in_min <= $i && $i < $monday[1]->closetime_in_min))
                                    <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'day' => 'monday', 'time' => $i]) }}">Boek een afspraak</a>
                                @else
                                    o
                                @endif
                            @endif
                        @endif
                    </td>

                    <td>
                        @if($startofweek->addDays(1)->isPast())
                            @php $beforetoday = false @endphp
                            o
                        @else
                            @if(count($tuesday) == 1)
                                @if(!$tuesday[0]->closed)
                                    @if($tuesday->opentime_in_min >= $i && $i <= $tuesday->closetime_in_min)
                                        <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'day' => 'tuesday', 'time' => $i]) }}">Boek een afspraak</a>
                                    @else
                                        o
                                    @endif
                                @else
                                    o
                                @endif
                            @else
                                @if(($tuesday[0]->opentime_in_min <= $i && $i < $tuesday[0]->closetime_in_min) || ($tuesday[1]->opentime_in_min <= $i && $i < $tuesday[1]->closetime_in_min))
                                    <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'day' => 'tuesday', 'time' => $i]) }}">Boek een afspraak</a>
                                @else
                                    o
                                @endif
                            @endif
                        @endif
                    </td>

                    <td>
                        @if($startofweek->addDays(1)->isPast())
                            @php $beforetoday = false @endphp
                            o
                        @else
                            @if(count($wednesday) == 1)
                                @if(!$wednesday[0]->closed)
                                    @if($wednesday->opentime_in_min >= $i && $i <= $wednesday->closetime_in_min)
                                        <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'day' => 'wednesday', 'time' => $i]) }}">Boek een afspraak</a>
                                    @else
                                        o
                                    @endif
                                @else
                                    o
                                @endif
                            @else
                                @if(($wednesday[0]->opentime_in_min <= $i && $i < $wednesday[0]->closetime_in_min) || ($wednesday[1]->opentime_in_min <= $i && $i < $wednesday[1]->closetime_in_min))
                                    <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'day' => 'wednesday', 'time' => $i]) }}">Boek een afspraak</a>
                                @else
                                    o
                                @endif
                            @endif
                        @endif
                    </td>

                    <td>
                        @if($startofweek->addDays(1)->isPast())
                            @php $beforetoday = false @endphp
                            o
                        @else
                            @if(count($thursday) == 1)
                                @if(!$thursday[0]->closed)
                                    @if($thursday->opentime_in_min >= $i && $i <= $thursday->closetime_in_min)
                                        <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'day' => 'thursday', 'time' => $i]) }}">Boek een afspraak</a>
                                    @else
                                        o
                                    @endif
                                @else
                                    o
                                @endif
                            @else
                                @if(($thursday[0]->opentime_in_min <= $i && $i < $thursday[0]->closetime_in_min) || ($thursday[1]->opentime_in_min <= $i && $i < $thursday[1]->closetime_in_min))
                                    <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'day' => 'thursday', 'time' => $i]) }}">Boek een afspraak</a>
                                @else
                                    o
                                @endif
                            @endif
                        @endif
                    </td>

                    <td>
                        @if($startofweek->addDays(1)->isPast())
                            @php $beforetoday = false @endphp
                            o
                        @else
                            @if(count($friday) == 1)
                                @if(!$friday[0]->closed)
                                    @if($friday->opentime_in_min >= $i && $i <= $friday->closetime_in_min)
                                        <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'day' => 'friday', 'time' => $i]) }}">Boek een afspraak</a>
                                    @else
                                        o
                                    @endif
                                @else
                                    o
                                @endif
                            @else
                                @if(($friday[0]->opentime_in_min <= $i && $i < $friday[0]->closetime_in_min) || ($friday[1]->opentime_in_min <= $i && $i < $friday[1]->closetime_in_min))
                                    <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'day' => 'friday', 'time' => $i]) }}">Boek een afspraak</a>
                                @else
                                    o
                                @endif
                            @endif
                        @endif
                    </td>

                    <td>
                        @if($startofweek->addDays(1)->isPast())
                            @php $beforetoday = false @endphp
                            o
                        @else
                            @if(count($saturday) == 1)
                                @if(!$saturday[0]->closed)
                                    @if($saturday->opentime_in_min >= $i && $i <= $saturday->closetime_in_min)
                                        <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'day' => 'saturday', 'time' => $i]) }}">Boek een afspraak</a>
                                    @else
                                        o
                                    @endif
                                @else
                                    o
                                @endif
                            @else
                                @if(($saturday[0]->opentime_in_min <= $i && $i < $saturday[0]->closetime_in_min) || ($saturday[1]->opentime_in_min <= $i && $i < $saturday[1]->closetime_in_min))
                                    <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'day' => 'saturday', 'time' => $i]) }}">Boek een afspraak</a>
                                @else
                                    o
                                @endif
                            @endif
                        @endif
                    </td>

                    <td>
                        @if($startofweek->addDays(1)->isPast())
                            @php $beforetoday = false @endphp
                            o
                        @else
                            @if(count($sunday) == 1)
                                @if(!$sunday[0]->closed)
                                    @if($sunday->opentime_in_min >= $i && $i <= $sunday->closetime_in_min)
                                        <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'day' => 'sunday', 'time' => $i]) }}">Boek een afspraak</a>
                                    @else
                                        o
                                    @endif
                                @else
                                    o
                                @endif
                            @else
                                @if(($sunday[0]->opentime_in_min <= $i && $i < $sunday[0]->closetime_in_min) || ($sunday[1]->opentime_in_min <= $i && $i < $sunday[1]->closetime_in_min))
                                    <a href="{{ route('appointmentform', ['name' => $name, 'id' => $id, 'day' => 'sunday', 'time' => $i]) }}">Boek een afspraak</a>
                                @else
                                    o
                                @endif
                            @endif
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