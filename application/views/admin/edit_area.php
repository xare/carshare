<?php 
        $area_en = array(
            'name' => 'area_en',
            'id' => 'area_en',
            'value'=>$area_en
        );
        $area_el = array(
            'name' => 'area_el',
            'id' => 'area_el',
            'value'=>$area_el
        );
        $submit = array(
            'name' => 'submit',
            'value' => 'Update Area'
        );
        echo form_open_multipart('admin/carshare/update_area');
        echo form_hidden('id',$id);
        echo validation_errors();
        echo form_label('Edit Area', 'area');
        echo "<br />";
        echo form_input($area_en);
        echo "<br />";
        echo form_input($area_el);
        echo "<br />";
        echo form_submit($submit);
        echo form_close();
    ?>
