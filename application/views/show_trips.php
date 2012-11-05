<?php
/*The head view contains all the head tag. call to meta tags, title, css, js */
    $this->load->view('head');
/*Top part of the page common to all pages*/
    $this->load->view('header');  
?>

SHOW TRIPS
<div id="trips_list">
    <?php        
        foreach($trips as $trip):
    ?>
    <div>
        <?php echo $trip['from']; ?> - <?php echo $trip['to']; ?> - <?php echo $trip['when']; ?>
        <a href="" id="request_trip_<?php echo $trip['id']; ?>">Request</a>
    </div>
    <?php endforeach; ?>
    </div>

<!-- FOOTER BEGINS HERE -->
<?php
    $this->load->view('footer');  
?>