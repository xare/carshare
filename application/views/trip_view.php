<?php
/*The head view contains all the head tag. call to meta tags, title, css, js */
    $this->load->view('includes/head');
/*Top part of the page common to all pages*/
    $this->load->view('includes/header');  
?>

<div id="driver_box">
   <?php echo $trip['driver']; ?><br />
   <img src="../../uploads/<?php echo $trip['driver']; ?>_thumb.jpg" />
</div>
<?php 
/*echo $trip['id'];
echo " - ";*/
echo $trip['city_from'];
echo " → ";
echo $trip['city_to'];
echo " - ";
echo $trip['when'];
?>

<?php if($trip['reserved'] == 0): ?>
<a href="../make_request/<?php echo $trip['id']; ?>">Request Trip</a>
<?php endif; ?>
<?php if($trip['reserved'] == 1): ?>
You have requested a place in this trip.
<?php endif; ?>
<!-- FOOTER BEGINS HERE -->
<?php
    $this->load->view('includes/footer');  
?>
