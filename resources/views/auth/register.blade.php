@extends('layouts.app')

@section('title', 'Register')


@section('content')
    <h1>Registreer</h1>
<!--
    <button type="button" onclick="clickClient()" id="clientBtn" class="selected">Klant</button>
    <button type="button" onclick="clickBusiness()" id="businessBtn">Zaak</button>
-->


    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="radioGroup">
            <div class="radioInput">
                <input type="radio" name="formType" value="client" onclick="clickClient()" id="clientBtn" class="selected" checked="checked"><label for="clientBtn">Klant</label>
            </div>

            <div class="radioInput">
                <input type="radio" name="formType" value="business" onclick="clickBusiness()" id="businessBtn"><label for="businessBtn">Zaak</label>
            </div>
        </div>
        
        <div class="clientForm">
            <h2>Klant account</h2>
            
            <div class="inputGroup">
                <div class="soloInput">
                    <label>Voornaam</label>
                    <input name="firstname" type="text">
                </div>

                <div class="soloInput">
                    <label>Achternaam</label>
                    <input name="lastname" type="text">
                </div>

                <div class="soloInput">
                    <label>Geboortedatum</label>
                    <input class="birthdate" name="birthdate" type="date">
                </div>
            </div>


            <div class="inputGroup">
                <div class="soloInput">
                    <label>Gemeente</label>
                    <input name="township" type="text">
                </div>

                <div class="soloInput">
                    <label>Adres</label>
                    <input name="address" type="text">
                </div>

                <div class="soloInput">
                    <label>Telefoonnummer</label>
                    <input class="phonenumber" name="phonenumber" type="text">
                </div>
            </div>

            <div class="soloInput">
                <label>Profielfoto</label>
                <input class="profilepicture" name="profilepicture" type="file">
            </div>



            <div class="inputGroup">
                <div class="soloInput">
                    <label>Email</label>
                    <input name="email" type="email">
                </div>

                <div class="soloInput">
                    <label>Bevestig email</label>
                    <input name="confirmemail_confirmation" type="email">
                </div>
            </div>
            
            <div class="inputGroup">
                <div class="soloInput">
                    <label>Wachtwoord</label>
                    <input name="password" type="password">
                </div>

                <div class="soloInput">
                    <label>Bevestig wachtwoord</label>
                    <input name="password_confirmation" type="password">
                </div>
            </div>
        </div>



        <div class="businessForm">
            <h2>Zaak account</h2>

            <div class="inputGroup">
                <div class="soloGroup">
                    <div class="soloInput">
                        <label>Naam</label>
                        <input class="name" name="name" type="text">
                    </div>

                    <div class="soloInput">
                        <label>Beschrijving</label>
                        <textarea name="lastname" rows="4" cols="50"></textarea>
                    </div>
                </div>


                <div class="soloGroup">
                    <div class="inputGroup">
                        <div class="soloInput">
                            <label>Gemeente</label>
                            <input name="township" type="text">
                        </div>

                        <div class="soloInput">
                            <label>Adres</label>
                            <input name="address" type="text">
                        </div>
                    </div>


                    <div class="soloInput">
                        <label>Extra informatie</label>
                        <textarea name="extrainfo" rows="4" cols="50"></textarea>
                    </div>
                </div>
            </div>



            <div class="soloInput">
                <label>Telefoonnummer</label>
                <input class="phonenumber" name="phonenumber" type="text">
            </div>


            <div class="soloInput">
                <label>Profielfoto</label>
                <input class="profilepicture" name="profilepicture" type="file">
            </div>

            <div class="inputGroup">
                <div class="soloInput">
                    <label>Email</label>
                    <input name="email" type="email">
                </div>

                <div class="soloInput">
                    <label>Bevestig email</label>
                    <input name="email_confirmation" type="email">
                </div>
            </div>

            <div class="inputGroup">
                <div class="soloInput">
                    <label>Wachtwoord</label>
                    <input name="password" type="password">
                </div>

                <div class="soloInput">
                    <label>Bevestig wachtwoord</label>
                    <input name="password_confirmation" type="password">
                </div>
            </div>





            <h2>Openingsuren</h2>

            <div class="openinghours">
                <div class="radioGroup">
                    <div class="radioInput">
                        <input type="radio" name="openingType" value="continuous" onclick="clickContinuous()" id="continuousBtn" class="selected" checked="checked"><label for="continuousBtn">openingsuren</label>
                    </div>

                    <div class="radioInput">
                        <input type="radio" name="openingType" value="limited" onclick="clickLimited()" id="limitedBtn"><label for="limitedBtn">Beperkte openingsuren</label>
                    </div>
                </div>



                <div class="dayDiv" id="monday">
                    <div class="checkboxDiv">
                        <h3>Maandag</h3>
                        <input type="checkbox" name="is_monday_closed" value="is_monday_closed" id="is_monday_closed" onclick="clickIsClosed('monday')"> <label for="is_monday_closed">Vrije dag</label>
                    </div>

                    <div class="hoursDiv">
                        <div>
                            <label>Openingsuur</label>

                            <input name="monday_open_morning" type="time" value="06:00">
                            <input class="limitedInput" name="monday_open_afternoon" type="time" value="13:00" disabled>
                        </div>

                        <div>
                            <label>Sluitingsuur</label>

                            <input class="limitedInput" name="monday_close_morning" type="time" value="12:00" disabled>
                            <input name="monday_close_afternoon" type="time" value="18:00">
                        </div>
                    </div>
                </div>





                <div class="dayDiv" id="tuesday">
                    <div class="checkboxDiv">
                        <h3>Dinsdag</h3>
                        <input type="checkbox" name="is_tuesday_closed" value="is_tuesday_closed" id="is_tuesday_closed" onclick="clickIsClosed('tuesday')"> <label for="is_tuesday_closed">Vrije dag</label>
                    </div>

                    <div class="hoursDiv">
                        <div>
                            <label>Openingsuur</label>

                            <input name="tuesday_open_morning" type="time" value="06:00">
                            <input class="limitedInput" name="tuesday_open_afternoon" type="time" value="13:00" disabled>
                        </div>

                        <div>
                            <label>Sluitingsuur</label>

                            <input class="limitedInput" name="tuesday_close_morning" type="time" value="12:00" disabled>
                            <input name="tuesday_close_afternoon" type="time" value="18:00">
                        </div>
                    </div>
                </div>


                <div class="dayDiv" id="wednesday">
                    <div class="checkboxDiv">
                        <h3>Woensdag</h3>
                        <input type="checkbox" name="is_wednesday_closed" value="is_wednesday_closed" id="is_wednesday_closed" onclick="clickIsClosed('wednesday')"> <label for="is_wednesday_closed">Vrije dag</label>
                    </div>

                    <div class="hoursDiv">
                        <div>
                            <label>Openingsuur</label>

                            <input name="wednesday_open_morning" type="time" value="06:00">
                            <input class="limitedInput" name="wednesday_open_afternoon" type="time" value="13:00" disabled>
                        </div>

                        <div>
                            <label>Sluitingsuur</label>

                            <input class="limitedInput" name="wednesday_close_morning" type="time" value="12:00" disabled>
                            <input name="wednesday_close_afternoon" type="time" value="18:00">
                        </div>
                    </div>
                </div>


                <div class="dayDiv" id="thursday">
                    <div class="checkboxDiv">
                        <h3>Donderdag</h3>
                        <input type="checkbox" name="is_thursday_closed" value="is_thursday_closed" id="is_thursday_closed" onclick="clickIsClosed('thursday')"> <label for="is_thursday_closed">Vrije dag</label>
                    </div>

                    <div class="hoursDiv">
                        <div>
                            <label>Openingsuur</label>

                            <input name="thursday_open_morning" type="time" value="06:00">
                            <input class="limitedInput" name="thursday_open_afternoon" type="time" value="13:00" disabled>
                        </div>

                        <div>
                            <label>Sluitingsuur</label>

                            <input class="limitedInput" name="thursday_close_morning" type="time" value="12:00" disabled>
                            <input name="thursday_close_afternoon" type="time" value="18:00">
                        </div>
                    </div>
                </div>


                <div class="dayDiv" id="friday">
                    <div class="checkboxDiv">
                        <h3>Vrijdag</h3>
                        <input type="checkbox" name="is_friday_closed" value="is_friday_closed" id="is_friday_closed" onclick="clickIsClosed('friday')"> <label for="is_friday_closed">Vrije dag</label>
                    </div>

                    <div class="hoursDiv">
                        <div>
                            <label>Openingsuur</label>

                            <input name="friday_open_morning" type="time" value="06:00">
                            <input class="limitedInput" name="friday_open_afternoon" type="time" value="13:00" disabled>
                        </div>

                        <div>
                            <label>Sluitingsuur</label>

                            <input class="limitedInput" name="friday_close_morning" type="time" value="12:00" disabled>
                            <input name="friday_close_afternoon" type="time" value="18:00">
                        </div>
                    </div>
                </div>



                <div class="dayDiv" id="saturday">
                    <div class="checkboxDiv">
                        <h3>Zaterdag</h3>
                        <input type="checkbox" name="is_saturday_closed" value="is_saturday_closed" id="is_saturday_closed" onclick="clickIsClosed('saturday')"> <label for="is_saturday_closed">Vrije dag</label>
                    </div>

                    <div class="hoursDiv">
                        <div>
                            <label>Openingsuur</label>

                            <input name="saturday_open_morning" type="time" value="06:00">
                            <input class="limitedInput" name="saturday_open_afternoon" type="time" value="13:00" disabled>
                        </div>
                        
                        <div>
                            <label>Sluitingsuur</label>
                        
                            <input class="limitedInput" name="saturday_close_morning" type="time" value="12:00" disabled>
                            <input name="saturday_close_afternoon" type="time" value="18:00">
                        </div>

                    </div>
                </div>



                <div class="dayDiv" id="sunday">
                    <div class="checkboxDiv">
                        <h3>Zondag</h3>
                        <input type="checkbox" name="is_sunday_closed" value="is_sunday_closed" id="is_sunday_closed" onclick="clickIsClosed('sunday')"> <label for="is_sunday_closed">Vrije dag</label>
                    </div>

                    <div class="hoursDiv">
                        <div>
                            <label>Openingsuur</label>

                            <input name="sunday_open_morning" type="time" value="06:00">
                            <input class="limitedInput" name="sunday_open_afternoon" type="time" value="13:00" disabled>
                        </div>

                        <div>
                            <label>Sluitingsuur</label>

                            <input class="limitedInput" name="sunday_close_morning" type="time" value="12:00" disabled>
                            <input name="sunday_close_afternoon" type="time" value="18:00">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        
        <button type="submit">Registreer</button>
    </form>
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
        }




        var continuousBtn = document.getElementById("continuousBtn");
        var limitedBtn = document.getElementById("limitedBtn");


        var limitedInput = document.getElementsByClassName("limitedInput");

        function clickContinuous()
        {
            for (let i = 0; i < limitedInput.length; i++)
            {
                limitedInput[i].classList.add('hide');
                limitedInput[i].disabled = true;
            }
            

            continuousBtn.classList.add("selected");
            limitedBtn.classList.remove("selected");
        }

        function clickLimited()
        {
            for (let i = 0; i < limitedInput.length; i++)
            {
                limitedInput[i].classList.remove('hide');
                limitedInput[i].disabled = false;
            }

            continuousBtn.classList.remove("selected");
            limitedBtn.classList.add("selected");
        }



        function clickIsClosed(day) {
            var hoursDiv = document.getElementById(day).getElementsByClassName('hoursDiv')[0];
            
            hoursDiv.classList.toggle('hide');
        }

        clickClient();
        clickContinuous();
    </script>
    
@stop