	<?php global $options; foreach ($options as $value) {
    	if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
	}?>
	</div></div> <!-- /container for Ajax-->
	<!-- Footer -->
	<footer>
		<!-- Copyright -->
		<p class="footer_left">
			 <?php if ($kt_copyright){?> &copy; <?php echo date("Y");?> Copyright <?php bloginfo('name');} if($kt_footer_left) { echo $kt_footer_left; }?>
		</p>
		<!-- /Copyright -->
		<!--Custom right footer text-->
		<p class="footer_right">
			<?php if ($kt_footer_text != '') {?>
				<?php echo $kt_footer_right;  }
			if ($kt_author){?> Kiera Theme developed by <a href="http://gandzo.com">Gandzo Web Team</a><?php } ?> 
		</p>
		<!--/Custom right footer text-->
		<?php if ($kt_ga){
			echo $kt_ga;
		}?>
	</footer>
	<!-- /Footer -->
	
	<?php wp_footer(); ?>

</body>
</html>