<?php 
        $make = array(
            'name' => 'make',
            'id' => 'make',
            'value'=>$make
        );
        $model = array(
            'name' => 'model',
            'id' => 'model',
            'value'=>$model
        );
        $places = array(
            'name' => 'places',
            'id' => 'places',
            'value'=>$places
        );
        $submit = array(
            'name' => 'submit',
            'value' => 'Update Car'
        );
        echo form_open_multipart('admin/carshare/update_car');
        echo form_hidden('id',$id);
        echo validation_errors();
        echo form_label('Edit car', 'car');
        echo "<br />";
        echo form_input($make);
        echo "<br />";
        echo form_input($model);
        echo "<br />";
        echo form_input($places);
        echo "<br />";
        echo form_submit($submit);
        echo form_close();
    ?>
