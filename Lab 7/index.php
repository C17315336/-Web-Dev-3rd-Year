<!DOCTYPE html>
<html>

<head>
    <title>CV</title>
    <link id="pagestyle" rel="stylesheet" type="text/css" href="./Professional.css">
    <link href="https://fonts.gstatic.com/s/googlesans/v14/4UaGrENHsxJlGDuGo1OIlL3Kwp5eKQtGBlc.woff2" rel="stylesheet">
    <link href="https://fonts.gstatic.com/s/productsans/v10/pxiDypQkot1TnFhsFMOfGShVE9eOYktMqlap.woff2" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        function swapStyleSheet(sheet) {
            document.getElementById('pagestyle').setAttribute('href', sheet);
        }

        function check() {
            document.getElementById('f1').innerHTML = "Welcome to my CV " + document.myform.firstname.value + " " + document.myform.lastname.value + "!";
        }

        $(document).ready(function() {
            $("button").click(function() {
                $(".letter").load("Cover.txt", 'utf-8');
            });
        });

    </script>

</head>

<body onload="myTime();">
    <a href="https://www.dit.ie" target="_blank"><img class="pics1" src="images/DIT.png"></a>
    <h1 id='f1'>Welcome to my CV</h1>
    <h4>What is your name?<br>
        <form name='myform'>
            <p><input type='text' name='firstname' placeholder='First Name'></p>
            <p><input type='text' name='lastname' placeholder='Last Name'></p>
            <p><input type='submit' onclick='check(); return false'></p>
        </form>
    </h4>
    <h4>Change page style</h4>
    <button class="myButtonP" onclick="swapStyleSheet('./Professional.css')">Pro</button>
    <button class="myButtonP" onclick="swapStyleSheet('./Creative.css')">Fun</button>
    <br>
    <br>
    <br>
    <br><br>
    <h6 align="right" id="timeslot"><span onclick="colour0();"></span></h6>
    <hr>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc eget auctor purus. Donec ac lacinia eros. Mauris ac semper mauris. Nam mauris ipsum, molestie at vehicula et, elementum at magna. Donec non magna imperdiet, mattis turpis vel, eleifend arcu. Praesent egestas at tellus et varius. Phasellus tincidunt vitae nisl nec congue. Aliquam gravida iaculis condimentum. Pellentesque pharetra odio sed blandit eleifend. Vivamus eu turpis ante. Aenean facilisis, massa sed ornare molestie, purus enim hendrerit lorem, quis pellentesque mauris tortor ut turpis. Fusce fringilla massa sapien, et euismod eros aliquam a. Pellentesque consequat euismod ipsum eget blandit. Maecenas turpis ex, gravida et euismod ac, placerat et felis.
        <br />
        <br />
        Nam odio velit, volutpat tincidunt fermentum vitae, imperdiet quis justo. Maecenas tempus massa at lorem convallis tristique. Ut nisl ipsum, tincidunt non mi eget, suscipit tempus augue. Donec a aliquam turpis, elementum porttitor elit. Vivamus maximus, orci sit amet lacinia tristique, quam turpis porttitor tortor, sed mattis eros enim ut enim. Nam in congue lorem. In sollicitudin nunc at porttitor iaculis. Sed sagittis, ante ac pellentesque malesuada, nisi mi consectetur magna, vel imperdiet neque mauris in neque. Donec pharetra nibh in porttitor egestas. Mauris blandit pharetra hendrerit. Suspendisse pretium augue porttitor nulla imperdiet, a mollis quam condimentum. Duis eget fringilla velit. Donec pulvinar nunc ex, eget bibendum augue ultrices ac. Praesent ornare sagittis imperdiet. Aliquam erat volutpat.
        <br />
        <br />
        Mauris vitae velit odio. Nulla sit amet molestie purus. Nulla laoreet, nisi in aliquet pulvinar, sapien risus lobortis enim, a tempor tellus diam sed ipsum. Sed sollicitudin id risus sed vestibulum. Quisque lobortis enim id est pellentesque, in luctus nisl malesuada. Nam molestie augue eget lectus vehicula, eget feugiat dui venenatis. Nulla et pretium tortor. Quisque nec magna et lacus porta ultrices. Duis et lectus sed arcu commodo cursus. Donec tellus purus, ultricies eu euismod vitae, mattis iaculis tellus. Maecenas ultrices dolor eu enim pharetra interdum. Donec fermentum nibh sapien, ut mattis tellus elementum ut.</p>
    <hr>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cv";

        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT eduID, eduSchool, eduDegree, eduGrade, eduStartYear, eduEndYear, eduDateAdded, eduDateUpdated FROM tbleducation";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<p><b>eduID:</b> ". $row["eduID"]. " - <b>eduSchool:</b> ". $row["eduSchool"]. " - <b>eduDegree:</b> ". $row["eduDegree"]. " - <b>eduGrade:</b> ". $row["eduGrade"]. " - <b>eduStartYear:</b> ". $row["eduStartYear"]. " - <b>eduEndYear:</b> ". $row["eduEndYear"]. " - <b>eduDateAdded:</b> ". $row["eduDateAdded"]. " - <b>eduDateUpdated:</b> ". $row["eduDateUpdated"]. "</p><br>";
            }
        } else {
            echo "0 results";
        }
        
        $conn->close();
    ?>
    <hr>
    <button>Show Cover Letter</button>
    <br>
    <br>
    <div class="letter">
        <p></p>
    </div>
    <hr>
    <ol>
        <li>
            <ul>
                <li>Do I like Pizza? <button onclick="myQuestion1(); myAnswer1();">
                        <div id="question1">Show Answer</div>
                    </button></li>
                <li id="myA1" style="visibility: hidden">YES!</li>
            </ul>
        </li>
        <li>
            <ul>
                <li>Do I like Sushi? <button onclick="myQuestion2(); myAnswer2();">
                        <div id="question2">Show Answer</div>
                    </button></li>
                <li id="myA2" style="visibility: hidden">Haven't Tried</li>
            </ul>
        </li>
        <li>
            <ul>
                <li>I own a cat? <button onclick="myQuestion3(); myAnswer3();">
                        <div id="question3">Show Answer</div>
                    </button></li>
                <li id="myA3" style="visibility: hidden">YES!</li>
            </ul>
        </li>

    </ol>
    <hr>
    <h2 style="text-align:center">Gallery</h2>

    <div class="mySlides">
        <img src="images/img_mountains.jpg" style="width:50%">
    </div>

    <div class="mySlides">
        <img src="images/img_nature.jpg" style="width:50%">
    </div>

    <div class="mySlides">
        <img src="images/img_snow.jpg" style="width:50%">
    </div>

    <div class="mySlides">
        <img src="images/img_lights.jpg" style="width:50%">
    </div>

    <div class="row">
        <div class="column">
            <img class="demo cursor" src="images/img_mountains.jpg" style="width:100%" onclick="currentSlide(1)">
        </div>
        <div class="column">
            <img class="demo cursor" src="images/img_nature.jpg" style="width:100%" onclick="currentSlide(2)">
        </div>
        <div class="column">
            <img class="demo cursor" src="images/img_snow.jpg" style="width:100%" onclick="currentSlide(3)">
        </div>
        <div class="column">
            <img class="demo cursor" src="images/img_lights.jpg" style="width:100%" onclick="currentSlide(4)">
        </div>
    </div>
    </div>
    <hr>
    <ul>
        <li>Sound Engineer - Working with all things sound</li>
        <ol>
            <li>Working with the hanging rig</li>
            <li>Working with the monitor rig</li>
        </ol>
        <li>Light Designer - Working with all things lights</li>
        <li><a href="https://www.scouts.ie/" target="_blank">Scouting Ireland</a></li>
        <li><a href="https://edu.google.com/?modal_active=none" target="_blank">Google For Education</a></li>
        <li><a href="https://www.met.ie/" target="_blank">Met Éireann</a></li>
    </ul>
    <hr>
    <img class="pics1" src="images/EoghanByrne.jpg">
    <table class="tg">
        <tr>
            <th class="tg-1">Location</th>
            <th class="tg-1">Time</th>
            <th class="tg-1">Years</th>
        </tr>
        <tr>
            <td class="tg-1">TU Dublin</td>
            <td class="tg-1">4</td>
            <td class="tg-1">2017 - 2021</td>
        </tr>
        <tr>
            <td class="tg-1">Blakestown Community School</td>
            <td class="tg-1">6</td>
            <td class="tg-1">2011 - 2017</td>
        </tr>
    </table>
    <hr>



    <script type="text/javascript" src="script.js"></script>
</body>

</html>
