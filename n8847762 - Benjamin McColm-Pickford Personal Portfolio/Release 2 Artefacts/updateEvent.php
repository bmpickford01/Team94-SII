<!DOCTYPE html>
<html>
	<body>
        <?php //Includes
            require '../inc/header.inc';
            require '../inc/setPDO.inc';
            require '../inc/nav.inc';
    		?>
		<div id="container-fluid">
		<?php //Assigning variables from individualEvent.php
			$address = $_POST['address'];
			$details = $_POST['details'];
			$donationGoal = $_POST['donationGoal'];
			$eventCost = $_POST['cost'];
			$eventID = $_POST['eventID'];
			$eventName = $_POST['eventName'];
			$start = $_POST['start'];
			
			//Updates database
			$query=$pdo->prepare("UPDATE EVENTS_TB SET eventAddress= :address, eventDetail=:description, donationGoal=:donationGoal, minCost=:eventCost, eventName=:eventName, eventDate=:start WHERE eventID=:eventID"); 
			$query->bindvalue(':address', $address);
			$query->bindvalue(':description', $details);
			$query->bindvalue(':donationGoal', $donationGoal);
			$query->bindvalue(':eventID', $eventID);
			$query->bindvalue(':eventCost', $eventCost);
			$query->bindvalue(':eventName', $eventName);
			$query->bindvalue(':start', $start);
			$query->execute();
			//Redirection to eventList
			header("Location: http://{$_SERVER['HTTP_HOST']}/Team94-SII/pages/eventList.php")
			?>
		</div>
	</body>
</html>
