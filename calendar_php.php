<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='backend/calendar/packages/core/main.css' rel='stylesheet' />
<link href='backend/calendar/packages/daygrid/main.css' rel='stylesheet' />
<link href='backend/calendar/packages/timegrid/main.css' rel='stylesheet' />
<link href='backend/calendar/packages/list/main.css' rel='stylesheet' />
<script src='backend/calendar/packages/core/main.js'></script>
<script src='backend/calendar/packages/interaction/main.js'></script>
<script src='backend/calendar/packages/daygrid/main.js'></script>
<script src='backend/calendar/packages/timegrid/main.js'></script>
<script src='backend/calendar/packages/list/main.js'></script>
<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
      plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
      defaultDate: '<?php echo date("Y-m-d"); ?>',
      editable: true,
      navLinks: true, // can click day/week names to navigate views
      eventLimit: true, // allow "more" link when too many events
      events: {
        url: 'backend/calendar/get-events.php',
        failure: function() {
          document.getElementById('script-warning').style.display = 'block'
        }
      },
      loading: function(bool) {
        document.getElementById('loading').style.display =
          bool ? 'block' : 'none';
      }
    });

    calendar.render();
  });

</script>
<style>

  body {
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
  }

  #script-warning {
    display: none;
    background: #eee;
    border-bottom: 1px solid #ddd;
    padding: 0 10px;
    line-height: 40px;
    text-align: center;
    font-weight: bold;
    font-size: 12px;
    color: red;
  }

  #loading {
    display: none;
    position: absolute;
    top: 10px;
    right: 10px;
  }

  #calendar {
    max-width: 900px;
    margin: 40px auto;
    padding: 0 10px;
  }

</style>
</head>
<body>

  <div id='script-warning'>
    <code>Php script</code> must be running.
  </div>

  <div id='loading'>loading...</div>

  <div id='calendar'></div>

</body>
</html>
