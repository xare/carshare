<script type="text/javascript">
    $(".suggest_link").click(function(){
        var id_location = $(this).attr('id').split("_").reverse();
        $(this).parent().parent().parent().parent().children('input').val($(this).html());
        if($(this).parent().parent().parent().parent().children('input').attr('name') == "origin")
            $('input[name="origin_id"]').val(id_location[0]);
        else
            $('input[name="destination_id"]').val(id_location[0]);
        $('.suggest').fadeOut('slow');
    });        
</script>
<ul>
<?php foreach($locations as $location){ ?>
    <li>
        <a class="suggest_link" href="#" id="location_<?php echo $location->id; ?>"><?php echo $location->city_en; ?></a>
    </li>
<?php } ?>
</ul>
