<?php session_start();

$usern = $_SESSION['na'];
$_SESSION['na'] = $usern;

if (!$usern) {
     header('Location: login.html');
} 

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Web Calendar</title>
        <link rel="stylesheet"
              href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <script src="js/jquery.min.js"></script>
        <script src="js/moment.min.js"></script>

        <!-- Full Calendar -->
        <link rel="stylesheet" href="css/fullcalendar.min.css">
        <script src="js/fullcalendar.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    </head>
    <body>
        <!--container that holds the fullcalendar-->
        <div class="container">
            <div class="col"></div>
            <div class="col-7">
                <!--width attribute determines the space that the fullcalendar occupies-->
                <div id="WebCalendar" style="width: 900px;"></div>
            </div>
            <div class="col"></div>
        </div>

        <script>
            $(document).ready(function () {
                $('#WebCalendar').fullCalendar({
                    //formats the time for the calendar
                    timeFormat: 'hh:mm a',

                    //content on the header of the calendar i.e. buttons, layout, etc.
                    header: {
                        left: 'today,prev,next',
                        center: 'title',
                        right: 'month,listWeek,agendaWeek,agendaDay'
                    },

                    //function that executes whenever a day on calendar is clicked, it serves the purpose of giving the user a pop-up window with a new order form
                    dayClick: function (date, jsEvent, view) {
                        //event attributes associated with each order
                        $('#eventTitle').html("New Order Form");

                        //modifies the information of the event inputs upon pop-up
                        $('#txtDescription').val("");
                        $('#txtID').val("");
                        $('#txtTitle').val("");
                        $('#txtName').val("");
                        $('#txtNumber').val("");
                        $('#txtAddress').val("");
                        $('#txtColor').val("#4265f4");
                        $('#txtDate2').val(date.format());
                        $('#txtHour2').val("");
                        $('#txtDate').val(date.format());
                        $('#txtHour').val("");
                        $('#txtTotal').val("");
                        $("#ModalEvents").modal();
                    },

                    //address for obtaining events
                    events: "http://localhost/webCalendar/events.php",

                    //function that brings up a modal window with information on whatever event was clicked
                    eventClick: function (calEvent, jsEvent, view) {
                        //h2
                        $('#eventTitle').html(calEvent.title);
                        //modifies the information of the event in the inputs
                        $('#txtDescription').val(calEvent.description);
                        $('#txtID').val(calEvent.id);
                        $('#txtTitle').val(calEvent.title);
                        $('#txtName').val(calEvent.name);
                        $('#txtNumber').val(calEvent.number);
                        $('#txtAddress').val(calEvent.address);
                        $('#txtColor').val(calEvent.color);

                        //temp variable that properly formats the date and hour
                        DateHour = calEvent.start._i.split(" ");
                        $('#txtDate').val(DateHour[0]);
                        $('#txtHour').val(DateHour[1]);

                        // same as above but for the end time and date of the event
                        if (calEvent.end !== null) {
                            DateHour2 = calEvent.end._i.split(" ");
                            $('#txtDate2').val(DateHour2[0]);
                            $('#txtHour2').val(DateHour2[1]);
                        }

                        $('#txtTotal').val(calEvent.total);

                        $("#ModalEvents").modal();
                    }

                });
            });
        </script>

        <!-- Modal(Add, Modify, Delete) -->
        <!-- This is the modal from bootstrap that is used for pop-up windows regarding events on the calendar, aka change this if you want to change the pop-up windows -->
        <div class="modal fade" id="ModalEvents" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventTitle">Add Title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="upload.php" method="post" enctype="multipart/form-data">
                            Select image to upload:
                            <input type="file" name="image"/>
                            <input type="submit" name="submit" value="UPLOAD"/>
                        </form>

                        <ul style="list-style-type:none">
                            <li>Order ID (don't worry about this): <br><input type="text" id="txtID" name="txtID" readonly></li><br>
                            <li>Order Type: <br><input type="text" id="txtTitle"></li><br>
                            <li>Customer Name: <br><input type="text" id="txtName"></li><br>
                            <li>Customer Phone Number: <br><input type="text" id="txtNumber"></li><br>
                            <li>Customer Address: <br><input type="text" id="txtAddress"></li><br>
                            <li>Order Start Date: <br><input type="text" id="txtDate" name="txtDate"></li><br>
                            <li>Order Start Time (24hr): <br><input type="text" id="txtHour" placeholder="8:30 (8:30am)"></li><br>
                            <li>Order End Date: <br><input type="text" id="txtDate2" name="txtDate2"></li><br>
                            <li>Order End Time (24hr): <br><input type="text" id="txtHour2" placeholder="15:30 (3:30pm)"></li><br>
                            <li>Description of Order: <br><textarea id="txtDescription" rows="8" cols="50"></textarea></li><br>
                            <li>Order Total: <br><input type="text" id="txtTotal"></li><br>
                            <li>Color of Order: <br><input type="color" value="#ff0000" id="txtColor"></li><br>
                            <!-- THIS IS TO UPLOAD IMAGE--> 
                        </ul>

                            <form action="view.php" method="GET">

                                <input type="text" id="txtID" name="txtID" />
                                <input type="submit" name="submit"/>
                            </form>

                            <?php ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btnAdd" class="btn btn-success">Add</button>
                            <button type="button" id="btnModify" class="btn btn-success">Update</button>
                            <button type="button" id="btnDelete" class="btn btn-danger">Delete</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                //This whole script is responsible for adding function to the buttons found in the Modal above. It also is responsible for transmitting and receiving fullcalendar evet data from the database.

                var newEvent;

                $('#btnAdd').click(function () {
                    gatherDataGUI();
                    submitInformation('add', newEvent);
                });
                $('#btnDelete').click(function () {
                    gatherDataGUI();
                    submitInformation('delete', newEvent);
                });
                $('#btnModify').click(function () {
                    gatherDataGUI();
                    submitInformation('modify', newEvent);
                });

                function submitInformation(action, eventObj) {
                    $.ajax({
                        type: 'POST',
                        url: 'events.php?action=' + action,
                        data: eventObj,
                        success: function (msg) {
                            if (msg) {
                                $('#WebCalendar').fullCalendar('refetchEvents');
                                $('#ModalEvents').modal('toggle');
                            }
                        },
                        error: function () {
                            alert("An error occurred.");
                        }
                    });
                }

                function gatherDataGUI() {
                    newEvent = {
                        id: $('#txtID').val(),
                        title: $('#txtTitle').val(),
                        start: $('#txtDate').val() + " " + $('#txtHour').val(),
                        name: $('#txtName').val(),
                        number: $('#txtNumber').val(),
                        address: $('#txtAddress').val(),
                        color: $('#txtColor').val(),
                        description: $('#txtDescription').val(),
                        total: $('#txtTotal').val(),
                        textColor: "#FFFFFF",
                        end: $('#txtDate2').val() + " " + $('#txtHour2').val(),
                    };
                }

            </script>

    </body>
</html>