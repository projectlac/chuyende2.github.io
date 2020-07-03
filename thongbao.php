<?php $tintuc = laythongtin(); ?>
<div class="noidung-thongbao">
	<div class="col-md-6 col-sm-6 col-xs-12 hiddenx">
	<iframe width="100%" height="350" src="https://www.youtube.com/embed/wV-czrDcbfY" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>
<div class="col-md-6 col-sm-6 col-xs-12">
	<?php foreach ($tintuc as $item) {
	// var_dump($item); ?>
	<div class="noidung-text">
		<div class="col-md-9"><a href="chitiet-tintuc.php?page=<?=$item['friendly_url']?>"><p>
			<?=$item['news_name'] ?>
		</p></a>
		</div>
		<div class="col-md-3 hiddenx">
			<span><?=substr($item['news_created_date'],0,11)  ?></span>
		</div>

		<div class="hel">.................................</div>
	</div>
<?php } ?>
	

</div>
</div>
<div class="nenthongbao">
	 <img src="images/web/thongbao.png" alt="">
</div>