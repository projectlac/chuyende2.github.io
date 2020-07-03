<?php 
$id=$_GET['page'];
include("header.php");
$chitiet = laychitietthongtin($id);







?>
<div class="tin-tuc-moi-nhat hiddenx">
	
<div class="banner-tintuc">
	<div class="col-md-6">
		<div style=" height: 250px; width: 450px;">
			<a href="index.php"><img src="images/logo-bang.png" alt=""></a>
		</div>
	</div>
	<div class="col-md-6">
		<div style=" height: 250px; width: 450px;float: right;">
			<a href="index.php"><img src="images/logo-yltb.png" alt=""></a>
		</div>
	</div>
</div>
<div class="body-tintuc">
	<div class="box">
		<div class="top"></div>
		<div class="bot"></div>
		<div class="center"></div>
		<div class="content">
			<div class="left">
				<div class="fanpage">
					<div style="margin:0 auto ">
						<span>FAN PAGE</span>
						<span class="fp">
							<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FDahanhluc%2F&tabs=timeline&width=340&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="100%" height="410" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
						</span>
					</div>
				</div>


			</div>
			<div class="right">
				<div class="tieudecua-tintuc">
					<!-- <div class="thoigian"></div> -->
					<div class="tieude-tin">
						
						<?=$chitiet['news_name']?>
						<span><?=$chitiet['news_created_date']  ?></span>
					</div>
				</div>
				<div class="noidungcua-tintuc">
					<?=$chitiet['news_content']?>
				</div>
			</div>
		</div>
		
	</div>
</div>
	<span class="b-l"></span>
	<span class="b-m"></span>
	<span class="b-r"></span>
</div>
<div class="tin-tuc-moi-nhat-mobile">

	<div class="page-news">
		<div class="linkTrangchu"><a href="index.php">Trang chủ</a></div>
		<div class="page-news-content">
			<h1 class="arttitle">
				<?=$chitiet['news_name']?>
			</h1>
			<p class="artdate">
				<?=$chitiet['news_created_date']  ?>
			</p>
			<div class="noidungtin">
				<?=$chitiet['news_content']?>
			</div>
		</div>
	</div>
</div>
<?php include("footer.php") ?>