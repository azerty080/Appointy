@extends('layouts.app')

@section('title', 'Registreren')


@section('content')
    <h1>Registreren</h1>

    <div class="contentDiv">
        <form method="POST" action="{{ route('registersubmit') }}">
            @csrf

            <div class="radioGroup">
                <h2>Account type</h2>

                <div class="radioInput">
                    <input type="radio" name="formType" value="client" onclick="clickClient()" id="clientBtn" @if(old('formType') == 'client' || !old('formType')) class="selected" checked="checked" @endif><label for="clientBtn">Klant</label>
                </div>

                <div class="radioInput">
                    <input type="radio" name="formType" value="business" onclick="clickBusiness()" id="businessBtn" @if(old('formType') == 'business') class="selected" checked="checked" @endif><label for="businessBtn">Zaak</label>
                </div>
            </div>
            
            <div class="userForm clientForm">
                <h2>Klant account</h2>
                
                <div class="inputGroup">
                    <div class="soloInput">
                        <label>Voornaam</label>
                        <input name="firstname" type="text" placeholder="Voornaam" value="{{ old('firstname') }}">
                    </div>

                    <div class="soloInput">
                        <label>Achternaam</label>
                        <input name="lastname" type="text" placeholder="Achternaam" value="{{ old('lastname') }}">
                    </div>

                    <div class="soloInput">
                        <label>Geboortedatum</label>
                        <input class="birthdate" name="birthdate" type="date" value="{{ old('birthdate') }}">
                    </div>
                </div>


                <div class="inputGroup">
                    <div class="soloInput">
                        <label>Gemeente</label>
                        <input name="township" type="text" placeholder="Gemeente" value="{{ old('township') }}">
                    </div>

                    <div class="soloInput">
                        <label>Adres</label>
                        <input name="address" type="text" placeholder="Straatnaam 11" value="{{ old('address') }}">
                    </div>

                    <div class="soloInput">
                        <label>Telefoonnummer</label>
                        <input class="phonenumber" name="phonenumber" type="text" placeholder="03 xxx xx xx of 04xx xx xx xx" value="{{ old('phonenumber') }}">
                    </div>
                </div>


                <div class="inputGroup emailInputs">
                    <div class="soloInput">
                        <label>Email</label>
                        <input name="email" type="email" placeholder="email@email.com" value="{{ old('email') }}">
                    </div>

                    <div class="soloInput">
                        <label>Bevestig email</label>
                        <input name="email_confirmation" type="email" placeholder="email@email.com">
                    </div>
                </div>
                
                <div class="inputGroup passwordInputs">
                    <div class="soloInput">
                        <label>Wachtwoord</label>
                        <input name="password" type="password" placeholder="Wachtwoord">
                    </div>

                    <div class="soloInput">
                        <label>Bevestig wachtwoord</label>
                        <input name="password_confirmation" type="password" placeholder="Herhaal wachtwoord">
                    </div>
                </div>
            </div>



            <div class="userForm businessForm">
                <h2>Zaak account</h2>

                
        

                <div class="inputGroup">
                    <div class="soloInput">
                        <label>Naam</label>
                        <input class="name" name="name" type="text" placeholder="Naam van de zaak" value="{{ old('name') }}">
                    </div>

                    <div class="soloInput">
                        <label>Beroep</label>
                        <input class="profession" name="profession" type="text" placeholder="Beroep" value="{{ old('profession') }}">
                    </div>
                </div>

                <div class="soloInput textAreaInput">
                    <label>Beschrijving</label>
                    <textarea name="description" rows="4" cols="50" placeholder="Korte beschrijving over de zaak">{{ old('description') }}</textarea>
                </div>


                <div class="inputGroup">
                    <div class="soloInput">
                        <label>Gemeente</label>
                        <input name="township" type="text" placeholder="Gemeente" value="{{ old('township') }}">
                    </div>

                    <div class="soloInput">
                        <label>Adres</label>
                        <input name="address" type="text" placeholder="Straatnaam 11" value="{{ old('address') }}">
                    </div>

                    <div class="soloInput">
                        <label>Telefoonnummer</label>
                        <input class="phonenumber" name="phonenumber" type="text" placeholder="03 xxx xx xx of 04xx xx xx xx" value="{{ old('phonenumber') }}">
                    </div>
                </div>

                <div class="inputGroup emailInputs">
                    <div class="soloInput">
                        <label>Email</label>
                        <input name="email" type="email" placeholder="email@email.com" value="{{ old('email') }}">
                    </div>

                    <div class="soloInput">
                        <label>Bevestig email</label>
                        <input name="email_confirmation" type="email" placeholder="email@email.com">
                    </div>
                </div>

                <div class="inputGroup passwordInputs">
                    <div class="soloInput">
                        <label>Wachtwoord</label>
                        <input name="password" type="password" placeholder="Wachtwoord">
                    </div>

                    <div class="soloInput">
                        <label>Bevestig wachtwoord</label>
                        <input name="password_confirmation" type="password" placeholder="Herhaal wachtwoord">
                    </div>
                </div>

                
                <div class="checkboxDiv allow_guests">
                    <input type="checkbox" name="allow_guests" value="true" id="allow_guests" @if(old('allow_guests')) checked="checked" @endif> <label for="allow_guests" class="checkmark"></label><label for="allow_guests"><h2>Klanten zonder account een afspraak laten maken</h2></label>
                </div>

                <div class="appointmentduration">
                    <h2>Lengte afspraak</h2>

                    <select name="appointmentduration">
                        <option value="15" @if(old('appointmentduration') == 15) selected @endif>15 min</option>
                        <option value="30" @if(old('appointmentduration') == 30) selected @endif>30 min</option>
                        <option value="60" @if(old('appointmentduration') == 60) selected @endif>1 uur</option>
                    </select>
                </div>


                <div class="openinghours">
                    <div class="radioGroup">
                        <h2>Openingsuren</h2>
                        
                        <div class="radioInput">
                            <input type="radio" name="openingType" value="continuous" onclick="clickContinuous()" id="continuousBtn" @if(old('openingType') == 'continuous' || !old('formType')) class="selected" checked="checked" @endif><label for="continuousBtn">Doorlopende openingsuren</label>
                        </div>

                        <div class="radioInput">
                            <input type="radio" name="openingType" value="limited" onclick="clickLimited()" id="limitedBtn" @if(old('openingType') == 'limited') class="selected" checked="checked" @endif><label for="limitedBtn">Beperkte openingsuren</label>
                        </div>
                    </div>


                    <div class="dayDiv" id="monday">
                        <div class="checkboxDiv isClosedDay">
                            <h3>Maandag</h3>
                            <input type="checkbox" name="is_monday_closed" value="is_monday_closed" id="is_monday_closed" onclick="clickIsClosed('monday')" @if(old('is_monday_closed')) checked="checked" @endif> <label for="is_monday_closed" class="checkmark"></label><label for="is_monday_closed">Vrije dag</label>
                        </div>

                        <div class="hoursDiv">
                            <div>
                                <label>Openingsuur</label>

                                <input name="monday_open_morning" type="time" @if(old('monday_open_morning')) value="{{ old('monday_open_morning') }}" @else value="09:00" @endif>
                                <input class="limitedInput" name="monday_open_afternoon" type="time" @if(old('monday_open_afternoon')) value="{{ old('monday_open_afternoon') }}" @else value="13:00" @endif disabled>
                            </div>

                            <div>
                                <label>Sluitingsuur</label>

                                <input class="limitedInput" name="monday_close_morning" type="time" @if(old('monday_close_morning')) value="{{ old('monday_close_morning') }}" @else value="12:00" @endif disabled>
                                <input name="monday_close_afternoon" type="time" @if(old('monday_close_afternoon')) value="{{ old('monday_close_afternoon') }}" @else value="18:00" @endif>
                            </div>
                        </div>
                    </div>





                    <div class="dayDiv" id="tuesday">
                        <div class="checkboxDiv isClosedDay">
                            <h3>Dinsdag</h3>
                            <input type="checkbox" name="is_tuesday_closed" value="is_tuesday_closed" id="is_tuesday_closed" onclick="clickIsClosed('tuesday')" @if(old('is_tuesday_closed')) checked="checked" @endif> <label for="is_tuesday_closed" class="checkmark"></label><label for="is_tuesday_closed">Vrije dag</label>
                        </div>

                        <div class="hoursDiv">
                            <div>
                                <label>Openingsuur</label>

                                <input name="tuesday_open_morning" type="time" @if(old('tuesday_open_morning')) value="{{ old('tuesday_open_morning') }}" @else value="09:00" @endif>
                                <input class="limitedInput" name="tuesday_open_afternoon" type="time" @if(old('tuesday_open_afternoon')) value="{{ old('tuesday_open_afternoon') }}" @else value="13:00" @endif disabled>
                            </div>

                            <div>
                                <label>Sluitingsuur</label>

                                <input class="limitedInput" name="tuesday_close_morning" type="time" @if(old('tuesday_close_morning')) value="{{ old('tuesday_close_morning') }}" @else value="12:00" @endif disabled>
                                <input name="tuesday_close_afternoon" type="time" @if(old('tuesday_close_afternoon')) value="{{ old('tuesday_close_afternoon') }}" @else value="18:00" @endif>
                            </div>
                        </div>
                    </div>


                    <div class="dayDiv" id="wednesday">
                        <div class="checkboxDiv isClosedDay">
                            <h3>Woensdag</h3>
                            <input type="checkbox" name="is_wednesday_closed" value="is_wednesday_closed" id="is_wednesday_closed" onclick="clickIsClosed('wednesday')" @if(old('is_wednesday_closed')) checked="checked" @endif> <label for="is_wednesday_closed" class="checkmark"></label><label for="is_wednesday_closed">Vrije dag</label>
                        </div>

                        <div class="hoursDiv">
                            <div>
                                <label>Openingsuur</label>

                                <input name="wednesday_open_morning" type="time" @if(old('wednesday_open_morning')) value="{{ old('wednesday_open_morning') }}" @else value="09:00" @endif>
                                <input class="limitedInput" name="wednesday_open_afternoon" type="time" @if(old('wednesday_open_afternoon')) value="{{ old('wednesday_open_afternoon') }}" @else value="13:00" @endif disabled>
                            </div>

                            <div>
                                <label>Sluitingsuur</label>

                                <input class="limitedInput" name="wednesday_close_morning" type="time" @if(old('wednesday_close_morning')) value="{{ old('wednesday_close_morning') }}" @else value="12:00" @endif disabled>
                                <input name="wednesday_close_afternoon" type="time" @if(old('wednesday_close_afternoon')) value="{{ old('wednesday_close_afternoon') }}" @else value="18:00" @endif>
                            </div>
                        </div>
                    </div>


                    <div class="dayDiv" id="thursday">
                        <div class="checkboxDiv isClosedDay">
                            <h3>Donderdag</h3>
                            <input type="checkbox" name="is_thursday_closed" value="is_thursday_closed" id="is_thursday_closed" onclick="clickIsClosed('thursday')" @if(old('is_thursday_closed')) checked="checked" @endif> <label for="is_thursday_closed" class="checkmark"></label><label for="is_thursday_closed">Vrije dag</label>
                        </div>

                        <div class="hoursDiv">
                            <div>
                                <label>Openingsuur</label>

                                <input name="thursday_open_morning" type="time" @if(old('thursday_open_morning')) value="{{ old('thursday_open_morning') }}" @else value="09:00" @endif>
                                <input class="limitedInput" name="thursday_open_afternoon" type="time" @if(old('thursday_open_afternoon')) value="{{ old('thursday_open_afternoon') }}" @else value="13:00" @endif disabled>
                            </div>

                            <div>
                                <label>Sluitingsuur</label>

                                <input class="limitedInput" name="thursday_close_morning" type="time" @if(old('thursday_close_morning')) value="{{ old('thursday_close_morning') }}" @else value="12:00" @endif disabled>
                                <input name="thursday_close_afternoon" type="time" @if(old('thursday_close_afternoon')) value="{{ old('thursday_close_afternoon') }}" @else value="18:00" @endif>
                            </div>
                        </div>
                    </div>


                    <div class="dayDiv" id="friday">
                        <div class="checkboxDiv isClosedDay">
                            <h3>Vrijdag</h3>
                            <input type="checkbox" name="is_friday_closed" value="is_friday_closed" id="is_friday_closed" onclick="clickIsClosed('friday')" @if(old('is_friday_closed')) checked="checked" @endif> <label for="is_friday_closed" class="checkmark"></label><label for="is_friday_closed">Vrije dag</label>
                        </div>

                        <div class="hoursDiv">
                            <div>
                                <label>Openingsuur</label>

                                <input name="friday_open_morning" type="time" @if(old('friday_open_morning')) value="{{ old('friday_open_morning') }}" @else value="09:00" @endif>
                                <input class="limitedInput" name="friday_open_afternoon" type="time" @if(old('friday_open_afternoon')) value="{{ old('friday_open_afternoon') }}" @else value="13:00" @endif disabled>
                            </div>

                            <div>
                                <label>Sluitingsuur</label>

                                <input class="limitedInput" name="friday_close_morning" type="time" @if(old('friday_close_morning')) value="{{ old('friday_close_morning') }}" @else value="12:00" @endif disabled>
                                <input name="friday_close_afternoon" type="time" @if(old('friday_close_afternoon')) value="{{ old('friday_close_afternoon') }}" @else value="18:00" @endif>
                            </div>
                        </div>
                    </div>



                    <div class="dayDiv" id="saturday">
                        <div class="checkboxDiv isClosedDay">
                            <h3>Zaterdag</h3>
                            <input type="checkbox" name="is_saturday_closed" value="is_saturday_closed" id="is_saturday_closed" onclick="clickIsClosed('saturday')" @if(old('is_saturday_closed')) checked="checked" @endif> <label for="is_saturday_closed" class="checkmark"></label><label for="is_saturday_closed">Vrije dag</label>
                        </div>

                        <div class="hoursDiv">
                            <div>
                                <label>Openingsuur</label>

                                <input name="saturday_open_morning" type="time" @if(old('saturday_open_morning')) value="{{ old('saturday_open_morning') }}" @else value="09:00" @endif>
                                <input class="limitedInput" name="saturday_open_afternoon" type="time" @if(old('saturday_open_afternoon')) value="{{ old('saturday_open_afternoon') }}" @else value="13:00" @endif disabled>
                            </div>
                            
                            <div>
                                <label>Sluitingsuur</label>
                            
                                <input class="limitedInput" name="saturday_close_morning" type="time" @if(old('saturday_close_morning')) value="{{ old('saturday_close_morning') }}" @else value="12:00" @endif disabled>
                                <input name="saturday_close_afternoon" type="time" @if(old('saturday_close_afternoon')) value="{{ old('saturday_close_afternoon') }}" @else value="18:00" @endif>
                            </div>

                        </div>
                    </div>



                    <div class="dayDiv" id="sunday">
                        <div class="checkboxDiv isClosedDay">
                            <h3>Zondag</h3>
                            <input type="checkbox" name="is_sunday_closed" value="is_sunday_closed" id="is_sunday_closed" onclick="clickIsClosed('sunday')" @if(old('is_sunday_closed')) checked="checked" @endif> <label for="is_sunday_closed" class="checkmark"></label><label for="is_sunday_closed">Vrije dag</label>
                        </div>

                        <div class="hoursDiv">
                            <div>
                                <label>Openingsuur</label>

                                <input name="sunday_open_morning" type="time" @if(old('sunday_open_morning')) value="{{ old('sunday_open_morning') }}" @else value="09:00" @endif>
                                <input class="limitedInput" name="sunday_open_afternoon" type="time" @if(old('sunday_open_afternoon')) value="{{ old('sunday_open_afternoon') }}" @else value="13:00" @endif disabled>
                            </div>

                            <div>
                                <label>Sluitingsuur</label>

                                <input class="limitedInput" name="sunday_close_morning" type="time" @if(old('sunday_close_morning')) value="{{ old('sunday_close_morning') }}" @else value="12:00" @endif disabled>
                                <input name="sunday_close_afternoon" type="time" @if(old('sunday_close_afternoon')) value="{{ old('sunday_close_afternoon') }}" @else value="18:00" @endif>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <button type="submit">Registreer</button>
        </form>

    </div>
@stop

@section('script')
    
    <script>
        var clientBtn = document.getElementById("clientBtn");
        var businessBtn = document.getElementById("businessBtn");

        var clientForm = document.getElementsByClassName("clientForm")[0];
        var businessForm = document.getElementsByClassName("businessForm")[0];



        var clientInputs = document.querySelectorAll(".clientForm input");
        var businessInputs = document.querySelectorAll(".businessForm input, .businessForm textarea");
        

        function clickClient()
        {
            clientForm.classList.remove('hide');
            businessForm.classList.add('hide');

            clientBtn.classList.add("selected");
            businessBtn.classList.remove("selected");

            for (let i = 0; i < clientInputs.length; i++)
            {
                clientInputs[i].disabled = false;
            }

            for (let i = 0; i < businessInputs.length; i++)
            {
                businessInputs[i].disabled = true;
            }
        }



        var continuousBtn = document.getElementById("continuousBtn");
        var limitedBtn = document.getElementById("limitedBtn");

        function clickBusiness()
        {
            clientForm.classList.add('hide');
            businessForm.classList.remove('hide');

            clientBtn.classList.remove("selected");
            businessBtn.classList.add("selected");

            for (let i = 0; i < clientInputs.length; i++)
            {
                clientInputs[i].disabled = true;
            }

            for (let i = 0; i < businessInputs.length; i++)
            {
                businessInputs[i].disabled = false;
            }


            if (continuousBtn.checked) {
                clickContinuous();
            } else if (limitedBtn.checked) {
                clickLimited();
            }
        }




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

    
        @if(old('formType') == 'business')
            clickBusiness();
        @else
            clickClient();
        @endif

        @if(old('openingType') == 'continuous')
            clickContinuous();
        @elseif(old('openingType') == 'limited')
            clickLimited();
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