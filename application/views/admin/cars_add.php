<?php
    $this->load->view('head');
    $this->load->view('header');
    $this->load->view('admin/menu');
?>

<div id="admin_content">
    <h2>Car ADD</h2>
    <div class="add_box">
    
    <?php 
        $make = array(
            'name' => 'make',
            'placeholder'=>'make',
            'id' => 'make'
        );
        $model = array(
            'name' => 'model',
            'placeholder'=>'model',
            'id' => 'model'
        );
        $places = array(
            'name' => 'places',
            'placeholder'=>'places',
            'id' => 'places'
        );
       
        $submit = array(
            'name' => 'submit',
            'value' => 'Add Car'
        );
        echo form_open_multipart('admin/foodfood/add_car');
        echo validation_errors();
        echo form_label('Add Car', 'car');
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
    </div>
    <div id="category_list">
        <?php
            $this->load->view('admin/cars_list');
        ?>
    </div>
</div>

<?php
    $this->load->view('footer');
?>
