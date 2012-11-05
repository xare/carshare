<?php
    $this->load->view('head');
    $this->load->view('header');
    $this->load->view('admin/menu');
?>

<div id="admin_content">
    <h2>AREA ADD</h2>
    <div class="add_box">
    
    <?php 
        $area_en = array(
            'name' => 'area_en',
            'id' => 'area_en'
        );
        $area_el = array(
            'name' => 'area_el',
            'id' => 'area_el'
        );
        $submit = array(
            'name' => 'submit',
            'value' => 'Add Area'
        );
        echo form_open_multipart('admin/foodfood/add_area');
        echo validation_errors();
        echo form_label('Add Area', 'area');
        echo "<br />";
        echo form_input($area_el);
        echo "<br />";
        echo form_input($area_en);
        echo "<br />";
        echo form_submit($submit);
        echo form_close();
    ?>
    </div>
    <div id="category_list">
        <?php
            $this->load->view('admin/area_list');
        ?>
    </div>
</div>

<?php
    $this->load->view('footer');
?>
