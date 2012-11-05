<body>
     <div id="wrapper">
         <h1 id="carshare">CAR SURFING</h1>
         <a href="en">English</a> | <a href="el">Ελληνικά</a>
         <div id="column_right">
            <div id="login_form">
                <?php echo login_box(); ?>
                
            </div>
            <?php 
            if($logged_in == TRUE) { // content for logged in users ?>
               
                <a id="invitation_link" href="#"> Invite a friend </a><br />
                <a id="" href="users/profile">My Settings</a>
            <?php } ?>
         </div>
