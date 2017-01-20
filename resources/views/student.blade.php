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
                    document.getElementById('firstName').value="";
                    document.getElementById('lastName').value="";
                    document.getElementById('phone').value="";
                    document.getElementById('email').value="";
                    console.log("Sec.2 Examinee Information [cleared]");
                }
                if(section==3){
                    //Institution Information
                    console.log("Sec.3 Institution Information [cleared]");
                }
                if(section==4){
                    //Exam Information
                    console.log("Sec.4 Exam Information [cleared]");
                }

            }//clearForm

        </script>

    </head>

    <body>

        <h1>Select A Center</h1>

        <!--Map Element-->
        <div id="map-canvas"></div>


        <h3>Filter Criteria:</h3>
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

        <!--NEW LARAVEL FORM-->
        <fieldset>
            {!! Form::open() !!}
            <div>
                <h2>Form:</h2>
                <button id="clear1" type="button" onclick="clearForm(1);">Clear Section</button>
            </div>
            <div>
                {!! Form::label('centerName','Center Name:') //Center Name!!}
                {!! Form::text('centerName') !!}
                <br>
                {!! Form::label('centerStreetAddress','Center Street Address:') //Center Street Address!!}
                {!! Form::text('centerStreetAddress') !!}
                <br>
                {!! Form::label('centerCity','Center City:') //Center City!!}
                {!! Form::text('centerCity') !!}
                <br>
                {!! Form::label('centerName','Center Name:') //Center Name!!}
                {!! Form::text('centerName') !!}
                <br>
                {!! Form::label('centerProvince','Center Province:') //Center Province!!}
                <select id="centerProvince">
                    <option value="British_Columbia">British Columbia</option>
                    <option value="Alberta">Alberta</option>
                    <option value="Sasketchewan">Sasketchewan</option>
                    <option value="Manitoba">Manitoba</option>
                    <option value="Ontario">Ontario</option>
                    <option value="Quebec">Quebec</option>
                    <option value="Nova_Scotia">Nova Scotia</option>
                    <option value="Newfoundland_and_Labrador">Newfoundland and Labrador</option>
                    <option value="New_Brunswick">New Brunswick</option>
                    <option value="Prince_Edward_Island">Prince Edward Island</option>
                    <option value="Yukon">Yukon</option>
                    <option value="Northwest_Territories">Northwest Territories</option>
                    <option value="Nunavut">Nunavut</option>
                </select>
            </div>

            {!! Form::close() !!}
        </fieldset>

        <!--Form Elements (Don't forget to add required)-->
        <br>
        <hr>
        <br>
        <form>
            <fieldset>
                <legend>Invigilation Center Information</legend>

                <br>
                <label>Center Province:</label>

            </fieldset>
        </form>

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

    </body>
</html>
