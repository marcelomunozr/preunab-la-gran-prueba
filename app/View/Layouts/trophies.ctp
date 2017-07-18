<?php echo $this->fetch('content'); ?>
<script>
	$(document).ready(function(){
		$('.bg-principal').addClass('bg-preguntas');
		$('.bg-principal').removeAttr("style")
		$('.bg-principal').css("background-image", "url(images/bg-trophies.jpg)");
		$('.top-menu').hide();
		$('.el-ranking').hide();
	});
</script>
