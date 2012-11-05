<script type="text/javascript" src="<?php echo $this->config->item('base_url'); ?>js/carshare_custom.js"></script>
<ul class="sortable"> 
<?php 
print_r($cities);
      foreach($cities as $city){ 
          ?>
        <li id="city_<?php echo $city['id']; ?>"> 
            <?php
                echo $city['city_el'].'-'.$city['city_en'].'() - <a class="delete_city" id="delete_city_'.$city['id'].'">Delete</a>';
                echo ' - <a class="edit_city" id="edit_city_'.$city['id'].'">Edit</a>';
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
