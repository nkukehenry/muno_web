	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper bg-dark">

			<!-- Content area -->
			<div class="content  d-flex justify-content-center align-items-center">

				<!-- Login form -->
				<form class="login-form col-md-3 " method="post" action="<?php echo BASE_URL; ?>auth/validate">
					<div class="card mb-0">
						<div class="card-body">
							<div class="text-center mb-3">
								<i class="icon-user icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
								<h5 class="mb-0">Login to your account</h5>
								<span class="d-block text-muted">Enter your credentials below</span>

								<?php echo $this->session->flashdata('msg');?>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="text" name="login" class="form-control" placeholder="Username">
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="password" name="credential" class="form-control" placeholder="Password">
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-dark btn-block">Sign in <i class="icon-circle-right2 ml-2"></i></button>
							</div>

							<div class="text-center">
								<!-- <a href="">Forgot password?</a> -->
							</div>
						</div>
					</div>
				</form>
				<!-- /login form -->

			</div>
			<!-- /content area -->


			

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->