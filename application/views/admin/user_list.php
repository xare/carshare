<script src="<?php echo $this->config->item('base_url'); ?>js/custom.js"></script>
<ul class="sortable" id="users_list">  
    <?php 
        foreach($users as $user_item){
    ?>
    <li id="user_<?php echo $user_item['id']; ?>">          
    <?php
        echo $user_item['firstname'].' '.$user_item['surname'].' ('.$user_item['username'].') - <a class="delete_user" id="delete_user_'.$user_item['id'].'">Delete</a>';
        echo ' - <a class="edit_user" id="edit_user_'.$user_item['id'].'">Edit</a>';
        echo "<br />";
    ?>
        <!--img src="<?php echo $this->config->item('base_url'); ?>uploads/products/<?php echo substr($user_item['picture'],0,-4); ?>_thumb.png" /-->
    </li>
<?php
    }
?>
</ul>
