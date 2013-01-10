<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?=$title?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="author" content="Andreas Thuresson">
	
	<link rel='stylesheet' type='text/css' href='style.php' />
	<link rel="stylesheet" href="<?=$stylesheet?>">
	<?php if(isset($inline_style)): ?><style><?=$inline_style?></style><?php endif; ?>
</head>
<body>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        			<span class="icon-bar"></span>
         			<span class="icon-bar"></span>
       			</a>
       			<a class="brand" href="<?=base_url(null)?>"><?=@$header?></a>
       			<div class="nav-collapse" id="main-menu">
        			<ul class="nav" id="main-menu-left">
        				<li><span class="icon-bar"></span></li>
        				<li><span class="icon-bar"></span></li>
          				<?=login_bootstrap_menu();?>
          			</ul>
       			</div>
     		</div>
   		</div>
 	</div>

    <div class="container" >
    	<br/><br/>
    	<header class="jumbotron subhead" id="overview">
  			<div class="row">
    			<div class="span6">
      				<h1><?=render_views('header')?></h1>
    			</div>
  			</div>
		</header>
    
		<section id="page">
			<div class="row-fluid">
				<div id="div-content" class="span8">
					<?=@$main?>
      				<?=render_views()?>
      				<?=render_views('content')?>
      			</div>
      			<?php if(region_has_content('sidebar')): ?>
      			<div id="div-sidebar" class="span4" >
					<?=@$sidebar?>
					<?=render_views('sidebar')?>
      			</div>
      			<?php endif; ?>
			</div>
		</section>
		
		<br><br><br><br>
      	<hr>
      	
		<footer id="footer">
			<p class="pull-right"><a href="#">Back to top</a></p>
			<?=$footer?>
			<?=render_views('footer')?>
        	<?=get_debug()?>
      	</footer>	
	</div>
</body>
</html>