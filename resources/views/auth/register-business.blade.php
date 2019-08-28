@extends('layouts.app')

@section('title', 'Registreren')


@section('content')
    <h1>Registreren als zaak</h1>

    <div class="contentDiv">
        <form method="POST" action="{{ route('register-business-submit') }}" role="form" data-toggle="validator">
            @csrf


            

            <div class="userForm businessForm">
               
                
                <!-- Part 1 Business -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control-input" id="cname" name="name" value="{{ old('name') }}" required>
                        <label class="label-control" for="cname">Naam</label>
                        <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <input type="text" class="form-control-input" id="cprofession" name="profession" value="{{ old('profession') }}" required>
                        <label class="label-control" for="cprofession">Beroep</label>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                <div class="form-group">
                    <textarea type="text" class="form-control-input" id="cdescription" name="description" required>{{ old('description') }}</textarea>
                    <label class="label-control" for="cdescription">Beschrijving</label>
                    <div class="help-block with-errors"></div>
                </div>



                
                <!-- Part 2 Business -->
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control-input" id="ctownship" name="township" value="{{ old('township') }}" required>
                        <label class="label-control" for="ctownship">Gemeente</label>
                        <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group col-md-5">
                        <input type="text" class="form-control-input" id="caddress" name="address" value="{{ old('address') }}" required>
                        <label class="label-control" for="caddress">Adres</label>
                        <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group col-md-3">
                        <input type="text" class="form-control-input" id="cphonenumber" name="phonenumber" value="{{ old('phonenumber') }}" required>
                        <label class="label-control" for="cphonenumber">Telefoonnummer</label>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>

                
                <!-- Part 3 Business -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="email" class="form-control-input" id="cemail" name="email" value="{{ old('email') }}" required>
                        <label class="label-control" for="cemail">Email</label>
                        <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group col-md-6">
                        <input type="email" class="form-control-input" id="cemail_confirmation" name="email_confirmation" required>
                        <label class="label-control" for="cemail_confirmation">Bevestig email</label>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                    


                
                <!-- Part 4 Business -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="password" class="form-control-input" id="cpassword" name="password" required>
                        <label class="label-control" for="cpassword">Wachtwoord</label>
                        <div class="help-block with-errors"></div>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <input type="password" class="form-control-input" id="cpassword_confirmation" name="password_confirmation" required>
                        <label class="label-control" for="cpassword_confirmation">Bevestig wachtwoord</label>
                        <div class="help-block with-errors"></div>
                    </div>
                </div>
                    


                

                
                <!-- Part 5 Business -->
                <div class="form-group checkbox">
                    <input type="checkbox" id="callow_guests" name="allow_guests" value="true" @if(old('allow_guests')) checked="checked" @endif>
                    <label for="callow_guests">Klanten zonder account een afspraak laten maken</label>
                    <div class="help-block with-errors"></div>
                </div>




                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="appointmentduration">Lengte afspraak</label>

                        <select class="form-control" name="appointmentduration" id="appointmentduration">
                            <option value="15" @if(old('appointmentduration') == 15) selected @endif>15 min</option>
                            <option value="30" @if(old('appointmentduration') == 30) selected @endif>30 min</option>
                            <option value="60" @if(old('appointmentduration') == 60) selected @endif>1 uur</option>
                        </select>
                    </div>
                </div>



                <div class="">
                    <div class="form-group">
                        <h4>Openingsuren</h4>
                                                
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="openingType" id="continuousBtn" value="continuous" onclick="clickContinuous()" @if(old('openingType') == 'continuous') class="selected" checked="checked" @else(old('openingType') != 'limited') class="selected" checked="checked" @endif>
                            <label class="form-check-label" for="continuousBtn">Doorlopende openingsuren</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="openingType" id="limitedBtn" value="limited" onclick="clickLimited()" @if(old('openingType') == 'limited') class="selected" checked="checked" @endif>
                            <label class="form-check-label" for="limitedBtn">Beperkte openingsuren</label>
                        </div>
                    </div>

                    

                    <!-- MAANDAG -->
                    <div class="dayDiv" id="monday">

                        <div class="">
                            <h4>Maandag</h4>
                            <div class="form-group checkbox">
                                <input type="checkbox" id="is_monday_closed" name="is_monday_closed" value="is_monday_closed" onclick="clickIsClosed('monday')" @if(old('is_monday_closed')) checked="checked" @endif>
                                <label for="is_monday_closed">Vrije dag</label>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>



                        <div class="hoursDiv">
                            <div class="form-group">
                                <label>Openingsuur</label>

                                <input name="monday_open_morning" type="time" @if(old('monday_open_morning')) value="{{ old('monday_open_morning') }}" @else value="09:00" @endif>
                                <input class="limitedInput" name="monday_open_afternoon" type="time" @if(old('monday_open_afternoon')) value="{{ old('monday_open_afternoon') }}" @else value="13:00" @endif disabled>
                            </div>

                            <div class="form-group">
                                <label>Sluitingsuur</label>

                                <input class="limitedInput" name="monday_close_morning" type="time" @if(old('monday_close_morning')) value="{{ old('monday_close_morning') }}" @else value="12:00" @endif disabled>
                                <input name="monday_close_afternoon" type="time" @if(old('monday_close_afternoon')) value="{{ old('monday_close_afternoon') }}" @else value="18:00" @endif>
                            </div>
                        </div>

                    </div>




                    <!-- DINSDAG -->
                    <div class="dayDiv" id="tuesday">
                        <div class="">
                            <h4>Dinsdag</h4>
                            <div class="form-group checkbox">
                                <input type="checkbox" id="is_tuesday_closed" name="is_tuesday_closed" value="is_tuesday_closed" onclick="clickIsClosed('tuesday')" @if(old('is_tuesday_closed')) checked="checked" @endif>
                                <label for="is_tuesday_closed">Vrije dag</label>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        



                        <div class="hoursDiv">
                            <div class="form-group">
                                <label>Openingsuur</label>

                                <input name="tuesday_open_morning" type="time" @if(old('tuesday_open_morning')) value="{{ old('tuesday_open_morning') }}" @else value="09:00" @endif>
                                <input class="limitedInput" name="tuesday_open_afternoon" type="time" @if(old('tuesday_open_afternoon')) value="{{ old('tuesday_open_afternoon') }}" @else value="13:00" @endif disabled>
                            </div>

                            <div class="form-group">
                                <label>Sluitingsuur</label>

                                <input class="limitedInput" name="tuesday_close_morning" type="time" @if(old('tuesday_close_morning')) value="{{ old('tuesday_close_morning') }}" @else value="12:00" @endif disabled>
                                <input name="tuesday_close_afternoon" type="time" @if(old('tuesday_close_afternoon')) value="{{ old('tuesday_close_afternoon') }}" @else value="18:00" @endif>
                            </div>
                        </div>
                    </div>



                    <!-- WOENSDAG -->
                    <div class="dayDiv" id="wednesday">
                        <div class="">
                            <h4>Woensdag</h4>
                            <div class="form-group checkbox">
                                <input type="checkbox" id="is_wednesday_closed" name="is_wednesday_closed" value="is_wednesday_closed" onclick="clickIsClosed('wednesday')" @if(old('is_wednesday_closed')) checked="checked" @endif>
                                <label for="is_wednesday_closed">Vrije dag</label>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                        


                        <div class="hoursDiv">
                            <div class="form-group">
                                <label>Openingsuur</label>

                                <input name="wednesday_open_morning" type="time" @if(old('wednesday_open_morning')) value="{{ old('wednesday_open_morning') }}" @else value="09:00" @endif>
                                <input class="limitedInput" name="wednesday_open_afternoon" type="time" @if(old('wednesday_open_afternoon')) value="{{ old('wednesday_open_afternoon') }}" @else value="13:00" @endif disabled>
                            </div>

                            <div class="form-group">
                                <label>Sluitingsuur</label>

                                <input class="limitedInput" name="wednesday_close_morning" type="time" @if(old('wednesday_close_morning')) value="{{ old('wednesday_close_morning') }}" @else value="12:00" @endif disabled>
                                <input name="wednesday_close_afternoon" type="time" @if(old('wednesday_close_afternoon')) value="{{ old('wednesday_close_afternoon') }}" @else value="18:00" @endif>
                            </div>
                        </div>
                    </div>



                    <!-- DONDERDAG -->
                    <div class="dayDiv" id="thursday">
                        <div class="">
                            <h4>Donderdag</h4>
                            <div class="form-group checkbox">
                                <input type="checkbox" id="is_thursday_closed" name="is_thursday_closed" value="is_thursday_closed" onclick="clickIsClosed('thursday')" @if(old('is_thursday_closed')) checked="checked" @endif>
                                <label for="is_thursday_closed">Vrije dag</label>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>



                        <div class="hoursDiv">
                            <div class="form-group">
                                <label>Openingsuur</label>

                                <input name="thursday_open_morning" type="time" @if(old('thursday_open_morning')) value="{{ old('thursday_open_morning') }}" @else value="09:00" @endif>
                                <input class="limitedInput" name="thursday_open_afternoon" type="time" @if(old('thursday_open_afternoon')) value="{{ old('thursday_open_afternoon') }}" @else value="13:00" @endif disabled>
                            </div>

                            <div class="form-group">
                                <label>Sluitingsuur</label>

                                <input class="limitedInput" name="thursday_close_morning" type="time" @if(old('thursday_close_morning')) value="{{ old('thursday_close_morning') }}" @else value="12:00" @endif disabled>
                                <input name="thursday_close_afternoon" type="time" @if(old('thursday_close_afternoon')) value="{{ old('thursday_close_afternoon') }}" @else value="18:00" @endif>
                            </div>
                        </div>
                    </div>



                    <!-- VRIJDAG -->
                    <div class="dayDiv" id="friday">
                        <div class="">
                            <h4>Vrijdag</h4>
                            <div class="form-group checkbox">
                                <input type="checkbox" id="is_friday_closed" name="is_friday_closed" value="is_friday_closed" onclick="clickIsClosed('friday')" @if(old('is_friday_closed')) checked="checked" @endif>
                                <label for="is_friday_closed">Vrije dag</label>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>



                        <div class="hoursDiv">
                            <div class="form-group">
                                <label>Openingsuur</label>

                                <input name="friday_open_morning" type="time" @if(old('friday_open_morning')) value="{{ old('friday_open_morning') }}" @else value="09:00" @endif>
                                <input class="limitedInput" name="friday_open_afternoon" type="time" @if(old('friday_open_afternoon')) value="{{ old('friday_open_afternoon') }}" @else value="13:00" @endif disabled>
                            </div>

                            <div class="form-group">
                                <label>Sluitingsuur</label>

                                <input class="limitedInput" name="friday_close_morning" type="time" @if(old('friday_close_morning')) value="{{ old('friday_close_morning') }}" @else value="12:00" @endif disabled>
                                <input name="friday_close_afternoon" type="time" @if(old('friday_close_afternoon')) value="{{ old('friday_close_afternoon') }}" @else value="18:00" @endif>
                            </div>
                        </div>
                    </div>




                    <!-- ZATERDAG -->
                    <div class="dayDiv" id="saturday">
                        <div class="">
                            <h4>Zaterdag</h4>
                            <div class="form-group checkbox">
                                <input type="checkbox" id="is_saturday_closed" name="is_saturday_closed" value="is_saturday_closed" onclick="clickIsClosed('saturday')" @if(old('is_saturday_closed')) checked="checked" @endif>
                                <label for="is_saturday_closed">Vrije dag</label>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>


                        <div class="hoursDiv">
                            <div class="form-group">
                                <label>Openingsuur</label>

                                <input name="saturday_open_morning" type="time" @if(old('saturday_open_morning')) value="{{ old('saturday_open_morning') }}" @else value="09:00" @endif>
                                <input class="limitedInput" name="saturday_open_afternoon" type="time" @if(old('saturday_open_afternoon')) value="{{ old('saturday_open_afternoon') }}" @else value="13:00" @endif disabled>
                            </div>
                            
                            <div class="form-group">
                                <label>Sluitingsuur</label>
                            
                                <input class="limitedInput" name="saturday_close_morning" type="time" @if(old('saturday_close_morning')) value="{{ old('saturday_close_morning') }}" @else value="12:00" @endif disabled>
                                <input name="saturday_close_afternoon" type="time" @if(old('saturday_close_afternoon')) value="{{ old('saturday_close_afternoon') }}" @else value="18:00" @endif>
                            </div>

                        </div>
                    </div>




                    <!-- ZONDAG -->
                    <div class="dayDiv" id="sunday">
                        <div class="">
                            <h4>Zondag</h4>
                            <div class="form-group checkbox">
                                <input type="checkbox" id="is_sunday_closed" name="is_sunday_closed" value="is_sunday_closed" onclick="clickIsClosed('sunday')" @if(old('is_sunday_closed')) checked="checked" @endif>
                                <label for="is_sunday_closed">Vrije dag</label>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>




                        <div class="hoursDiv">
                            <div class="form-group">
                                <label>Openingsuur</label>

                                <input name="sunday_open_morning" type="time" @if(old('sunday_open_morning')) value="{{ old('sunday_open_morning') }}" @else value="09:00" @endif>
                                <input class="limitedInput" name="sunday_open_afternoon" type="time" @if(old('sunday_open_afternoon')) value="{{ old('sunday_open_afternoon') }}" @else value="13:00" @endif disabled>
                            </div>

                            <div class="form-group">
                                <label>Sluitingsuur</label>

                                <input class="limitedInput" name="sunday_close_morning" type="time" @if(old('sunday_close_morning')) value="{{ old('sunday_close_morning') }}" @else value="12:00" @endif disabled>
                                <input name="sunday_close_afternoon" type="time" @if(old('sunday_close_afternoon')) value="{{ old('sunday_close_afternoon') }}" @else value="18:00" @endif>
                            </div>
                        </div>
                    </div>
                </div>

                
                <!-- Part 4 Business -->
                
                <!-- ????? -->

            </div>


            <button type="submit" class="form-control-submit-button">REGISTREER</button>
        </form>

    </div>
@stop

@section('script')
    
    <script>
            
            
        $("input, textarea").keyup(function(){
            if ($(this).val() != '') {
                $(this).addClass('notEmpty');
            } else {
                $(this).removeClass('notEmpty');
            }
        });


        var businessForm = document.getElementsByClassName("businessForm")[0];

        var businessInputs = document.querySelectorAll(".businessForm input, .businessForm textarea");
        


        var continuousBtn = document.getElementById("continuousBtn");
        var limitedBtn = document.getElementById("limitedBtn");




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

    
    

        @if(old('openingType') == 'continuous')
            clickContinuous();
        @elseif(old('openingType') == 'limited')
            clickLimited();
        @else
            clickContinuous();
        @endif



        @if(old('is_monday_closed'))
            clickIsClosed('monday');
        @endif

        @if(old('is_tuesday_closed'))
            clickIsClosed('tuesday');
        @endif

        @if(old('is_wednesday_closed'))
            clickIsClosed('wednesday');
        @endif

        @if(old('is_thursday_closed'))
            clickIsClosed('thursday');
        @endif

        @if(old('is_friday_closed'))
            clickIsClosed('friday');
        @endif

        @if(old('is_saturday_closed'))
            clickIsClosed('saturday');
        @endif
        
        @if(old('is_sunday_closed'))
            clickIsClosed('sunday');
        @endif


    </script>
    
@stop