<!DOCTYPE html>
<html lang="en">
  <head>
    <?php $this->load->view($this->uri->segment(1).'/header'); ?>
	<meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
	</head>
  <body>
  <section>
    <div id="preloader">
			<div id="ctn-preloader" class="ctn-preloader">
				<div class="animation-preloader">
					<div class="text-center mb-3" style="margin-top:-100px;">
          <img src="<?=base_url('assets/img/icon.png')?>" style="width:100px;">
          </div>
					<div class="txt-loading">
						<span data-text-preloader="L" class="letters-loading">
							L
						</span>
						
						<span data-text-preloader="O" class="letters-loading">
							O
						</span>
						
						<span data-text-preloader="A" class="letters-loading">
							A
						</span>
						
						<span data-text-preloader="D" class="letters-loading">
							D
						</span>
						
						<span data-text-preloader="I" class="letters-loading">
							I
						</span>
						
						<span data-text-preloader="N" class="letters-loading">
							N
						</span>
						
						<span data-text-preloader="G" class="letters-loading">
							G
						</span>
					</div>
				</div>	
				<div class="loader-section section-left"></div>
				<div class="loader-section section-right"></div>
			</div>
		</div>
	</section>

  <?php $this->load->view($this->uri->segment(1).'/content'); ?>
  
  <?php $this->load->view($this->uri->segment(1).'/footer'); ?>
  <script>
     $(document).ready(function() {
      setTimeout(function() {
        $('#ctn-preloader').addClass('loaded');
        // Una vez haya terminado el preloader aparezca el scroll
        $('body').removeClass('no-scroll-y');

        if ($('#ctn-preloader').hasClass('loaded')) {
          // Es para que una vez que se haya ido el preloader se elimine toda la seccion preloader
          $('#preloader').delay(500).queue(function() {
            $(this).remove();
          });
        }
      }, 500);
    });
  </script>
  </body>
</html>
