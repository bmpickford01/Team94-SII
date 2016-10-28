<!DOCTYPE html>

<?php
	require '../inc/header.inc';
	require '../inc/setPDO.inc';
?>



<body>
    <div class="container-fluid event">

        <!-- HOME NAVIGATION -->
        <?php
            require '../inc/nav.inc';
        ?>
        <!-- END HOME NAVIGATION -->

		<?php 
			if(!isset($_GET['eventID'])){
				header("Location: http://{$_SERVER['HTTP_HOST']}/Team94-SII/pages/404.php");
			}

			require '../inc/setPDO.inc';
		
			//Function to get the number of people coming
			function getPeople(){
				require '../inc/setPDO.inc';
				$numPeople = $pdo->prepare('SELECT (ADDCNT + ROWCNT) AS TOTAL FROM (SELECT sum(additionalAttendees) as ADDCNT, count(*) as ROWCNT FROM TEAM94.EVENT_ATTENDEES_TB WHERE eventID = :evtID) p;');
				$numPeople->bindvalue(':evtID', $_GET['eventID']);
				$numPeople->execute();
				return $numPeople->fetch();
			}
			
			$getCount = getPeople();

			$result = $pdo->prepare('SELECT * FROM EVENTS_TB WHERE EVENTS_TB.eventID = :id');
			$result->bindvalue(':id', $_GET['eventID']);
			$result->execute();

			//If there isn't any results for that
			if($result->rowCount() < 1) {
				header("Location: http://{$_SERVER['HTTP_HOST']}/Team94-SII/pages/404.php");
			}

			//Check amount donated for this event
			$query = $pdo->prepare('SELECT SUM(donationAmount) as donationAmount FROM DONATION_TB WHERE eventID = :id');
			$query->bindvalue(':id', $_GET['eventID']);
			$query->execute();

			foreach($query as $row) {
				$totalDonated = $row['donationAmount'];
				if($totalDonated == "") {
					$totalDonated = '0';
				}
			}

			foreach($result as $row) {
				$eventName = $row['eventName'];
				$details = $row['eventDetail'];
				$address = $row['eventAddress'];
				$startTime = $row['eventDate'];
				$finishTime = $row['eventFinish'];
				//$donationGoal = $row['donationGoal'];
				$minCost = $row['minCost'];

				$donationGoal = 1000 + ($getCount['TOTAL'] * 3);
				//echo peopleCount['TOTAL'];
		
			if(!isset($_SESSION['userType'])){
				$_SESSION['userType'] = 'M';	
			}
			if ($_SESSION['userType'] == 'A'){ 

?>
		<form method="post" action="updateEvent.php">
		<div class="event-head">
			<input type="text" id="eventName" name="eventName" class="headUpdateEvent" value='<?php echo $eventName ?>'>
		</div>

		<div class = "event-donations">
			<h3>Donation Goal: <b><input type="number" name="donationGoal" id="donationGoal" value='<?php echo $donationGoal ?>' disabled></b></h3>
			<h3>Amounted Donated: <b>$<?php echo $totalDonated ?></b></h3>
		</div>

		<div class = "event-sponsors">
			<h2>Sponsors</h2>
			<h4>Coca-Cola</h4>
			<h4>Queensland University of Technology</h4>
		</div>

		<!-- Event information and description row -->


		<div class = "row">
			<div class = "col-md-2"></div>
			<div class = "col-md-4 event-information">
				<h3>Details</h3>
				<table class = "table table-bordered">
						<tr>
							<td>Address</td><td><input class="event-update" type="text" name="address" id="address" value='<?php echo $address ?>'></td>
						</tr>
						<tr>
							<td>Start Time</td><td><input class="event-update" type="datetime-local" id="start" name="start" value='<?php echo $startTime ?>'></td>
						</tr>
						<tr>
							<td>Finish</td><td><input class="event-update" type="datetime-local" id="finish" value='<?php echo $finishTime ?>'></td>
						</tr>
						<tr>
							<td>Cost</td><td><input class="event-update" type="number" name="cost" id="cost" value='<?php echo $minCost ?>'></td>
						</tr>
					<input type="hidden" id="eventID" name="eventID" value="<?php echo $_GET['eventID']?>">
				</table>

			</div>
			<div class = "col-md-4 event-description">
				<h3>What it's about</h3>
				<textarea rows="5" name="details" class="event-details" id="details" value='<?php echo $details ?>'><?php echo $details ?></textarea>
			</div>
			<div class = "col-md-2"></div>
		</div>
			<button type="submit" class="saveEvent">Save Details</button>
		</form>

<?php	} else {	?>
		<div class = "event-head">
			<h1><?php echo $eventName ?></h1>
		</div>

		<div class = "event-donations">
			<h3>Donation Goal: <b>$<?php echo $donationGoal ?></b></h3>
			<h3>Amounted Donated: <b>$<?php echo $totalDonated ?></b></h3>
		</div>

		<div class = "event-sponsors">
			<h2>Sponsors</h2>
			<h4>Coca-Cola</h4>
			<h4>Queensland University of Technology</h4>
		</div>

		<!-- Event information and description row -->

		<div class = "row">
			<div class = "col-md-2"></div>
			<div class = "col-md-4 event-information">
				<h3>Details</h3>
				<table class = "table table-bordered">
					<tr>
						<td>Address</td><td><?php echo $address ?></td>
					</tr>
					<tr>
						<td>Date</td><td><?php echo $startTime ?></td>
					</tr>
					<tr>
						<td>Finish</td><td><?php echo $finishTime ?></td>
					</tr>
					<tr>
						<td>Cost</td><td><?php echo $minCost ?></td>
					</tr>
				</table>
			</div>
			<div class = "col-md-4 event-description">
				<h3>What it's about</h3>
				<p><?php echo $details ?></p>
			</div>
			<div class = "col-md-2"></div>
		</div>
		<?php
			   }
			} //END While loop for database data
		?>
		<!-- # people going and button row -->
		<div class = "row">
			<div class = "col-md-4"></div>
			<div class = "col-md-4 event-rsvp">
<!-- 				<p><b>23</b> people have RSVP'd to this event. Click the button below to RSVP now!</p> -->
				<?php
					require '../inc/getNumOfAtt.inc';

					require '../inc/donationAndRSVP.inc';
					donationAndRSVP($_GET['eventID'], $minCost);

                ?>

<!--                 <p>ddddd</p> -->
				</div> <!-- end of div: rsvp-content -->
				<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
				<script type="text/javascript" src="../js/jquery.js"></script>
                <script type="text/javascript" src="../js/jquery-ui.js"></script>
                <script type="text/javascript" src="../js/script.js"></script>
			</div>
			<div class = "col-md-4"></div>
		</div>
		<div id='vol-Schedule-List'>
			<?php // get table
                require '../inc/getVolTable.inc';
                getResult();
            ?>
        </div>
        <?php
        	require '../inc/footer.inc';
        ?>
</body>


