<?php

//--------------------------------------------------------------------------------------------------
// This script reads event data from a JSON file and outputs those events which are within the range
// supplied by the "start" and "end" GET parameters.
//
// An optional "timeZone" GET parameter will force all ISO8601 date stings to a given timeZone.
//
// Requires PHP 5.2.0 or higher.
//--------------------------------------------------------------------------------------------------

// Require our Event class and datetime utilities
require dirname(__FILE__) . '/utils.php';

// Short-circuit if the client did not give us a date range.
if (!isset($_GET['start']) || !isset($_GET['end'])) {
  die("Please provide a date range.");
}

// Parse the start/end parameters.
// These are assumed to be ISO8601 strings with no time nor timeZone, like "2013-12-29".
// Since no timeZone will be present, they will parsed as UTC.
$range_start = parseDateTime($_GET['start']);
$range_end = parseDateTime($_GET['end']);

// Parse the timeZone parameter if it is present.
$timeZone = null;
if (isset($_GET['timeZone'])) {
  $timeZone = new DateTimeZone($_GET['timeZone']);
}

//
//$input_arrays.
//Get info from the db.



// Accumulate an output array of event data arrays.
$output_arrays = array();
foreach ($input_arrays as $array) {

  // Convert the input array into a useful Event object
  $event = new Event($array, $timeZone);

  // If the event is in-bounds, add it to the output
  if ($event->isWithinDayRange($range_start, $range_end)) {
    $output_arrays[] = $event->toArray();
  }
}

// Send JSON to the client.
echo json_encode($output_arrays);
