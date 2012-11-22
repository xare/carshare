/*This function loads the invitation form once the invitation link has been clicked via ajax*/
            function load_invitation_form(){
                /* The login form div is first fade out for half a second then the contents of users/invite are loaded into the same login form. This login form contains a login link.
                 * When this link is clicked a the load_login_form function is called, then login form is faded in again.*/
                $("#login_form").fadeOut(500, function(){
                        $("#login_form").load(base_url+'users/invite',function(){
                                    $("#login_link").click(function(){
                                        load_login_form();
                                    });
                        });
                });
                $("#login_form").fadeIn(900);
            }
            
            /* The load register form on login form div which dissappears, then the register page is loaded into the div.
             * Then it also contains a login link to log in. and also call the login form loading function.*/
            function load_register_form(){
                $("#login_form").fadeOut(500, function(){
                        $("#login_form").load('users/register',function(){
                                    $("#login_link").click(function(){
                                        load_login_form();
                                    });
                        });
                });
                $("#login_form").fadeIn(900);
            }
            /* This function operates exactly the same way as the previous ones loading the loging form into the div.
             * And offering a link to be able to register. */
            function load_login_form(){
                 $("#login_form").fadeOut(500, function(){
                        $("#login_form").load('users/show_login',function(){
                                    $("#register_link").click(function(){
                                        load_register_form();
                                    });
                        });
                });
                $("#login_form").fadeIn(900);
            }
            
            function get_id_from_link(id_chain){
                var id_array = id_chain.split("_"); // convert to array using the underline as separator
                id_array = id_array.reverse();// reverse the array
                return id = id_array[0]; //obtain the id_item as menu item
            }
            
            /*???*/
            $("#suggest_origin .suggest_link").click(function(){
                    alert('hello');
                    $(this).html();
                    var id_location = $(this).attr('id').split("_").reverse();
                    $("#origin").val($(this).html());
                    $('input[name="origin_id"]').val(id_location[0]);
                });
            $("#suggest_destination .suggest_link").click(function(){
                    alert('hello');
                    $(this).html();
                    var id_location = $(this).attr('id').split("_").reverse();
                    $("#destination").val($(this).html());
                    $('input[name="destination_id"]').val(id_location[0]);
                });
                
            $(document).ready(function(){
                /*The previously defined links are activated here.*/
                $("#register_link").click(function(){
                    load_register_form();
                });
                $("#invitation_link").click(function(){
                    load_invitation_form();
                });
                
                /* Loading dinamycally the list of locations on the FROM field at both the create trip and the 
                 * search trip form.*/
                 $('#origin').keyup(function() {
                   $(this).parent().children('.suggest').fadeIn('slow');
                   $.post("http://localhost/carshare/locationsuggest", 
                        {origin: $(this).val()}, 
                        function(data) {
                            $('#origin').parent().children('.suggest').html(data);
                        });
                   });
                 /* remove the .suggest box on cliking outside an input */  
                 $('#origin').blur(function(){
                    $('.suggest').fadeOut(); 
                 });
                 
                 /* Loading dinamycally the list of locations on the TO field at both the create trip and the 
                 * search trip form.*/
                 $('#destination').keyup(function() {
                   $(this).parent().children('.suggest').fadeIn('slow');
                   $.post("http://localhost/carshare/locationsuggest", 
                        {destination: $(this).val() }, 
                        function(data) {
                            $('#destination').parent().children('.suggest').html(data);
                   });
                 });
                 /* remove the .suggest box on cliking outside an input */  
                 $('#destination').blur(function(){
                    $('.suggest').fadeOut(); 
                 });
                 /* Show Jquery's user interface's date popup*/
                 $("#when").datetimepicker({ dateFormat: 'yy-mm-dd',stepMinute: 15 });
                 
                 /*Remove content from inputs when clicking on them.*/
                 /*$("#from").focus(function(){
                     $(this).val('');
                 });
                 $("#to").focus(function(){
                     $(this).val('');
                 });*/
                 
                 $("#username").focus(function(){
                     $(this).val('');
                 });
                 $("#password").focus(function(){
                     $(this).val('');
                 });
                 
                 /*ADMIN SITE*/
                 
                 $('.delete_area').click(function(){
                    var label = $(this).attr('id');
                    var id = get_id_from_link(label);
                    $('#area_list').load('delete_area/'+id);
                });
                
                $('.edit_area').click(function(){
                    var label = $(this).attr('id');
                    var id = get_id_from_link(label);
                    $('.add_box').load('edit_area/'+id);
                }); 
                
                $( ".sortable" ).sortable({
                    update: function(){
                    var neworder = '';
                    $('.sortable li').each(
                        function(index){
                            item_id = $(this).attr('id');
                            id_array = item_id.split("_");
                            neworder = neworder + id_array[1] + '_';
                     });
                    neworder = neworder.slice(0,neworder.length - 1);
                
                    if($(this).attr('id') == "product_list"){
                        $("#areas_list").load('sort_areas/'+neworder);
                    }
                    if($(this).attr('id') == "category_list"){
                        $("#cities_list").load('sort_cities/'+neworder);
                    }
                }
            });
                
            });

