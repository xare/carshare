<?php
    $this->load->view('head');
    $this->load->view('header');
    $this->load->view('admin/menu');
?>

<div id="admin_content">
    <h2>CITY ADD</h2>
    <div class="add_box">
    
    <?php 
        $city_en = array(
            'name' => 'city_en',
            'id' => 'city_en'
        );
        $city_el = array(
            'name' => 'city_el',
            'id' => 'city_el'
        );
        $upload_data = array(
            'name'=> 'cityfile'
        );
        $submit = array(
            'name' => 'submit',
            'value' => 'Add City'
        );
        
        $are = array();
        foreach($areas as $area){
            $are[$area['id']] = $area['area_en'] ." - ".$area['area_el'];
        }
        
        echo form_open_multipart('admin/foodfood/add_city');
        echo validation_errors();
        echo form_label('Add City', 'city');
        echo "<br />";
        echo form_input($city_en);
        echo "<br />";
        echo form_input($city_el);
        echo "<br />";
        echo form_dropdown('area',$are);
        echo "<br />";
        echo form_upload($upload_data);
        echo "<br />";
        echo form_submit($submit);
        echo form_close();
    ?>
    </div>
    <div id="category_list">
        <?php
            $this->load->view('admin/city_list');
        ?>
    </div>
</div>

<?php
    $this->load->view('footer');
?>
