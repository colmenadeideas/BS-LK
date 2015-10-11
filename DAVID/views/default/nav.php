<!-- Fixed navbar -->
<div id="menu" class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand " href="<?php echo URL.'miweb';?>"><img src="<?php echo IMG; ?>puntolaser-mostradordigital-2.png" height="45" style="margin-top: -10px;"  title="MOSTRADOR DIGITAL" ></a>
			
		</div>
		<div class="navbar-collapse collapse">
			
			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">¿Qué desea hacer? <b class="caret"></b></a>
					<ul class="dropdown-menu">
						
						<!--li class="dropdown-header">
							Producción
						</li-->
						<?php foreach ($this->menu as $Menu) { ?>
						<li>
							<a href="#<?php echo $Menu['url']; ?>"><img src="<?php echo IMG.$Menu['icon']; ?>" width="35" class="hidden-sm hidden-xs" /> <?php echo $Menu['name']; ?></a>
						</li>
						<?php  }?>					
						
					</ul>
				</li>
				<li class="active">
					<a href="<?php echo URL; ?>account/profile"><?php echo $this -> userdata[0]['username']; ?></a>
				</li>
				<li >
					<a href="<?php echo URL; ?>account/logout">Salir</a>
				</li>
			</ul>
		</div><!--/.nav-collapse -->
	</div>
</div>
<div id="desktop" > <!--removed class="container" so the background could change in upload -->	