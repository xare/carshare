<?php 
        $city_en = array(
            'name' => 'city_en',
            'id' => 'city_en',
            'value'=>$city_en
        );
        $city_el = array(
            'name' => 'city_el',
            'id' => 'city_el',
            'value'=>$city_el
        );
        $submit = array(
            'name' => 'submit',
            'value' => 'Update City'
        );
        $are = array();
        foreach($areas as $area){
            $are[$area['id']] = $area['name'];
        }
        echo form_open_multipart('admin/carshare/update_city');
        echo form_hidden('id',$id);
        echo validation_errors();
        echo form_label('Edit City', 'city');
        echo "<br />";
        echo form_input($city_en);
        echo "<br />";
        echo form_input($city_el);
        echo "<br />";
        echo form_dropdown('area',$are);
        echo "<br />";
        echo form_submit($submit);
        echo form_close();
    ?>
