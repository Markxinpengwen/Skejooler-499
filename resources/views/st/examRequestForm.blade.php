<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Student View</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>

        <!--Google Maps Script-->
        <script type="text/javascript"
                src="https://maps.google.com/maps/api/js?key=AIzaSyAA4pr6pygT6q-cClvi404Yuvh4AUOeRjk&v=3"></script>

        <!--Default Google Stylesheet-->
        <style>
            /*
            body {
                font-family: Arial, sans-serif;
                font-size: 12px;
            }
            */

            #map-canvas {
                height: 500px;
                width: 600px;
            }

            #visualization {
                height: 400px;
                width: 500px;
            }
        </style>

        <!--Initialize Map script-->
        <script type="text/javascript">
            /* ----- Global Script varaibles --------- */
            //Google Maps
            var map;
            var layer;
            var circle;
            //Filter Values
            var cityValue;
            var radiusValue;
            var supportsOnlineValue;
            //Fusion Table
            var tableId = '1vHtd2HTIiWmfZBfunHoRkTvuJoTG8UXabitBsgok';
            var cityColumn = "City";
            var onlineColumn = "OnlineSupport";
            var addressColumn = "Address";
            var locationColumn = "Latitude";
            //City Table //Any City = Burnaby Default
            var City = [
                'Any City',
                '100 Mile House',
                'Abbotsford',
                'Burnaby',
                'Kelowna'
            ];

            //City Table (sorted by pop.)
            var CityByPop = ['Vancouver', 'Surrey', 'Burnaby', 'Richmond', 'Abbotsford', 'Kelowna', 'Port Coquitlam', 'Delta', 'Kamloops', 'Nanaimo', 'Victoria', 'Chilliwack', 'Maple Ridge', 'Prince George', 'New Westminster', 'North Vancouver', 'Penticton', 'West Vancouver', 'North Cowichan', 'Courtenay', 'Vernon', 'Central Okanagan', 'Campbell River', 'Port Moody', 'Walnut Grove', 'Langley', 'Duncan', 'Parksville', 'Williams Lake', 'White Rock', 'Terrace', 'Cranbrook', 'Pitt Meadows', 'Fort Saint John', 'Port Alberni', 'Quesnel', 'Squamish', 'Powell River', 'Prince Rupert', 'Aldergrove'];

            //City Table (sorted alphabetically)
            var CityAlphabetic = [''];

            //Coord Table (Any City = Burnaby Default)
            var Coord = [
                [49.248775, -122.980531],
                [51.644127, -121.295124],
                [49.050339, -122.304451],
                [49.248775, -122.980531],
                [49.887836, -119.496592],
            ];

            /*-------- Functions --------------*/

            //Function to fill Form elements with marker data.
            function fillForm(data){
                document.getElementById("centerName").value = data.Name.value; //data is type object.
                document.getElementById("centerStreetAddress").value = data.Address.value;
                document.getElementById("centerCity").value = data.City.value;

            }//fillForm

            //Google Maps Default Initialization method.
            function initialize() {

                //Create Map. (Burnaby Default)
                map = new google.maps.Map(document.getElementById('map-canvas'), {
                    center: new google.maps.LatLng(49.248775, -122.9805312),
                    zoom: 11,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });

                //Create Layer ( "where select locationColumn is an existing geocoded column of type location" )
                layer = new google.maps.FusionTablesLayer({
                    query: {
                        select: locationColumn,
                        from: tableId,
                    },
                    map: map,
                    //suppressInfoWindows: true, //to suppress rendering info window when layer feature clicked
                    styles: [{
                        markerOptions: {
                            iconName: "orange_blank" //visit: https://fusiontables.google.com/DataSource?docid=1BDnT5U1Spyaes0Nj3DXciJKa_tuu7CzNRXWdVA#map:id=3 //for a list of all styles
                        }
                    }]
                });

                //Create Circle (Burnaby Default)
                circle = new google.maps.Circle({
                    center: new google.maps.LatLng(49.248775, -122.980531),
                    radius: 2000,
                    map: map,
                    fillColor: '#1ee01a',
                    fillOpacity: 0.1,
                    strokeOpacity: 0.6,
                    strokeWeight: 2,
                    strokeColor: '#329930',
                    clickable: false
                });


                //DOM LISTENERS for initialize() method
                //Fill Form Listener
                google.maps.event.addListener(layer, 'click', function(event) {
                    fillForm(event.row); //from: https://developers.google.com/maps/documentation/javascript/reference?csw=1#FusionTablesMouseEvent
                });

                //'radius'Listener
                google.maps.event.addDomListener(document.getElementById('radius'),
                    'change', function() {
                        updateMap();
                    });

                //'city'Listener
                google.maps.event.addDomListener(document.getElementById('city'),
                    'change', function() {
                        updateMap();
                    });

                //'supportsOnline'Listener
                google.maps.event.addDomListener(document.getElementById('supportsOnline'),
                    'change', function() {
                        updateMap();
                    });

            }//Initialize

            // Update the query sent to the Fusion Table Layer based on user selection.
            function updateMap() {

                //Collect selection values
                cityValue = document.getElementById('city').value;
                radiusValue = document.getElementById('radius').value;
                supportsOnlineValue = document.getElementById('supportsOnline').value;
                var query = "";

                //Set the city section of query
                if (cityValue!="Any City") {
                    if(query.length!=0){
                        query+="AND ";
                    }
                    query += "City = '" + cityValue + "'";
                }

                //Set the supportsOnline section of query
                if(document.getElementById("supportsOnline").checked){
                    if(query.length!=0){
                        query+="AND ";
                    }
                    query += "OnlineSupport = 'Yes'";
                }

                //Set the radius section of query (and update radius label)
                document.getElementById("displayRadius").innerHTML = ""+(radiusValue/1000.0)+" kilometers";
                if(query.length!=0){
                    query+="AND ";
                }
                query += "ST_INTERSECTS("+"Latitude"+", "+"CIRCLE(LATLNG("+Coord[City.indexOf(cityValue)][0]+", "+Coord[City.indexOf(cityValue)][1]+")"+", "+radiusValue+")) "; //Latitude is the location column, because it is paired (two-column) with longitude.

                //Update layer with query
                layer.setOptions({
                    query: {
                        select: "Latitude",
                        from: tableId,
                        where: ""+query+""
                    }
                });

                //Update Circle Radius
                //Remove Circle
                circle.setMap(null); //proper way to remove a circle (https://developers.google.com/maps/documentation/javascript/shapes#circles)
                //Create Circle
                circle = new google.maps.Circle({
                    center: new google.maps.LatLng(Coord[City.indexOf(cityValue)][0], Coord[City.indexOf(cityValue)][1]),
                    radius: parseInt(radiusValue), //parseInt() reqired for variable radius
                    map: map,
                    fillColor: '#1ee01a',
                    fillOpacity: 0.1,
                    strokeOpacity: 0.6,
                    strokeWeight: 2,
                    strokeColor: '#329930',
                    clickable: false
                });

                //Print out record of selection
                console.log("City "+cityValue+" located at: Latitide: "+Coord[City.indexOf(cityValue)][0]+", Longitude: "+Coord[City.indexOf(cityValue)][1]+".\n");
                console.log("FusionLayer Query is: "+layer.query.where+".");

            }//updateMap

            //Adda DOM listener to window to initialize()
            google.maps.event.addDomListener(window, 'load', initialize);


            //Function to recenter google maps element on the selected city.
            function centerOnCity(){
                if(cityValue!="Any City"){
                    map.setCenter(new google.maps.LatLng(Coord[City.indexOf(cityValue)][0], Coord[City.indexOf(cityValue)][1]));
                    map.setZoom(11);
                }else{
                    map.setCenter(new google.maps.LatLng(49.248775, -122.9805312));
                    map.setZoom(9);
                }
                console.log("Re-Center Clicked.");
            }

            //Function to clear elements of the form. //!@#not completed
            function clearForm(section){
                if(section==1){
                    //Invigilation Center Information
                    document.getElementById('centerName').value="";
                    document.getElementById('centerStreetAddress').value="";
                    document.getElementById('centerCity').value="";
                    console.log("Sec.1 Invigilation Center Information [cleared]");
                }
                if(section==2){
                    //Examinee Information
                    document.getElementById('studentFirstName').value="";
                    document.getElementById('studentLastName').value="";
                    document.getElementById('studentPhone').value="";
                    document.getElementById('studentEmail').value="";
                    console.log("Sec.2 Examinee Information [cleared]");
                }
                if(section==3){
                    //Institution Information
                    document.getElementById('institutionName').value="";
                    document.getElementById('institutionStreetAddress').value="";
                    document.getElementById('institutionCity').value="";
                    document.getElementById('institutionContactName').value="";
                    document.getElementById('institutionContactPhone').value="";
                    document.getElementById('institutionContactEmail').value="";
                    console.log("Sec.3 Institution Information [cleared]");
                }
                if(section==4){
                    //Exam Information
                    document.getElementById('courseNumber').value="";
                    document.getElementById('midtermOrFinal').value="Midterm";
                    document.getElementById('examType').value="Paper";
                    document.getElementById('computerRequired').value="";
                    document.getElementById('additionalInformation').value="";
                    console.log("Sec.4 Exam Information [cleared]");
                }

            }//clearForm

        </script>

        <!--Modernizr, and tests-->
        <script src="modernizr-custom.js"></script>
        <script type="text/javascript">
            /*
            console.log("Beginning Modernizr Browser Feature Tests");
            Modernizr = new Modernizr();
            //date ability
            if (Modernizr.inputtypes.date) {
                console.log("Date element SUPPORTED.");
            } else {
                console.log("Date element NOT SUPPORTED.");
            }
            */

            Modernizr.load({
                test: Modernizr.inputtypes.date,
                nope: ['http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/jquery-ui.min.js', 'jquery-ui.css'],
                complete: function () {
                    $('input[type=date]').datepicker({
                        dateFormat: 'yy-mm-dd'
                    });
                }
            });
        </script>
    </head>

    <body>

        <h1>Select A Center</h1>

        <!--Map Element-->
        <div id="map-canvas"></div>


        <h2>Filter Criteria:</h2>
        <!--City Selection-->
        <label>City:</label>
        <select id="city">
            <!--default-->
            <option value="Any City">Any City</option>
            <!--cities-->
            <option value="100 Mile House">100 Mile House [1]</option>
            <option value="Abbotsford">Abbotsford [1]</option>
            <option value="Burnaby">Burnaby [2]</option>
            <option value="Kelowna">Kelowna [0]</option>
        </select>
        <button id="centerButton" type="button" onclick="centerOnCity();">Center To City</button>

        <!--Radius Selection, Range, meters(m)-->
        <br>
        <label>Radius:</label>
        <input id='radius'type='Range'min='0'max='40000'step='500'value='5000'/>
        <label id='displayRadius'></label>

        <!--Online Exams Checkbox-->
        <br>
        <label for='supportsOnline'>Can Support An Online Exam:</label>
        <input id='supportsOnline'type='checkbox'name='supportsOnline'/>
        <br>
        <br>

        <!--NEW LARAVEL FORM-->
        <fieldset>
            {!! Form::open() !!}
            <div>
                <h2>Invigilation Center Info:</h2>
                <button id="clear1" type="button" onclick="clearForm(1);">Clear Section</button>
            </div>
            <div>
                <!--Cneter Information-->
                {!! Form::label('centerName','Center Name:') //Center Name!!}
                {!! Form::text('centerName') !!}
                <br>
                {!! Form::label('centerStreetAddress','Center Street Address:') //Center Street Address!!}
                {!! Form::text('centerStreetAddress') !!}
                <br>
                {!! Form::label('centerCity','Center City:') //Center City!!}
                {!! Form::text('centerCity') !!}
                <br>

                {!! Form::label('centerProvince','Center Province:') //Center Province!!}
                {!! Form::select('centerProvince',[
                    'Canada' => [
                        'British_Columbia' => 'British Columbia' ,
                        'Alberta' => 'Alberta',
                        'Sasketchewan' => 'Sasketchewan',
                        'Manitoba' => 'Manitoba',
                        'Ontario' => 'Ontario',
                        'Quebec' => 'Quebec',
                        'Nova_Scotia' => 'Nova Scotia',
                        'Newfoundland_and_Labrador' => 'Newfoundland and Labrador',
                        'New_Brunswick' => 'New Brunswick',
                        'Prince_Edward_Island' => 'Prince Edward Island',
                        'Yukon' => 'Yukon',
                        'Northwest_Territories' => 'Northwest Territories',
                        'Nunavut' => 'Nunavut',
                    ],
                    'British_Columbia'
                ]); !!}
            </div>

            <div>
                <!--Examinee Information-->
                <h2>Examinee Info:</h2>
                <button id="clear2" type="button" onclick="clearForm(2);">Clear Section</button>
                <br>
                {!! Form::label('studentFirstName','Student First Name:') //Student First Name!!}
                {!! Form::text('studentFirstName') !!}
                <br>
                {!! Form::label('studentLastName','Student Last Name:') //Student Last Name!!}
                {!! Form::text('studentLastName') !!}
                <br>
                {!! Form::label('studentPhone','Student Phone Number:') //Student Phone Number!!}
                {!! Form::number('studentPhone') !!}
                <br>
                {!! Form::label('studentEmail','Student Email Address:') //Student Email!!}
                {!! Form::email('studentEmail') !!}
                <br>
                {!! Form::label('examDate1','Exam Date (First Choice):') //Exam Date 1!!}
                <input type="date" id="'examDate1" />
                <br>
                {!! Form::label('examDate2','Exam Date (Second Choice):') //Exam Date 2!!}
                <input type="date" id="'examDate2" />
                <br>

            </div>
            <div>
                <!--Institution Information-->
                <h2>Institution Info:</h2>
                <button id="clear3" type="button" onclick="clearForm(3);">Clear Section</button>
                <br>
                {!! Form::label('institutionName','Institution Name:') //Institution Name!!}
                {!! Form::text('institutionName') !!}
                <br>
                {!! Form::label('institutionStreetAddress','Institution Street Address:') //Institution Street Address!!}
                {!! Form::text('institutionStreetAddress') !!}
                <br>
                {!! Form::label('institutionCity','Institution City:') //Institution City!!}
                {!! Form::text('institutionCity') !!}
                <br>
                {!! Form::label('institutionProvince','Institution Province:') //Institution Province!!}
                {!! Form::select('institutionProvince',[
                    'Canada' => [
                        'British_Columbia' => 'British Columbia' ,
                        'Alberta' => 'Alberta',
                        'Sasketchewan' => 'Sasketchewan',
                        'Manitoba' => 'Manitoba',
                        'Ontario' => 'Ontario',
                        'Quebec' => 'Quebec',
                        'Nova_Scotia' => 'Nova Scotia',
                        'Newfoundland_and_Labrador' => 'Newfoundland and Labrador',
                        'New_Brunswick' => 'New Brunswick',
                        'Prince_Edward_Island' => 'Prince Edward Island',
                        'Yukon' => 'Yukon',
                        'Northwest_Territories' => 'Northwest Territories',
                        'Nunavut' => 'Nunavut',
                    ],
                    'British_Columbia'
                ]); !!}
                <br>
                {!! Form::label('institutionContactName','Institution Contact Name:') //Institution Contact Name!!}
                {!! Form::text('institutionContactName') !!}
                <br>
                {!! Form::label('institutionContactPhone','Institution Contact Phone:') //Institution Contact Phone!!}
                {!! Form::text('institutionContactPhone') !!}
                <br>
                {!! Form::label('institutionContactEmail','Institution Contact Email:') //Institution Contact Email!!}
                {!! Form::email('institutionContactEmail') !!}

            </div>
            <div>
                <!--Submit Button-->
                {!! Form::submit('Submit Form'); !!}
            </div>
            {!! Form::close() !!}
        </fieldset>




        <!--

        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Login</a>
                        <a href="{{ url('/register') }}">Register</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Laravel
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Documentation</a>
                    <a href="https://laracasts.com">Laracasts</a>
                    <a href="https://laravel-news.com">News</a>
                    <a href="https://forge.laravel.com">Forge</a>
                    <a href="https://github.com/laravel/laravel">GitHub</a>
                </div>
            </div>
        </div>

        -->


    </body>
</html>
