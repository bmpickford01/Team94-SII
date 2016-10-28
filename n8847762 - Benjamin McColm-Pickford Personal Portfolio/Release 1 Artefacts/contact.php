<?php
require '../inc/header.inc';
?>
<body>
    <div class="container-fluid contact">
		<div class="nav-2">
        <?php //Navigation bar
            require '../inc/nav.inc';
        ?>
		</div>
        <div class="contact-head text-center">
            <h2>Contact Us</h2>
        </div>
        <div class="row"> <!-- Basic static contact information -->
            <div class="col-md-4 contact-information text-center">
                <h3>TheKommunityService</h3>
                <p>Ph: (07) 1298 2810</p>
                <p>Email: info@tks.com.au</p>
                <p>Address: 123 Fake Street, Not Brisbane, 0001</p>
                <br>
                <p>If you wish to access our place via public transport</p>
                <p>you will need to walk 12km from the city. Sorry</p>
            </div>
            <div class="col-md-4 col-md-offset-1 contact-map text-right"> <!-- Map diplay -->
                <img src="../img/map.png">
            </div>
        </div>
        
    </div>
<?php //Footer
require '../inc/footer.inc';
?>
</body>
