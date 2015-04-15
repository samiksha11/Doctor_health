<div id="dp"></div>

<script type="text/javascript">
  var dp = new DayPilot.Scheduler("dp");
  dp.viewType = "Days";

  dp.startDate = new DayPilot.Date().firstDayOfMonth();
  dp.days = dp.startDate.daysInMonth();

  dp.timeHeaders = [
    { groupBy: "Day", format: "MMMM yyyy" },
    { groupBy: "Hour"}
  ];

  dp.init();


$(document).ready(function() {
  loadResources();
  $("#employee").change(function() {
      loadEvents();
  });
});

function loadResources() {
  $.post("backend_resources.php", function(data) {
      for (var i = 0; i < data.length; i++) {
          var item = data[i];
          $("#employee").append($('<option/>', { 
              value: item.id,
              text : item.name
          }));
      }
      loadEvents();
  });
}
</script>
<div class="space">
  Employee:
  <select id="employee"></select>
</div>


<?php
include("config.php");
if($_SESSION['email'] == '')
{
	//header("Location:index.php");
}
class Resource {}

$resources = array();

$stmt = $db->prepare('SELECT * FROM [patient] ORDER BY [Patient_name]');
$stmt->execute();
$timesheet_resources = $stmt->fetchAll();  
echo 'SELECT * FROM [patient] ORDER BY [Patient_name]';
foreach($timesheet_resources as $resource) {
  $r = new Resource();
  $r->id = $resource['id'];
  $r->name = $resource['Patient_name'];
  $resources[] = $r;
}


echo json_encode($resources);

?>