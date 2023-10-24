		<?php get_template_part( 'fragments/footer/subscribe' ); ?>
<div class="section-head">
	<div class="shell cert">
	<?php get_template_part( 'fragments/footer/certifications' ); ?>
	</div>
</div>
		<footer class="footer">


			<div class="footer-bar">
				<div class="shell">
					<?php
					get_template_part( 'fragments/footer/socials' );
					get_template_part( 'fragments/footer/copyright' );
					?>
				</div><!-- /.shell -->
			</div><!-- /.footer-bar -->
		</footer><!-- /.footer -->
	</div><!-- /.wrapper -->
	  <script type="text/javascript">
		jQuery(document).ready(function($) {
		  function setCookie(name,value,days) {
		    var expires = "";
		    if (days) {
		        var date = new Date();
		        date.setTime(date.getTime() + (days*24*60*60*1000));
		        expires = "; expires=" + date.toUTCString();
		    }
		    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
		}
            $('.view-current-inventory').click(function(){
                
                setCookie("pum-5956",true,30);

            });
        });
    </script>
	<?php wp_footer(); ?>
</body>
</html>