@extends("st.layouts.app")

@section('title', 'Exam Request Form')

@section('main-content')

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            /*Skejooler Colour Variable #52ffe5*/
            :root{

            }

            html, body {
                background-color: #fff;
                color: #000000; /*was 636B6F*/
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            /*Form Fields*/

            /* from: http://jsfiddle.net/bQ859/  */
            .required:after {
                content:" ***";
                color: red;
                /*font-size: x-large;*/

            }

            .tableForm{
                /*NOT WORKING*/
                --skejooler-color: #52ffe5;
            }

            .tableForm tr{
                /*color: #CC00FF; /*test remove*/
                text-align: left;
                padding: 20px 5px 20px 10px;
            }

            .tableForm input[type=text] {
                border: 2px solid lightgray;
                border-radius: 2px;
            }

            .tableForm input[type=text]:focus,input[type=email]:focus, input[type=number]:focus, input[type=date]:focus {
                border: 2px solid;
                border-color: #207dff;
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
            #map-canvas {
                height: 500px;
                width: 600px;
            }

            #visualization {
                height: 400px;
                width: 500px;
            }

            .googft-info-window{
                color: #000000;
                text-align: left;
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

            //Old City Table //Any City = Burnaby Default
            var City = [
                'Any City',
                '100_Mile_House',
                'Abbotsford',
                'Burnaby',
                'Kelowna'
            ];

            //Old Coord Table
            var Coord = [
                [49.248775, -122.980531], //any city
                [51.644127, -121.295124], //100 mile
                [49.050339, -122.304451], //abbotsford
                [49.248775, -122.980531], //burnaby
                [49.887836, -119.496592], //kelowna
            ];

            //City Table (sorted by pop.; unused)
            //var CityByPop = ['Vancouver', 'Surrey', 'Burnaby', 'Richmond', 'Abbotsford', 'Kelowna', 'Port Coquitlam', 'Delta', 'Kamloops', 'Nanaimo', 'Victoria', 'Chilliwack', 'Maple Ridge', 'Prince George', 'New Westminster', 'North Vancouver', 'Penticton', 'West Vancouver', 'North Cowichan', 'Courtenay', 'Vernon', 'Central Okanagan', 'Campbell River', 'Port Moody', 'Walnut Grove', 'Langley', 'Duncan', 'Parksville', 'Williams Lake', 'White Rock', 'Terrace', 'Cranbrook', 'Pitt Meadows', 'Fort Saint John', 'Port Alberni', 'Quesnel', 'Squamish', 'Powell River', 'Prince Rupert', 'Aldergrove'];

            //City Table (sorted alphabetically)
            var CityAlphabetic = ["Any City", "100_Mile_House","Abbotsford","Aldergrove","Burnaby","Campbell_River","Central_Okanagan","Chilliwack","Courtenay","Cranbrook","Delta","Duncan","Fort_Saint_John","Kamloops","Kelowna","Langley","Maple_Ridge","Nanaimo","New_Westminster","North_Cowichan","North_Vancouver","Parksville","Penticton","Pitt_Meadows","Port_Alberni","Port_Coquitlam","Port_Moody","Powell_River","Prince_George","Prince_Rupert","Quesnel","Richmond","Squamish","Surrey","Terrace","Vancouver","Vernon","Victoria","Walnut_Grove","West_Vancouver","White_Rock","Williams_Lake"];
            console.log("CA size ="+CityAlphabetic.length+".");

            //Coord Table (Any City = Burnaby Default)
            var CoordAlphabetic = [
                [49.248775, -122.980531], //any city
                [51.644127, -121.295124], //100 mile
                [49.050438,-122.30447], //abbotsford
                [49.058052,-122.470667],                 //aldergrove
                [49.248809,-122.98051], //burnaby
                [50.033123,-125.273335],                 //campble river
                [49.947366,-119.558821],                 //central okanagan
                [49.15794,-121.951467],                 //chilliwack
                [49.684139,-124.990449],                 //courtenay
                [49.512968,-115.769401],                 //cranbrook
                [49.095215,-123.026476],                 //delta
                [48.778691,-123.707942],                 //duncan
                [56.252423,-120.846409],                 //fort s j
                [50.674522,-120.327267],                 //
                [49.887952,-119.496011], //kelowna
                [49.104178,-122.660352],                 //
                [49.219323,-122.598398],                 //
                [49.165884,-123.940065],                 //
                [49.205718,-122.910956],                 //
                [48.842857,-123.704401],                 //
                [49.319982,-123.072414],                 //
                [49.319338,-124.313641],                 //
                [49.499138,-119.593708],                 //
                [49.219065,-122.689516],                 //
                [49.233888,-124.805549],                 //
                [49.262838,-122.781071],                 //
                [49.284911,-122.867756],                 //
                [49.835235,-124.524706],                 //
                [53.917064,-122.749669],                 //
                [54.315037,-130.320819],                 //
                [52.981737,-122.494906],                 //
                [49.166591,-123.133569],                 //
                [49.701634,-123.155812],                 //
                [49.10443,-122.801094],                 //
                [54.518192,-128.603154],                 //
                [49.282729,-123.120738],                 //
                [50.267014,-119.272011],                 //
                [48.428421,-123.365644],                 //
                [49.175003,-122.624019],                 //
                [49.334897,-123.166785],                 //
                [49.025309,-122.802962],                 //
                [52.141674,-122.141688]              //                 //

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
                        updateMap(false);
                    });

                //'city'Listener
                google.maps.event.addDomListener(document.getElementById('city'),
                    'change', function() {
                        updateMap(true);
                    });

                //'supportsOnline'Listener
                google.maps.event.addDomListener(document.getElementById('supportsOnline'),
                    'change', function() {
                        updateMap(false);
                    });

            }//Initialize

            // Update the query sent to the Fusion Table Layer based on user selection.
            function updateMap(shouldRecenter) {

                //Collect selection values
                cityValue = document.getElementById('city').value;
                    console.log("cityValue is:"+cityValue+".");//!@#
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

                //Update Radius Label
                if(radiusValue==0){
                    document.getElementById("displayRadius").innerHTML = "All Centers";
                }else {
                    document.getElementById("displayRadius").innerHTML = "" + (radiusValue / 1000.0) + " kilometers";
                }

                //Set the radius section of query
                if(query.length!=0){
                    query+="AND ";
                }
                query += "ST_INTERSECTS("+"Latitude"+", "+"CIRCLE(LATLNG("+CoordAlphabetic[CityAlphabetic.indexOf(cityValue)][0]+", "+CoordAlphabetic[CityAlphabetic.indexOf(cityValue)][1]+")"+", "+radiusValue+")) "; //Latitude is the location column, because it is paired (two-column) with longitude.

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
                    center: new google.maps.LatLng(CoordAlphabetic[CityAlphabetic.indexOf(cityValue)][0], CoordAlphabetic[CityAlphabetic.indexOf(cityValue)][1]),
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
                console.log("City "+cityValue+" located at: Latitide: "+CoordAlphabetic[CityAlphabetic.indexOf(cityValue)][0]+", Longitude: "+CoordAlphabetic[CityAlphabetic.indexOf(cityValue)][1]+".\n");
                console.log("FusionLayer Query is: "+layer.query.where+".");

                //Recenter
                if(shouldRecenter) {
                    centerOnCity();
                }
            }//updateMap

            //Adda DOM listener to window to initialize()
            google.maps.event.addDomListener(window, 'load', initialize);


            //Function to recenter google maps element on the selected city.
            function centerOnCity(){
                if(cityValue!="Any City"){
                    map.setCenter(new google.maps.LatLng(CoordAlphabetic[CityAlphabetic.indexOf(cityValue)][0], CoordAlphabetic[CityAlphabetic.indexOf(cityValue)][1]));
                    map.setZoom(11);
                }else{
                    map.setCenter(new google.maps.LatLng(49.248775, -122.9805312));
                    map.setZoom(9);
                }
                console.log("Re-Centered");
            }

            //Function to clear elements of the form. //!@#not completed
            function clearForm(section){
                if(section==1){
                    //Invigilation Center Information
                    document.getElementById('center_name').value="";
                    document.getElementById('street_address').value="";
                    document.getElementById('city').value="";
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
                    //Institution Information (some not used currently)
                    document.getElementById('institution_name').value="";
                    document.getElementById('institutionStreetAddress').value="";
                    document.getElementById('institutionCity').value="";
                    document.getElementById('institutionContactName').value="";
                    document.getElementById('institutionContactPhone').value="";
                    document.getElementById('institutionContactEmail').value="";
                    console.log("Sec.3 Institution Information [cleared]");
                }
                if(section==4){
                    //Exam Information
                    document.getElementById('course_code').value="";
                    document.getElementById('exam_type').value="Midterm";
                    document.getElementById('exam_medium').value="Paper";
                    document.getElementById('computer_required').value="No";
                    document.getElementById('additional_requirements').value="";
                    console.log("Sec.4 Exam Information [cleared]");
                }

            }//clearForm

        </script>

    </head>


        <table class="tableForm">
            <tr>
                <th colspan = "3"><h1>Step 1 - Select A Center</h1></th>
            </tr>
            <tr>
                <th colspan = "2"><h2><em>Filter Criteria</em></h2></th>
            </tr>
            <tr>
                <td> {!! Form::label('labelCity','City') !!} </td>
                <td>
                    <!--//!@# need to fix optgroup potential error in laravel select form-->
                    <select id="city">
                        <!--default-->
                        <optgroup label="Default">
                            <option value="Any City" default>Any City</option>
                        </optgroup>
                        <optgroup label="British Columbia">
                            <!--cities, alphabetic-->
                            <option value="100_Mile_House">100 Mile House [1]</option>
                            <option value="Abbotsford">Abbotsford [1]</option>
                            <option value="Aldergrove">Aldergrove </option>
                            <option value="Burnaby">Burnaby [2]</option>
                            <option value="Campbell_River">Campbell River </option>
                            <option value="Central_Okanagan">Central Okanagan </option>
                            <option value="Chilliwack">Chilliwack </option>
                            <option value="Courtenay">Courtenay </option>
                            <option value="Cranbrook">Cranbrook </option>
                            <option value="Delta">Delta </option>
                            <option value="Duncan">Duncan </option>
                            <option value="Fort_Saint_John">Fort Saint John </option>
                            <option value="Kamloops">Kamloops </option>
                            <option value="Kelowna">Kelowna[0]</option>
                            <option value="Langley">Langley </option>
                            <option value="Maple_Ridge">Maple Ridge </option>
                            <option value="Nanaimo">Nanaimo </option>
                            <option value="New_Westminster">New Westminster </option>
                            <option value="North_Cowichan">North Cowichan </option>
                            <option value="North_Vancouver">North Vancouver </option>
                            <option value="Parksville">Parksville </option>
                            <option value="Penticton">Penticton </option>
                            <option value="Pitt_Meadows">Pitt Meadows </option>
                            <option value="Port_Alberni">Port Alberni </option>
                            <option value="Port_Coquitlam">Port Coquitlam </option>
                            <option value="Port_Moody">Port Moody </option>
                            <option value="Powell_River">Powell River </option>
                            <option value="Prince_George">Prince George </option>
                            <option value="Prince_Rupert">Prince Rupert </option>
                            <option value="Quesnel">Quesnel </option>
                            <option value="Richmond">Richmond </option>
                            <option value="Squamish">Squamish </option>
                            <option value="Surrey">Surrey </option>
                            <option value="Terrace">Terrace </option>
                            <option value="Vancouver">Vancouver </option>
                            <option value="Vernon">Vernon </option>
                            <option value="Victoria">Victoria </option>
                            <option value="Walnut_Grove">Walnut Grove </option>
                            <option value="West_Vancouver">West_Vancouver </option>
                            <option value="White_Rock">White Rock</option>
                            <option value="Williams_Lake">Williams Lake </option>
                        </optgroup>
                    </select>

                </td>
                <td>
                    <button id="centerButton" type="button" onclick="centerOnCity();">Center To City</button>
                </td>
            </tr>
            <tr>
                <td> {!! Form::label('labelRadius','Radius') !!} </td>
                <td> <input id='radius'type='Range'min='0'max='40000'step='500'value='0'/> </td>
                <td> <label id='displayRadius'></label> </td>
            </tr>
            <tr>
                <td> {!! Form::label('supportsOnline','Support for Online Exams') !!} </td>
                <td> {!! Form::checkbox('supportsOnline') !!}</td>
            </tr>
            <tr>
                <td>.</td>
            </tr>
        </table>



        <!--Map Element-->
        <div id="map-canvas"></div>
        <br>


        <!--New Form Table-->
        <table class="tableForm">
            {{ Form::open() }}
            <tr>
                <th colspan = "2"><h1>Step 2 - Complete Your Exam Form</h1></th>
            </tr>

            <!--Section 1): Invigilation Center-->

            <tr>
                <th colspan = "2"><h2><em>Invigilation Center</em></h2></th>
            </tr>
            <tr>
                <td class="required"> {{ Form::label('center_name','Center Name:') }} </td>
                <td> {!! Form::text('center_name') !!} </td>
            </tr>
            <tr>
                <td class="required"> {!! Form::label('street_address','Center Street Address:') //Center Street Address!!} </td>
                <td> {!! Form::text('street_address') !!} </td>
            </tr>
            <tr>
                <td class="required"> {!! Form::label('city','Center City:') //Center City!!} </td>
                <td> {!! Form::text('city') !!} </td>
            </tr>
            <tr>
                <td class="required"> {!! Form::label('province','Center Province:') //Center Province!!} </td>
                <td>
                    {!! Form::select('province',[
                        'Canada' => [
                            'british_columbia' => 'British Columbia' ,
                            'alberta' => 'Alberta',
                            'sasketchewan' => 'Sasketchewan',
                            'manitoba' => 'Manitoba',
                            'ontario' => 'Ontario',
                            'quebec' => 'Quebec',
                            'nova_Scotia' => 'Nova Scotia',
                            'newfoundland_and_Labrador' => 'Newfoundland and Labrador',
                            'new_Brunswick' => 'New Brunswick',
                            'prince_edward_island' => 'Prince Edward Island',
                            'Yukon' => 'Yukon',
                            'Northwest_Territories' => 'Northwest Territories',
                            'Nunavut' => 'Nunavut',
                        ],
                    ]) !!}
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button id="clear1" type="button" onclick="clearForm(1);">Clear Section</button>
                </td>
            </tr>
            {{--{{ var_dump($student) }}--}}
            <!-- Section 2: Examinee-->
            <tr></tr>
            <tr>
                <th colspan = "2"><h2><em>Examinee (i.e. You)</em></h2></th>
            </tr>
            <tr>
                <td class="required">Name</td>
                <td>{{ $student->firstName }} {{ $student->lastName }}</td>
            </tr>
            <tr>
                <td class="required">Phone</td>
                <td>{{ $student->phone }}</td>
            </tr>
            <tr>
                <td class="required">Email Address</td>
                <td>{{ $student_email }}</td>
            </tr>

            <tr>
                <td class="required"> {!! Form::label('preferred_date_1','Exam Date (First Choice):') //Exam Date 1!!} </td>
                <td> {!! Form::datetime('preferred_date_1', \Carbon\Carbon::now()); !!} </td>

            </tr>
            <tr>
                <td class="required"> {!! Form::label('preferred_date_2','Exam Date (Second Choice):') //Exam Date 2!!} </td>
                <td> {!! Form::datetime('preferred_date_2', \Carbon\Carbon::now()); !!} </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button id="clear2" type="button" onclick="clearForm(2);">Clear Section</button>
                </td>
            </tr>
{{--            {{ var_dump($institution) }}--}}
            <!-- Section 3: Institution Info-->

            <tr></tr>
            <tr>
                <th colspan = "2"><h2><em>Institution</em></h2></th>
            </tr>
            <tr>
                <td class="required">Institution Name</td>
                <td>{{ $institution->institution_name }}</td>
            </tr>
            <!-- Not currently accepting Institution Information in database-->
            <tr>
                <td class="required">Institution Address</td>
                <td>
                    {{ $institution->street_address }}<br>
                    {{ $institution->city }}, {{ $institution->province }}<br>
                    {{ $institution->country }},<br>
                    {{ $institution->postal_code }}
                </td>
            </tr>
            <tr>
                <td>Contact Name</td>
                <td> {{ $institution->contact_name }} </td>
            </tr>
            <tr>
                <td>Contact Phone</td>
                <td>{{ $institution->contact_phone }}</td>
            </tr>
            <tr>
                <td>Contact Email</td>
                <td>{{ $institution->contact_email }}</td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button id="clear3" type="button" onclick="clearForm(3);">Clear Section</button>
                </td>
            </tr>

            <!-- Section 4: Examination Info-->

            <tr></tr>
            <tr>
                <th colspan = "2"><h2><em>Exam</em></h2></th>
            </tr>
            <tr>
                <td class="required"> {!! Form::label('course_code','Course Number:') //Course Number!!} </td>
                <td> {!! Form::text('course_code') !!} </td>
            </tr>
            <tr>
                <td class="required"> {!! Form::label('exam_type','Midterm or Final:') //Course Midterm or Final!!}</td>
                <td> {!! Form::select('exam_type', ['Midterm' => 'Midterm', 'Final' => 'Final'], 'Final'); !!}</td>
            </tr>
            <tr>
                <td class="required"> {!! Form::label('exam_medium','Exam Type:') //Course Exam Type!!}</td>
                <td> {!! Form::select('exam_medium', ['Paper' => 'Paper', 'Online' => 'Online', 'Other' => 'Other'], 'Paper'); !!}</td>
            </tr>
            <tr>
                <td class="required"> {!! Form::label('computer_required','Computer Required:') //Course Computer Required!!}</td>
                <td> {!! Form::select('computer_required', ['Yes'=>'Yes','No'=>'No'], 'No'); !!}</td>
            </tr>
            <tr>
                <td> {!! Form::label('additional_requirements','Additional Requirements or Information:') //Course Additional Requirements!!} </td>
                <td> {!! Form::textarea('additional_requirements') !!} </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button id="clear4" type="button" onclick="clearForm(4);">Clear Section</button>
                </td>
            </tr>

            <!-- Submit-->

            <tr><td>.</td></tr>
            <tr><td>.</td></tr>
            <tr>
                <td></td>
                <td>{!! Form::submit('Book Exam!') !!}</td>
            </tr>
            {{ Form::close() }}
        </table>

    </body>
</html>

@stop