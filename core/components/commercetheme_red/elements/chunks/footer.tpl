<footer id="footer" class="mt-3">
	<div class="container">
		<div class="row text-center text-xs-center text-sm-left text-md-left text-white">
			<div class="col-xs-12 col-sm-4 col-md-4 py-md-3">
				<h5>[[++ctred.footer_header_one]]</h5>
				[[pdoMenu?
                    &parents=`0`
                    &level=`1`
                    &outerClass=`list-unstyled quick-links`
                    &tpl=`@INLINE <li[[+classes]]><a href="[[+link]]" [[+attributes]]>[[+menutitle]]</a>[[+wrapper]]</li>`
                ]]
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-md-4 py-md-3">
				<h5>[[++ctred.footer_header_two]]</h5>
				<ul class="list-unstyled quick-links">
					[[++ctred.quick_link_01_text:notempty=`
					<li>
						<a href="[[++ctred.quick_link_01_url]]">[[++ctred.quick_link_01_text]]</a>
					</li>
					`]]
					[[++ctred.quick_link_02_text:notempty=`
					<li>
						<a href="[[++ctred.quick_link_02_url]]">[[++ctred.quick_link_02_text]]</a>
					</li>
					`]]
					[[++ctred.quick_link_03_text:notempty=`
					<li>
						<a href="[[++ctred.quick_link_03_url]]">[[++ctred.quick_link_03_text]]</a>
					</li>
					`]]
					[[++ctred.quick_link_04_text:notempty=`
					<li>
						<a href="[[++ctred.quick_link_04_url]]">[[++ctred.quick_link_04_text]]</a>
					</li>
					`]]
					[[++ctred.quick_link_05_text:notempty=`
					<li>
						<a href="[[++ctred.quick_link_05_url]]">[[++ctred.quick_link_05_text]]</a>
					</li>
					`]]
					[[++ctred.quick_link_06_text:notempty=`
					<li>
						<a href="[[++ctred.quick_link_06_url]]">[[++ctred.quick_link_06_text]]</a>
					</li>
					`]]
				</ul>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-md-4 py-md-3">
				<h5>[[++site_name]]</h5>
				[[++ctred.footer_content]]
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-md-4 py-md-3 text-center text-white">
				[[++ctred.footer_bottom_row_content]]
			</div>
			</hr>
		</div>	
	</div>
</footer>
[[-
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
]]
<script>
    window.CommerceConfig = {
        cart_url: '[[~[[++commerce.cart_resource]]:htmlent]]',
        checkout_url:  '[[~[[++commerce.checkout_resource]]:htmlent]]',
        i18n: {
            shipping: '[[!%commerce.shipping:htmlent]]',
            tax: '[[!%commerce.tax:htmlent]]'
        }
    }
</script>
<script src="[[++ctred.assets_url]]js/main.js"></script>
</body>
</html>