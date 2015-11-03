
	<main class="logboxarea">
		<div class="vertical">



			<div class="logohome"> <img src="<?php echo IMG; ?>likes-home-logo.png" title="<3 LIKES" alt="likes"  /> </div>
			<form id="form-login" method="post" class="form-inline login text-center">
				<div class="form-group welcome">
					<p>¡Bienvenido!</p>						
				</div>


				<div id="logintype" class="logintype">
					<div id="mask">
						<!--log choices-->
						<div id="login_choices" class="logins">
								<button id="login_with_email_button" class="btn btn-default btn-lg btn-wide">
									Iniciar sesión
								</button>
								<br> ó <br>
								<a href="<?php echo $this->button; ?>" class="btn btn-default btn-lg btn-wide">
									<i class="fa fa-instagram"></i>
									Entrar con INSTAGRAM 
								</a>
								<br><br>
							<small>¿No tienes cuenta? <a href="#">REGISTRATE</a></small>
						</div>
						<!--log choices-->

						<!--log with email-->
						<div id="login_with_email" class="logins">
							<div class="login-inputs">	
								<i class="fa fa-envelope iconinput"></i>	<input type="email" name="email" class="form-control" id="email" placeholder="Email" required>					
							</div>
							<div class="login-inputs">	
								<i class="fa fa-key iconinput"></i> <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
							</div>
							<br>
							<small>
								<div class="left text-left">
									<label><input type="checkbox" checked="checked"> Mantener sesión</label>
								</div>
								<div class="right text-right">
									<a href="#"> ¿Olvidaste tu contraseña?</a>
								</div>
							</small>
							<p>&nbsp;</p>					
							<button type="submit" class="btn btn-success btn-lg right send">Iniciar sesión</button>
						</div>
						<!--log with email-->
					</div>
				</div>
				
				
					<div id="response-login"></div>
					<div class="clearfix"></div>
			</form>
		</div>
		<div class="back"></div>
	</main>