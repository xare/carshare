<script type="text/javascript" src="<?php echo $this->config->item('base_url'); ?>js/carshare_custom.js"></script>
<ul class="sortable"> 
<?php 
      foreach($cars as $car){ 
          ?>
        <li id="car_<?php echo $car['id']; ?>"> 
            <?php
                echo $car['make'].'-'.$car['model'].' - <a class="delete_car" id="delete_car_'.$car['id'].'">Delete</a>';
                echo ' - <a class="car_area" id="car_area_'.$car['id'].'">Edit</a>';
                echo "<br />";
            ?>
        <?php
            echo "<br />";
        ?>
        </li>
        <?php
      }
?>
</ul>
