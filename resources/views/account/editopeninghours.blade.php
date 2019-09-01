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

                        <div class="form-group checkbox">
                            <input type="checkbox" id="copeningType" name="openingType" value="true" onclick="changeOpeningType()" @if($openingType == 'continuous') checked="checked" @endif>
                            <label for="copeningType">Doorlopende openingsuren</label>
                            <div class="help-block with-errors"></div>
                        </div>



                        <div class="dayDiv" id="monday">
                            <div class="day-indicator">
                                <h3>Maandag</h3>
                                
                                <div class="form-group checkbox">
                                    <input type="checkbox" id="is_monday_closed" name="is_monday_closed" value="is_monday_closed" onclick="clickIsClosed('monday')" @if($mondayhours[0]->closed) checked="checked" @endif>
                                    <label for="is_monday_closed">Vrije dag</label>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="hoursDiv">
                                @if(!$mondayhours[0]->closed)
                                    <div class="form-group">
                                        <label>Van</label>

                                        <input name="monday_open_morning" type="time" value="{{ $mondayhours[0]->opentime }}">
                                        <input class="limitedInput" name="monday_open_afternoon" type="time" @if($openingType == 'limited') value="{{ $mondayhours[1]->opentime }}" @else value="13:00" @endif>
                                    </div>

                                    <div class="time-dividers">
                                        <span>-</span>
                                        <span class="second-time-dash">-</span>
                                    </div>

                                    <div class="form-group">
                                        <label>Tot</label>

                                        <input class="limitedInput" name="monday_close_morning" type="time" @if($openingType == 'limited') value="{{ $mondayhours[0]->closetime }}" @else value="12:00" @endif>
                                        <input name="monday_close_afternoon" type="time" @if($openingType == "limited") value="{{ $mondayhours[1]->closetime }}" @else value="{{ $mondayhours[0]->closetime }}" @endif>
                                    </div>
                                @else                          
                                    <div class="form-group">
                                        <label>Van</label>

                                        <input name="monday_open_morning" type="time" value="09:00" disabled>
                                        <input class="limitedInput" name="monday_open_afternoon" type="time" value="13:00" disabled>
                                    </div>

                                    <div class="time-dividers">
                                        <span>-</span>
                                        <span class="second-time-dash">-</span>
                                    </div>

                                    <div class="form-group">
                                        <label>Tot</label>

                                        <input class="limitedInput" name="monday_close_morning" type="time" value="12:00" disabled>
                                        <input name="monday_close_afternoon" type="time" value="18:00" disabled>
                                    </div>
                                @endif
                            </div>
                        </div>




                        <div class="dayDiv" id="tuesday">
                            <div class="day-indicator">
                                <h3>Dinsdag</h3>
                                
                                <div class="form-group checkbox">
                                    <input type="checkbox" id="is_tuesday_closed" name="is_tuesday_closed" value="is_tuesday_closed" onclick="clickIsClosed('tuesday')" @if($tuesdayhours[0]->closed) checked="checked" @endif>
                                    <label for="is_tuesday_closed">Vrije dag</label>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="hoursDiv">
                                @if(!$tuesdayhours[0]->closed)
                                    <div class="form-group">
                                        <label>Van</label>

                                        <input name="tuesday_open_morning" type="time" value="{{ $tuesdayhours[0]->opentime }}">
                                        <input class="limitedInput" name="tuesday_open_afternoon" type="time" @if($openingType == 'limited') value="{{ $tuesdayhours[1]->opentime }}" @else value="13:00" @endif>
                                    </div>

                                    <div class="time-dividers">
                                        <span>-</span>
                                        <span class="second-time-dash">-</span>
                                    </div>

                                    <div class="form-group">
                                        <label>Tot</label>

                                        <input class="limitedInput" name="tuesday_close_morning" type="time" @if($openingType == 'limited') value="{{ $tuesdayhours[0]->closetime }}" @else value="12:00" @endif>
                                        <input name="tuesday_close_afternoon" type="time" @if($openingType == "limited") value="{{ $tuesdayhours[1]->closetime }}" @else value="{{ $tuesdayhours[0]->closetime }}" @endif>
                                    </div>
                                @else                          
                                    <div class="form-group">
                                        <label>Van</label>

                                        <input name="tuesday_open_morning" type="time" value="09:00" disabled>
                                        <input class="limitedInput" name="tuesday_open_afternoon" type="time" value="13:00" disabled>
                                    </div>

                                    <div class="time-dividers">
                                        <span>-</span>
                                        <span class="second-time-dash">-</span>
                                    </div>

                                    <div class="form-group">
                                        <label>Tot</label>

                                        <input class="limitedInput" name="tuesday_close_morning" type="time" value="12:00" disabled>
                                        <input name="tuesday_close_afternoon" type="time" value="18:00" disabled>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="dayDiv" id="wednesday">
                            <div class="day-indicator">
                                <h3>Woensdag</h3>
                            
                                <div class="form-group checkbox">
                                    <input type="checkbox" id="is_wednesday_closed" name="is_wednesday_closed" value="is_wednesday_closed" onclick="clickIsClosed('wednesday')" @if($wednesdayhours[0]->closed) checked="checked" @endif>
                                    <label for="is_wednesday_closed">Vrije dag</label>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="hoursDiv">
                                @if(!$wednesdayhours[0]->closed)
                                    <div class="form-group">
                                        <label>Van</label>

                                        <input name="wednesday_open_morning" type="time" value="{{ $wednesdayhours[0]->opentime }}">
                                        <input class="limitedInput" name="wednesday_open_afternoon" type="time" @if($openingType == 'limited') value="{{ $wednesdayhours[1]->opentime }}" @else value="13:00" @endif>
                                    </div>

                                    <div class="time-dividers">
                                        <span>-</span>
                                        <span class="second-time-dash">-</span>
                                    </div>

                                    <div class="form-group">
                                        <label>Tot</label>

                                        <input class="limitedInput" name="wednesday_close_morning" type="time" @if($openingType == 'limited') value="{{ $wednesdayhours[0]->closetime }}" @else value="12:00" @endif>
                                        <input name="wednesday_close_afternoon" type="time" @if($openingType == "limited") value="{{ $wednesdayhours[1]->closetime }}" @else value="{{ $wednesdayhours[0]->closetime }}" @endif>
                                    </div>
                                @else                          
                                    <div class="form-group">
                                        <label>Van</label>

                                        <input name="wednesday_open_morning" type="time" value="09:00" disabled>
                                        <input class="limitedInput" name="wednesday_open_afternoon" type="time" value="13:00" disabled>
                                    </div>

                                    <div class="time-dividers">
                                        <span>-</span>
                                        <span class="second-time-dash">-</span>
                                    </div>

                                    <div class="form-group">
                                        <label>Tot</label>

                                        <input class="limitedInput" name="wednesday_close_morning" type="time" value="12:00" disabled>
                                        <input name="wednesday_close_afternoon" type="time" value="18:00" disabled>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="dayDiv" id="thursday">
                            <div class="day-indicator">
                                <h3>Donderdag</h3>
                                
                                <div class="form-group checkbox">
                                    <input type="checkbox" id="is_thursday_closed" name="is_thursday_closed" value="is_thursday_closed" onclick="clickIsClosed('thursday')" @if($thursdayhours[0]->closed) checked="checked" @endif>
                                    <label for="is_thursday_closed">Vrije dag</label>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="hoursDiv">
                                @if(!$thursdayhours[0]->closed)
                                    <div class="form-group">
                                        <label>Van</label>

                                        <input name="thursday_open_morning" type="time" value="{{ $thursdayhours[0]->opentime }}">
                                        <input class="limitedInput" name="thursday_open_afternoon" type="time" @if($openingType == 'limited') value="{{ $thursdayhours[1]->opentime }}" @else value="13:00" @endif>
                                    </div>

                                    <div class="time-dividers">
                                        <span>-</span>
                                        <span class="second-time-dash">-</span>
                                    </div>

                                    <div class="form-group">
                                        <label>Tot</label>

                                        <input class="limitedInput" name="thursday_close_morning" type="time" @if($openingType == 'limited') value="{{ $thursdayhours[0]->closetime }}" @else value="12:00" @endif>
                                        <input name="thursday_close_afternoon" type="time" @if($openingType == "limited") value="{{ $thursdayhours[1]->closetime }}" @else value="{{ $thursdayhours[0]->closetime }}" @endif>
                                    </div>
                                @else                          
                                    <div class="form-group">
                                        <label>Van</label>

                                        <input name="thursday_open_morning" type="time" value="09:00" disabled>
                                        <input class="limitedInput" name="thursday_open_afternoon" type="time" value="13:00" disabled>
                                    </div>

                                    <div class="time-dividers">
                                        <span>-</span>
                                        <span class="second-time-dash">-</span>
                                    </div>

                                    <div class="form-group">
                                        <label>Tot</label>

                                        <input class="limitedInput" name="thursday_close_morning" type="time" value="12:00" disabled>
                                        <input name="thursday_close_afternoon" type="time" value="18:00" disabled>
                                    </div>
                                @endif
                            </div>
                        </div>


                        <div class="dayDiv" id="friday">
                            <div class="day-indicator">
                                <h3>Vrijdag</h3>
                                
                                <div class="form-group checkbox">
                                    <input type="checkbox" id="is_friday_closed" name="is_friday_closed" value="is_friday_closed" onclick="clickIsClosed('friday')" @if($fridayhours[0]->closed) checked="checked" @endif>
                                    <label for="is_friday_closed">Vrije dag</label>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="hoursDiv">
                                @if(!$fridayhours[0]->closed)
                                    <div class="form-group">
                                        <label>Van</label>

                                        <input name="friday_open_morning" type="time" value="{{ $fridayhours[0]->opentime }}">
                                        <input class="limitedInput" name="friday_open_afternoon" type="time" @if($openingType == 'limited') value="{{ $fridayhours[1]->opentime }}" @else value="13:00" @endif>
                                    </div>

                                    <div class="time-dividers">
                                        <span>-</span>
                                        <span class="second-time-dash">-</span>
                                    </div>

                                    <div class="form-group">
                                        <label>Tot</label>

                                        <input class="limitedInput" name="friday_close_morning" type="time" @if($openingType == 'limited') value="{{ $fridayhours[0]->closetime }}" @else value="12:00" @endif>
                                        <input name="friday_close_afternoon" type="time" @if($openingType == "limited") value="{{ $fridayhours[1]->closetime }}" @else value="{{ $fridayhours[0]->closetime }}" @endif>
                                    </div>
                                @else                          
                                    <div class="form-group">
                                        <label>Van</label>

                                        <input name="friday_open_morning" type="time" value="09:00" disabled>
                                        <input class="limitedInput" name="friday_open_afternoon" type="time" value="13:00" disabled>
                                    </div>

                                    <div class="time-dividers">
                                        <span>-</span>
                                        <span class="second-time-dash">-</span>
                                    </div>

                                    <div class="form-group">
                                        <label>Tot</label>

                                        <input class="limitedInput" name="friday_close_morning" type="time" value="12:00" disabled>
                                        <input name="friday_close_afternoon" type="time" value="18:00" disabled>
                                    </div>
                                @endif
                            </div>
                        </div>



                        <div class="dayDiv" id="saturday">
                            <div class="day-indicator">
                                <h3>Zaterdag</h3>
                                
                                <div class="form-group checkbox">
                                    <input type="checkbox" id="is_saturday_closed" name="is_saturday_closed" value="is_saturday_closed" onclick="clickIsClosed('saturday')" @if($saturdayhours[0]->closed) checked="checked" @endif>
                                    <label for="is_saturday_closed">Vrije dag</label>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="hoursDiv">
                                @if(!$saturdayhours[0]->closed)
                                    <div class="form-group">
                                        <label>Van</label>

                                        <input name="saturday_open_morning" type="time" value="{{ $saturdayhours[0]->opentime }}">
                                        <input class="limitedInput" name="saturday_open_afternoon" type="time" @if($openingType == 'limited') value="{{ $saturdayhours[1]->opentime }}" @else value="13:00" @endif>
                                    </div>

                                    <div class="time-dividers">
                                        <span>-</span>
                                        <span class="second-time-dash">-</span>
                                    </div>

                                    <div class="form-group">
                                        <label>Tot</label>

                                        <input class="limitedInput" name="saturday_close_morning" type="time" @if($openingType == 'limited') value="{{ $saturdayhours[0]->closetime }}" @else value="12:00" @endif>
                                        <input name="saturday_close_afternoon" type="time" @if($openingType == "limited") value="{{ $saturdayhours[1]->closetime }}" @else value="{{ $saturdayhours[0]->closetime }}" @endif>
                                    </div>
                                @else                          
                                    <div class="form-group">
                                        <label>Van</label>

                                        <input name="saturday_open_morning" type="time" value="09:00" disabled>
                                        <input class="limitedInput" name="saturday_open_afternoon" type="time" value="13:00" disabled>
                                    </div>

                                    <div class="time-dividers">
                                        <span>-</span>
                                        <span class="second-time-dash">-</span>
                                    </div>

                                    <div class="form-group">
                                        <label>Tot</label>

                                        <input class="limitedInput" name="saturday_close_morning" type="time" value="12:00" disabled>
                                        <input name="saturday_close_afternoon" type="time" value="18:00" disabled>
                                    </div>
                                @endif
                            </div>
                        </div>



                        <div class="dayDiv" id="sunday">
                            <div class="day-indicator">
                                <h3>Zondag</h3>
                                
                                <div class="form-group checkbox">
                                    <input type="checkbox" id="is_sunday_closed" name="is_sunday_closed" value="is_sunday_closed" onclick="clickIsClosed('sunday')" @if($sundayhours[0]->closed) checked="checked" @endif>
                                    <label for="is_sunday_closed">Vrije dag</label>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="hoursDiv">
                                @if(!$sundayhours[0]->closed)
                                    <div class="form-group">
                                        <label>Van</label>

                                        <input name="sunday_open_morning" type="time" value="{{ $sundayhours[0]->opentime }}">
                                        <input class="limitedInput" name="sunday_open_afternoon" type="time" @if($openingType == 'limited') value="{{ $sundayhours[1]->opentime }}" @else value="13:00" @endif>
                                    </div>

                                    <div class="time-dividers">
                                        <span>-</span>
                                        <span class="second-time-dash">-</span>
                                    </div>

                                    <div class="form-group">
                                        <label>Tot</label>

                                        <input class="limitedInput" name="sunday_close_morning" type="time" @if($openingType == 'limited') value="{{ $sundayhours[0]->closetime }}" @else value="12:00" @endif>
                                        <input name="sunday_close_afternoon" type="time" @if($openingType == "limited") value="{{ $sundayhours[1]->closetime }}" @else value="{{ $sundayhours[0]->closetime }}" @endif>
                                    </div>
                                @else                          
                                    <div class="form-group">
                                        <label>Van</label>

                                        <input name="sunday_open_morning" type="time" value="09:00" disabled>
                                        <input class="limitedInput" name="sunday_open_afternoon" type="time" value="13:00" disabled>
                                    </div>

                                    <div class="time-dividers">
                                        <span>-</span>
                                        <span class="second-time-dash">-</span>
                                    </div>

                                    <div class="form-group">
                                        <label>Tot</label>

                                        <input class="limitedInput" name="sunday_close_morning" type="time" value="12:00" disabled>
                                        <input name="sunday_close_afternoon" type="time" value="18:00" disabled>
                                    </div>
                                @endif
                        </div>

                    </div>

                </div>


                <div class="form-group">
                    <button type="submit" class="form-control-submit-button">OPENINGSUREN AANPASSEN</button>
                </div>
            </form>

        @else
            <p>Je moet ingelogd zijn als zaak om je openinguren aan te passen</p>
        @endif
        
    </div>
@stop




@section('script')
    
    <script>
       

        var businessForm = document.getElementsByClassName("businessForm")[0];

        var businessInputs = document.querySelectorAll(".businessForm input, .businessForm textarea");

        var limitedInput = document.getElementsByClassName("limitedInput");

        var secondDashes = document.getElementsByClassName("second-time-dash");

        function changeOpeningType() {
            for (let i = 0; i < limitedInput.length; i++)
            {
                limitedInput[i].classList.toggle('hide');

                // Get day name
                var inputDay = limitedInput[i].name.split('_')[0];

                // Get inputs and checkbox of that day
                var dayInputs = document.querySelectorAll('#' + inputDay + ' .hoursDiv input');
                var dayCheckbox = document.getElementById('is_' + inputDay + '_closed');
            
                // If day closed box is checked, disable the inputs
                if (dayCheckbox.checked) {
                    for (let j = 0; j < dayInputs.length; j++)
                    {
                        dayInputs[j].disabled = true;
                    }
                } else {
                    var limitedInputStatus = limitedInput[i].disabled;
                    for (let k = 0; k < dayInputs.length; k++)
                    {
                        if (dayInputs[k].className.includes('limitedInput')) {
                            // Shitty toggle for disabled
                            if (limitedInputStatus) {
                                limitedInput[i].disabled = false;
                            } else {
                                limitedInput[i].disabled = true;
                            }
                        } else {
                            dayInputs[k].disabled = false;
                        }
                    }
                }
            }

            for (let l = 0; l < secondDashes.length; l++) {
                secondDashes[l].classList.toggle('hide');
            }   
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
            changeOpeningType();
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