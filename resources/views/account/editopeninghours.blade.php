@extends('layouts.app')

@section('title', 'Openingsuren aanpassen')


@section('content')
    <h1>Openingsuren aanpassen</h1>

    <div class="contentDiv">
            
        @if(session()->get('account_type') == 'zaak')
            
            <form method="POST" action="{{ route('updateopeninghours') }}">
                @csrf

                <div class="businessForm">

                    <input name="monday_id_1" type="number" value="{{ $mondayhours[0]->id }}" hidden>
                    <input name="tuesday_id_1" type="number" value="{{ $tuesdayhours[0]->id }}" hidden>
                    <input name="wednesday_id_1" type="number" value="{{ $wednesdayhours[0]->id }}" hidden>
                    <input name="thursday_id_1" type="number" value="{{ $thursdayhours[0]->id }}" hidden>
                    <input name="friday_id_1" type="number" value="{{ $fridayhours[0]->id }}" hidden>
                    <input name="saturday_id_1" type="number" value="{{ $saturdayhours[0]->id }}" hidden>
                    <input name="sunday_id_1" type="number" value="{{ $sundayhours[0]->id }}" hidden>

                    @if($openingType == 'limited')
                        @if(!$mondayhours[0]->closed) <input name="monday_id_2" type="number" value="{{ $mondayhours[1]->id }}" hidden> @endif
                        @if(!$tuesdayhours[0]->closed) <input name="tuesday_id_2" type="number" value="{{ $tuesdayhours[1]->id }}" hidden> @endif
                        @if(!$wednesdayhours[0]->closed) <input name="wednesday_id_2" type="number" value="{{ $wednesdayhours[1]->id }}" hidden> @endif
                        @if(!$thursdayhours[0]->closed) <input name="thursday_id_2" type="number" value="{{ $thursdayhours[1]->id }}" hidden> @endif
                        @if(!$fridayhours[0]->closed) <input name="friday_id_2" type="number" value="{{ $fridayhours[1]->id }}" hidden> @endif
                        @if(!$saturdayhours[0]->closed) <input name="saturday_id_2" type="number" value="{{ $saturdayhours[1]->id }}" hidden> @endif
                        @if(!$sundayhours[0]->closed) <input name="sunday_id_2" type="number" value="{{ $sundayhours[1]->id }}" hidden> @endif
                    @endif

                    <div class="openinghours">
                        <div class="radioGroup">
                            <div class="radioInput">
                                <input type="radio" name="openingType" value="continuous" onclick="clickContinuous()" id="continuousBtn" @if($openingType == 'continuous') class="selected" checked="checked" @endif><label for="continuousBtn">Doorlopende openingsuren</label>
                            </div>

                            <div class="radioInput">
                                <input type="radio" name="openingType" value="limited" onclick="clickLimited()" id="limitedBtn" @if($openingType == 'limited') class="selected" checked="checked" @endif><label for="limitedBtn">Beperkte openingsuren</label>
                            </div>
                        </div>



                        <div class="dayDiv" id="monday">
                            <div class="checkboxDiv">
                                <h3>Maandag</h3>
                                <input type="checkbox" name="is_monday_closed" value="is_monday_closed" id="is_monday_closed" onclick="clickIsClosed('monday')" @if($mondayhours[0]->closed) checked @endif> <label for="is_monday_closed">Vrije dag</label>
                            </div>

                            <div class="hoursDiv">
                                @if(!$mondayhours[0]->closed)
                                    <div>
                                        <label>Openingsuur</label>

                                        <input name="monday_open_morning" type="time" value="{{ $mondayhours[0]->opentime }}">
                                        <input class="limitedInput" name="monday_open_afternoon" type="time" @if($openingType == 'limited') value="{{ $mondayhours[1]->opentime }}" @else value="13:00" disabled @endif>
                                    </div>

                                    <div>
                                        <label>Sluitingsuur</label>

                                        <input class="limitedInput" name="monday_close_morning" type="time" @if($openingType == 'limited') value="{{ $mondayhours[0]->closetime }}" @else value="12:00" disabled @endif>
                                        <input name="monday_close_afternoon" type="time" @if($openingType == "limited") value="{{ $mondayhours[1]->closetime }}" @else value="{{ $mondayhours[0]->closetime }}" @endif>
                                    </div>
                                @else
                                    <div>
                                        <label>Openingsuur</label>

                                        <input name="monday_open_morning" type="time" value="09:00" disabled>
                                        <input class="limitedInput" name="monday_open_afternoon" type="time" value="13:00" disabled >
                                    </div>

                                    <div>
                                        <label>Sluitingsuur</label>

                                        <input class="limitedInput" name="monday_close_morning" type="time" value="12:00" disabled>
                                        <input name="monday_close_afternoon" type="time" value="18:00" disabled>
                                    </div>
                                @endif
                            </div>
                        </div>





                        <div class="dayDiv" id="tuesday">
                            <div class="checkboxDiv">
                                <h3>Dinsdag</h3>
                                <input type="checkbox" name="is_tuesday_closed" value="is_tuesday_closed" id="is_tuesday_closed" onclick="clickIsClosed('tuesday')" @if($tuesdayhours[0]->closed) checked @endif> <label for="is_tuesday_closed">Vrije dag</label>
                            </div>

                            <div class="hoursDiv">
                                @if(!$tuesdayhours[0]->closed)
                                    <div>
                                        <label>Openingsuur</label>

                                        <input name="tuesday_open_morning" type="time" value="{{ $tuesdayhours[0]->opentime }}">
                                        <input class="limitedInput" name="tuesday_open_afternoon" type="time" @if($openingType == 'limited') value="{{ $tuesdayhours[1]->opentime }}" @else value="13:00" disabled @endif>
                                    </div>

                                    <div>
                                        <label>Sluitingsuur</label>

                                        <input class="limitedInput" name="tuesday_close_morning" type="time" @if($openingType == 'limited') value="{{ $tuesdayhours[0]->closetime }}" @else value="12:00" disabled @endif>
                                        <input name="tuesday_close_afternoon" type="time" @if($openingType == "limited") value="{{ $tuesdayhours[1]->closetime }}" @else value="{{ $tuesdayhours[0]->closetime }}" @endif>
                                    </div>
                                @else
                                    <div>
                                        <label>Openingsuur</label>

                                        <input name="tuesday_open_morning" type="time" value="09:00" disabled>
                                        <input class="limitedInput" name="tuesday_open_afternoon" type="time" value="13:00" disabled >
                                    </div>

                                    <div>
                                        <label>Sluitingsuur</label>

                                        <input class="limitedInput" name="tuesday_close_morning" type="time" value="12:00" disabled>
                                        <input name="tuesday_close_afternoon" type="time" value="18:00" disabled>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="dayDiv" id="wednesday">
                            <div class="checkboxDiv">
                                <h3>Woensdag</h3>
                                <input type="checkbox" name="is_wednesday_closed" value="is_wednesday_closed" id="is_wednesday_closed" onclick="clickIsClosed('wednesday')" @if($wednesdayhours[0]->closed) checked @endif> <label for="is_wednesday_closed">Vrije dag</label>
                            </div>

                            <div class="hoursDiv">
                                @if(!$wednesdayhours[0]->closed)
                                    <div>
                                        <label>Openingsuur</label>

                                        <input name="wednesday_open_morning" type="time" value="{{ $wednesdayhours[0]->opentime }}">
                                        <input class="limitedInput" name="wednesday_open_afternoon" type="time" @if($openingType == 'limited') value="{{ $wednesdayhours[1]->opentime }}" @else value="13:00" disabled @endif>
                                    </div>

                                    <div>
                                        <label>Sluitingsuur</label>

                                        <input class="limitedInput" name="wednesday_close_morning" type="time" @if($openingType == 'limited') value="{{ $wednesdayhours[0]->closetime }}" @else value="12:00" disabled @endif>
                                        <input name="wednesday_close_afternoon" type="time" @if($openingType == "limited") value="{{ $wednesdayhours[1]->closetime }}" @else value="{{ $wednesdayhours[0]->closetime }}" @endif>
                                    </div>
                                @else
                                    <div>
                                        <label>Openingsuur</label>

                                        <input name="wednesday_open_morning" type="time" value="09:00" disabled>
                                        <input class="limitedInput" name="wednesday_open_afternoon" type="time" value="13:00" disabled >
                                    </div>

                                    <div>
                                        <label>Sluitingsuur</label>

                                        <input class="limitedInput" name="wednesday_close_morning" type="time" value="12:00" disabled>
                                        <input name="wednesday_close_afternoon" type="time" value="18:00" disabled>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="dayDiv" id="thursday">
                            <div class="checkboxDiv">
                                <h3>Donderdag</h3>
                                <input type="checkbox" name="is_thursday_closed" value="is_thursday_closed" id="is_thursday_closed" onclick="clickIsClosed('thursday')" @if($thursdayhours[0]->closed) checked @endif> <label for="is_thursday_closed">Vrije dag</label>
                            </div>

                            <div class="hoursDiv">
                                @if(!$thursdayhours[0]->closed)
                                    <div>
                                        <label>Openingsuur</label>

                                        <input name="thursday_open_morning" type="time" value="{{ $thursdayhours[0]->opentime }}">
                                        <input class="limitedInput" name="thursday_open_afternoon" type="time" @if($openingType == 'limited') value="{{ $thursdayhours[1]->opentime }}" @else value="13:00" disabled @endif>
                                    </div>

                                    <div>
                                        <label>Sluitingsuur</label>

                                        <input class="limitedInput" name="thursday_close_morning" type="time" @if($openingType == 'limited') value="{{ $thursdayhours[0]->closetime }}" @else value="12:00" disabled @endif>
                                        <input name="thursday_close_afternoon" type="time" @if($openingType == "limited") value="{{ $thursdayhours[1]->closetime }}" @else value="{{ $thursdayhours[0]->closetime }}" @endif>
                                    </div>
                                @else
                                    <div>
                                        <label>Openingsuur</label>

                                        <input name="thursday_open_morning" type="time" value="09:00" disabled>
                                        <input class="limitedInput" name="thursday_open_afternoon" type="time" value="13:00" disabled >
                                    </div>

                                    <div>
                                        <label>Sluitingsuur</label>

                                        <input class="limitedInput" name="thursday_close_morning" type="time" value="12:00" disabled>
                                        <input name="thursday_close_afternoon" type="time" value="18:00" disabled>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="dayDiv" id="friday">
                            <div class="checkboxDiv">
                                <h3>Vrijdag</h3>
                                <input type="checkbox" name="is_friday_closed" value="is_friday_closed" id="is_friday_closed" onclick="clickIsClosed('friday')" @if($fridayhours[0]->closed) checked @endif> <label for="is_friday_closed">Vrije dag</label>
                            </div>

                            <div class="hoursDiv">
                                @if(!$fridayhours[0]->closed)
                                    <div>
                                        <label>Openingsuur</label>

                                        <input name="friday_open_morning" type="time" value="{{ $fridayhours[0]->opentime }}">
                                        <input class="limitedInput" name="friday_open_afternoon" type="time" @if($openingType == 'limited') value="{{ $fridayhours[1]->opentime }}" @else value="13:00" disabled @endif>
                                    </div>

                                    <div>
                                        <label>Sluitingsuur</label>

                                        <input class="limitedInput" name="friday_close_morning" type="time" @if($openingType == 'limited') value="{{ $fridayhours[0]->closetime }}" @else value="12:00" disabled @endif>
                                        <input name="friday_close_afternoon" type="time" @if($openingType == "limited") value="{{ $fridayhours[1]->closetime }}" @else value="{{ $fridayhours[0]->closetime }}" @endif>
                                    </div>
                                @else
                                    <div>
                                        <label>Openingsuur</label>

                                        <input name="friday_open_morning" type="time" value="09:00" disabled>
                                        <input class="limitedInput" name="friday_open_afternoon" type="time" value="13:00" disabled >
                                    </div>

                                    <div>
                                        <label>Sluitingsuur</label>

                                        <input class="limitedInput" name="friday_close_morning" type="time" value="12:00" disabled>
                                        <input name="friday_close_afternoon" type="time" value="18:00" disabled>
                                    </div>
                                @endif
                            </div>
                        </div>



                        <div class="dayDiv" id="saturday">
                            <div class="checkboxDiv">
                                <h3>Zaterdag</h3>
                                <input type="checkbox" name="is_saturday_closed" value="is_saturday_closed" id="is_saturday_closed" onclick="clickIsClosed('saturday')" @if($saturdayhours[0]->closed) checked @endif> <label for="is_saturday_closed">Vrije dag</label>
                            </div>

                            <div class="hoursDiv">
                                @if(!$saturdayhours[0]->closed)
                                    <div>
                                        <label>Openingsuur</label>

                                        <input name="saturday_open_morning" type="time" value="{{ $saturdayhours[0]->opentime }}">
                                        <input class="limitedInput" name="saturday_open_afternoon" type="time" @if($openingType == 'limited') value="{{ $saturdayhours[1]->opentime }}" @else value="13:00" disabled @endif>
                                    </div>

                                    <div>
                                        <label>Sluitingsuur</label>

                                        <input class="limitedInput" name="saturday_close_morning" type="time" @if($openingType == 'limited') value="{{ $saturdayhours[0]->closetime }}" @else value="12:00" disabled @endif>
                                        <input name="saturday_close_afternoon" type="time" @if($openingType == "limited") value="{{ $saturdayhours[1]->closetime }}" @else value="{{ $saturdayhours[0]->closetime }}" @endif>
                                    </div>
                                @else
                                    <div>
                                        <label>Openingsuur</label>

                                        <input name="saturday_open_morning" type="time" value="09:00" disabled>
                                        <input class="limitedInput" name="saturday_open_afternoon" type="time" value="13:00" disabled >
                                    </div>

                                    <div>
                                        <label>Sluitingsuur</label>

                                        <input class="limitedInput" name="saturday_close_morning" type="time" value="12:00" disabled>
                                        <input name="saturday_close_afternoon" type="time" value="18:00" disabled>
                                    </div>
                                @endif
                            </div>
                        </div>



                        <div class="dayDiv" id="sunday">
                            <div class="checkboxDiv">
                                <h3>Zondag</h3>
                                <input type="checkbox" name="is_sunday_closed" value="is_sunday_closed" id="is_sunday_closed" onclick="clickIsClosed('sunday')" @if($sundayhours[0]->closed) checked @endif> <label for="is_sunday_closed">Vrije dag</label>
                            </div>

                            <div class="hoursDiv">
                                @if(!$sundayhours[0]->closed)
                                    <div>
                                        <label>Openingsuur</label>

                                        <input name="sunday_open_morning" type="time" value="{{ $sundayhours[0]->opentime }}">
                                        <input class="limitedInput" name="sunday_open_afternoon" type="time" @if($openingType == 'limited') value="{{ $sundayhours[1]->opentime }}" @else value="13:00" disabled @endif>
                                    </div>

                                    <div>
                                        <label>Sluitingsuur</label>

                                        <input class="limitedInput" name="sunday_close_morning" type="time" @if($openingType == 'limited') value="{{ $sundayhours[0]->closetime }}" @else value="12:00" disabled @endif>
                                        <input name="sunday_close_afternoon" type="time" @if($openingType == "limited") value="{{ $sundayhours[1]->closetime }}" @else value="{{ $sundayhours[0]->closetime }}" @endif>
                                    </div>
                                @else
                                    <div>
                                        <label>Openingsuur</label>

                                        <input name="sunday_open_morning" type="time" value="09:00" disabled>
                                        <input class="limitedInput" name="sunday_open_afternoon" type="time" value="13:00" disabled >
                                    </div>

                                    <div>
                                        <label>Sluitingsuur</label>

                                        <input class="limitedInput" name="sunday_close_morning" type="time" value="12:00" disabled>
                                        <input name="sunday_close_afternoon" type="time" value="18:00" disabled>
                                    </div>
                                @endif
                        </div>
                    </div>

                </div>

                <button type="submit">Account aanpassen</button>
            </form>

        @else
            <p>Je moet ingelogd zijn als zaak om je openinguren aan te passen</p>
        @endif
        
    </div>
@stop




@section('script')
    
    <script>
        var continuousBtn = document.getElementById("continuousBtn");
        var limitedBtn = document.getElementById("limitedBtn");

        var limitedInput = document.getElementsByClassName("limitedInput");


        function clickContinuous()
        {
            for (let i = 0; i < limitedInput.length; i++)
            {
                limitedInput[i].classList.add('hide');

                var inputDay = limitedInput[i].name.split('_')[0];

                var dayInputs = document.querySelectorAll('#' + inputDay + ' .hoursDiv input');
                var dayCheckbox = document.getElementById('is_' + inputDay + '_closed');
            
                if (dayCheckbox.checked) {
                    for (let j = 0; j < dayInputs.length; j++)
                    {
                        dayInputs[j].disabled = true;
                    }
                } else {
                    for (let k = 0; k < dayInputs.length; k++)
                    {
                        if (dayInputs[k].className.includes('limitedInput')) {
                            limitedInput[i].disabled = true;
                        } else {
                            dayInputs[k].disabled = false;
                        }
                    }
                }
            }
            
            continuousBtn.classList.add("selected");
            limitedBtn.classList.remove("selected");
        }

        function clickLimited()
        {
            for (let i = 0; i < limitedInput.length; i++)
            {
                limitedInput[i].classList.remove('hide');
                
                var inputDay = limitedInput[i].name.split('_')[0];

                var dayInputs = document.querySelectorAll('#' + inputDay + ' .hoursDiv input');
                var dayCheckbox = document.getElementById('is_' + inputDay + '_closed');

                if (dayCheckbox.checked) {
                    for (let j = 0; j < dayInputs.length; j++)
                    {
                        dayInputs[j].disabled = true;
                    }
                } else {
                    for (let k = 0; k < dayInputs.length; k++)
                    {
                        dayInputs[k].disabled = false;
                    }
                }
            }

            continuousBtn.classList.remove("selected");
            limitedBtn.classList.add("selected");
        }



        function clickIsClosed(day) {
            var hoursDiv = document.getElementById(day).getElementsByClassName('hoursDiv')[0];
            
            hoursDiv.classList.toggle('hide');


            var dayInputs = document.querySelectorAll('#' + day + ' .hoursDiv input');
            var dayCheckbox = document.getElementById('is_' + day + '_closed');
            
            if (dayCheckbox.checked) {
                for (let i = 0; i < dayInputs.length; i++)
                {
                    dayInputs[i].disabled = true;
                }
            } else {
                for (let i = 0; i < dayInputs.length; i++)
                {
                    dayInputs[i].disabled = false;
                }
            }
        }
        
        @if($openingType == 'continuous')
            clickContinuous();
        @elseif($openingType == 'limited')
            clickLimited();
        @endif

        @if($mondayhours[0]->closed) clickIsClosed('monday'); @endif
        @if($tuesdayhours[0]->closed) clickIsClosed('tuesday'); @endif
        @if($wednesdayhours[0]->closed) clickIsClosed('wednesday'); @endif
        @if($thursdayhours[0]->closed) clickIsClosed('thursday'); @endif
        @if($fridayhours[0]->closed) clickIsClosed('friday'); @endif
        @if($saturdayhours[0]->closed) clickIsClosed('saturday'); @endif
        @if($sundayhours[0]->closed) clickIsClosed('sunday'); @endif
    </script>
    
@stop