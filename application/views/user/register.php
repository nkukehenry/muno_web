		
		<div class="clearFix"></div>
		<div class="contentBody w500">
			<div class="midcontentBody">
			<?php

				echo form_open(base_url() . 'user/register');
				$username = array(
													'name' => 'username',
													'id'	 => 'username',
													'value'	 => ''
												);
												
												
				 $password = array(
													 'name' => 'password',
													 'id'	 => 'password',
													 'value'	 => ''
													);
												
				 $password_conf = array(
														'name' => 'password_conf',
														'id'	 => 'password_conf',
														'value'	 => ''
													);
												
			
			?>
			
			
			
			<table>
				<tr>
					<td>
						Username:
					</td>
					<td>
						 <?php echo form_input($username); ?>
					</td>
				</tr>
				<tr>
					<td>
						Password:
					</td>
					<td>
						 <?php echo form_password($password); ?>
					</td>
				</tr>
				<tr>
					<td>
						Confirm Password:
					</td>
					<td>
						 <?php echo form_password($password_conf); ?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>  <?php echo form_submit(array('name' => 'submit_name', 'id' => 'submit_id', ), 'Register'); ?></td>
				</tr>
			</table>
			<table>
				<tr>
					<td>
						 <font color="#AA0000" face="Arial">
						  <?php echo validation_errors(); ?>
						  <?php echo $this->session->flashdata('insertdata'); ?>
						 </font>    
					</td>
				</tr>
			</table>
			</div>
		</div>
