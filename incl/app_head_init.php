
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>RICTA</title>

<link href="<?=DN?>/img/favicon.png" rel="shortcut icon">
<link href="<?=DN?>/img/favicon.png" rel="apple-touch-icon"> 

<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.5 -->
<link rel="stylesheet" href="<?=DN?>/plugins/bootstrap/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?=DN?>/plugins/font_awesome/css/font-awesome.min.css">
<!-- Jansy-->
<link rel="stylesheet" href="<?=DN?>/plugins/jasny_bootstrap/css/jasny-bootstrap.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="<?=DN?>/plugins/ionicons/css/ionicons.min.css">
<link rel="stylesheet" href="<?=DN?>/plugins/intlTelInput/build/css/intlTelInput.min.css">
<link rel="stylesheet" href="<?=DN?>/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?=DN?>/plugins/bootstrap3-editable/bootstrap3-editable/css/bootstrap-editable.css">
<!-- Theme style -->
<link rel="stylesheet" href="<?=DN?>/dist/css/if.css">
<link rel="stylesheet" href="<?=DN?>/dist/css/animate.css">

  <!-- fullCalendar 2.2.5-->
<link rel="stylesheet" href="<?=DN?>/plugins/fullcalendar/fullcalendar.min.css">
<link rel="stylesheet" href="<?=DN?>/plugins/fullcalendar/fullcalendar.print.css" media="print">

<link rel="stylesheet" href="<?=DN?>/dist/css/skins/skin-if.css">
<link rel="stylesheet" href="<?=DN?>/assets/css/app.css">

  <!-- Morris Charts-->
<link rel="stylesheet" href="<?=DN?>/plugins/morris/morris.css">


<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- jQuery 2.1.4 -->
<script src="<?=DN?>/plugins/jquery/jQuery-2.1.4.min.js"></script>
<script src="<?=DN?>/plugins/jquery/jquery.ui.min.js"></script>
<script src="<?=DN?>/plugins/intlTelInput/build/js/intlTelInput.min.js"></script>
<script src="<?=DN?>/plugins/select2/js/select2.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="<?=DN?>/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?=DN?>/plugins/bootstrap3-editable/bootstrap3-editable/js/bootstrap-editable.js"></script>
<script src="<?=DN?>/plugins/intlTelInput/build/js/utils.js"></script>

<?php if($url_struc['tree'] == "app"){?>
<!--Morris Chart-->
<script src="<?=DN?>/plugins/raphael/js/raphael.min.js"></script>
<script src="<?=DN?>/plugins/morris/morris.min.js"></script>
<script type="text/javascript" src="<?=DN?>/plugins/canvas/canvasjs.min.js"></script>
<script>
   $(document).ready(function(){ 
       //Fix for charts under tabs
      $('.box ul.nav a').on('shown.bs.tab', function () {
        area.redraw();
        donut.redraw();
        line.redraw();
      });
    });
</script>
<?php }?>

<?php if($url_struc['tree'] == 'calendar'){?>
<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        };

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex: 1070,
          revert: true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        });

      });
    }

    ini_events($('#external-events div.external-event'));

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date();
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();
    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'today',
        month: 'month',
        week: 'week',
        day: 'day'
      },
      //Random default events
      events: [
        {
          title: 'All Day Event',
          start: new Date(y, m, 1),
          backgroundColor: "#f56954", //red
          borderColor: "#f56954" //red
        },
        {
          title: 'Long Event',
          start: new Date(y, m, d - 5),
          end: new Date(y, m, d - 2),
          backgroundColor: "#f39c12", //yellow
          borderColor: "#f39c12" //yellow
        },
        {
          title: 'Meeting',
          start: new Date(y, m, d, 10, 30),
          allDay: false,
          backgroundColor: "#0073b7", //Blue
          borderColor: "#0073b7" //Blue
        },
        {
          title: 'Lunch',
          start: new Date(y, m, d, 12, 0),
          end: new Date(y, m, d, 14, 0),
          allDay: false,
          backgroundColor: "#00c0ef", //Info (aqua)
          borderColor: "#00c0ef" //Info (aqua)
        },
        {
          title: 'Birthday Party',
          start: new Date(y, m, d + 1, 19, 0),
          end: new Date(y, m, d + 1, 22, 30),
          allDay: false,
          backgroundColor: "#00a65a", //Success (green)
          borderColor: "#00a65a" //Success (green)
        },
        {
          title: 'Click for Google',
          start: new Date(y, m, 28),
          end: new Date(y, m, 29),
          url: 'http://google.com/',
          backgroundColor: "#3c8dbc", //Primary (light-blue)
          borderColor: "#3c8dbc" //Primary (light-blue)
        }
      ],
      editable: true,
      droppable: true, // this allows things to be dropped onto the calendar !!!
      drop: function (date, allDay) { // this function is called when something is dropped

        // retrieve the dropped element's stored Event Object
        var originalEventObject = $(this).data('eventObject');

        // we need to copy it, so that multiple events don't have a reference to the same object
        var copiedEventObject = $.extend({}, originalEventObject);

        // assign it the date that was reported
        copiedEventObject.start = date;
        copiedEventObject.allDay = allDay;
        copiedEventObject.backgroundColor = $(this).css("background-color");
        copiedEventObject.borderColor = $(this).css("border-color");

        // render the event on the calendar
        // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
        $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

        // is the "remove after drop" checkbox checked?
        if ($('#drop-remove').is(':checked')) {
          // if so, remove the element from the "Draggable Events" list
          $(this).remove();
        }

      }
    });

    /* ADDING EVENTS */
    var currColor = "#3c8dbc"; //Red by default
    //Color chooser button
    var colorChooser = $("#color-chooser-btn");
    $("#color-chooser > li > a").click(function (e) {
      e.preventDefault();
      //Save color
      currColor = $(this).css("color");
      //Add color effect to button
      $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
    });
    $("#add-new-event").click(function (e) {
      e.preventDefault();
      //Get value and make sure it is not null
      var val = $("#new-event").val();
      if (val.length == 0) {
        return;
      }

      //Create events
      var event = $("<div />");
      event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
      event.html(val);
      $('#external-events').prepend(event);

      //Add draggable funtionality
      ini_events(event);

      //Remove event from text input
      $("#new-event").val("");
    });
  });
</script>
<?php }?>

<!-- fullCalendar 2.2.5 -->
<script src="<?=DN?>/plugins/moment/js/moment.min.js"></script>
<script src="<?=DN?>/plugins/fullcalendar/fullcalendar.min.js"></script>

<script>
    $(document).ready(function(){
        $('.has_tooltip').tooltip();
    });
</script>
<!-- Sparkline -->
<script src="<?=DN?>/plugins/sparkline/jquery.sparkline.min.js"></script>
