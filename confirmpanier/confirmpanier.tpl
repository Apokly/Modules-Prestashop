
<script type="text/javascript">
		var cpDisplayLogo = {$DISPLAY_LOGO};
		var headerFooterColor = "{$HEADER_FOOTER_COLOR}";
		var contentColor = "{$CONTENT_COLOR}";
		var textColor = "{$TEXT_COLOR}";
		var priceColor = "{$PRICE_COLOR}";
		var buttonBgColor = "{$BUTTON_BG_COLOR}";
		var buttonTextColor = "{$BUTTON_TEXT_COLOR}";
</script>

<div id="confirmPanier">
	<div id="cpDarkBG"></div>
		<span class="vAlignCenter"></span>
		<div id="blocConfirmation">
			<div id="cpHeader">
				<h2 id="cpLogo">
					<img width="200" src="" alt="" />
				</h2>
			</div>
			<div id="cpBody">
				<h3 id="cpHeaderText">
					{l s='Article added !' mod='confirmpanier'}
				</h3>
				<div id="cpInfo">
					<img src="" width="150" alt="" />
					<p class="cpTitle">
						
					</p>
					<div id="cpPriceInfo">
						<p class="cpQty">
							{l s='Quantity' mod='confirmpanier'} : <span class="cpQtyField"></span>
						</p>
						<p class="cpTotal">
							{l s='Total' mod='confirmpanier'} : <span class="cpTotalField"></span>
						</p>
					</div>
				</div>
			</div>
			<div id="cpStop">
				<input type="checkbox" id="cpStopShow" name="cpStopShow" /> <label for="cpStopShow">Ne plus afficher cette fenêtre</label>
			</div>
			<div id="cpLink">
				<a class="cpShopping" href="#" title="{l s='Continue shopping' mod='confirmpanier'}">{l s='Continue shopping' mod='confirmpanier'}</a>
				<a class="cpCart"  href="{$link->getPageLink('order')}" title="{l s='View cart' mod='confirmpanier'}">{l s='View cart' mod='confirmpanier'}</a>
				<div class="clear"></div>
			</div>
		</div>
</div>