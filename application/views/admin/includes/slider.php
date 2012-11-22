<!-- Panel -->
<div id="toppanel">
	<div id="panel">
		<div class="content clearfix">
			<div class="left">
                            <div id="login_form">
                                <?php echo login_box(); ?>
                            </div>
                            <?php 
                                if($logged_in == TRUE) { // content for logged in users ?>
               
                                <a id="invitation_link" href="#"> Invite a friend </a><br />
                                <a id="" href="users/profile">My Settings</a>
                            <?php } ?>
			</div>
			
                        <div id="cart_box" class="left right">
                            Cart
                            <?php /*show_cart();*/ ?>
			</div>
		</div>
</div> <!-- /login -->	

	<!-- The tab on top -->	
	<div class="tab">
             <?php echo panel_title(); ?>
		<!--ul class="login">
			<li class="left">&nbsp;</li>
			<li>Hello Guest!</li>
			<li class="sep">|</li>
			<li id="toggle">
				<a id="open" class="open" href="#">Log In | Register</a>
				<a id="close" style="display: none;" class="close" href="#">Close Panel</a>			
			</li>
			<li class="right">&nbsp;</li>
		</ul--> 
	</div> <!-- / top -->
	
</div> <!--panel -->