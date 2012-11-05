<script type="text/javascript" src="<?php echo $this->config->item('base_url'); ?>js/carshare_custom.js"></script>
<ul class="sortable"> 
<?php 
      foreach($areas as $area){ 
          ?>
        <li id="area_<?php echo $area['id']; ?>"> 
            <?php
                echo $area['area_el'].'-'.$area['area_en'].' - <a class="delete_area" id="delete_area_'.$area['id'].'">Delete</a>';
                echo ' - <a class="edit_area" id="edit_area_'.$area['id'].'">Edit</a>';
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
