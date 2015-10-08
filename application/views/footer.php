        <?php include_once('bottom.php');?>
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X','auto');ga('send','pageview');
        </script>
		
		<script type="text/javascript">_satellite.pageBottom();</script>
		
		<!--<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>-->
		
		<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
		
		
		<a href="javascript:;" onClick="toTopMore();" class="back-to-top"></a>
		
		<script type="text/javascript">
		function toTopMore(){
			$('html, body').animate({ scrollTop: 0 }, 'fast');
		}
		</script>
		
		<style>
		a.back-to-top {
			width: 40px;
			height: 40px;
			position: fixed;
			z-index: 999;
			bottom: 20px;
			border: 1px solid #999;
			background: #fff url(http://dignity.memorialflowers.ca/images/chevron-up.png) no-repeat center 43%;
			background-size: 26px 32px;
			-webkit-border-radius: 0px;
			-moz-border-radius: 0px;
			border-radius: 0px;
		}
		a:hover.back-to-top {
			background-color: #D9D9D9;
		}
		</style>
		
		<style>
		@media screen and (min-width : 1600px) {
			a.back-to-top{
				right: 15%;
			}
		}
		@media screen and (min-width : 1100px) and (max-width : 1599px) {
			a.back-to-top{
				right: 3%;
			}
		}
		@media screen and (min-width : 840px) and (max-width : 1099px) {
			a.back-to-top{
				right: 0%;
			}
		}
		@media screen and (min-width : 0px) and (max-width : 839px) {
			a.back-to-top{
				display:none;
			}
		}
		
		</style>

		
		
    </body>
</html>
