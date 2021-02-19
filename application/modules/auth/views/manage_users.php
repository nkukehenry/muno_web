<div class="card-group-control card-group-control-right" id="accordion-control-right">
<div class="card col-md-12">
        <div class="card-header">
            <h6 class="card-title">
                <a class="collapsed text-default" data-toggle="collapse" href="#accordion-control-right-group2">
                <i class="icon-add mr-2"></i> Add User
                </a>
            </h6>
        </div>

        <div id="accordion-control-right-group2" class="collapse" data-parent="#accordion-control-right">
            
        
        <form action="<?=BASE_URL?>auth/saveUser" method="post" class="p-2">
            
                <div class="row">
                  
                    <div class="col-lg-12 p-2">
                        <div class="row">

                        <?php ($this->session->flashdata('msg'))?'<h3>'.$this->session->flashdata('msg').'</h3>':''; ?>

                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Full Name</label>
                                <input type="text" name="names" placeholder="Full Name" class="form-control" required>
                            </div>

                            <div class="form-group">
                            <label>Username</label>
                                <input type="text" name="username" placeholder="Username" class="form-control" required autocomplete="off">
                            </div>
                            <div class=" form-group">
                            <label>Password</label>
                                <input type="password" name="password" placeholder="Password" class="form-control" required  autocomplete="off">
                            </div>
                            <div class=" form-group">
                            <label>Email</label>
                                <input type="email" name="email" placeholder="Email" class="form-control" required>
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                            <label>Choose Permissions (CTRL + Click to select more)</label>
                                    <select multiple data-placeholder="Select Permissions" class="form-control form-control-select2" name="permissions[]" required>
                                        <?php foreach($permissions as $perm): ?>
                                        <option value="<?=$perm->id?>"><?=ucwords(str_replace('_',' ',$perm->description))?></option>
                                        
                                        <?php endforeach; ?>
                                    </select>
                            </div>
                            <div class="form-group col-md-4 text-center" > 
                                <button type="submit" class="btn btn-dark btn-block btn-sm">SAVE USER</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

        </form>
        </div>
    </div>
    </div>

		

		<div class="card card-body">

        <fieldset>
		  <legend class="font-weight-semibold"><i class="icon-users mr-2"></i><?=$this->lang->line('existing_users');?></legend>
        </fieldset>

        <table class="table table-striped">
         <thead>
            <th>Full Name</th>
            <th>Username</th>
            <th>Last Login</th>
         </thead>
         <?php foreach($users as $user): ?>
         <tr>
            <td><?=$user->name?></td>
            <td><?=$user->login?></td>
            <td><?=$user->last_login?></td>
            <td>
            <td class="text-center">
	        	<i class="icon-menu text-dark" data-toggle="dropdown"></i>
				 <div class="dropdown-menu dropdown-menu-right">
                        <a href="#<?php echo $user->id; ?>permissions" class="dropdown-item">
                        <i class="icon-brain"></i>View Permissions</a>
                        
                        <a href="<?=BASE_URL?>auth/edit/<?php echo $user->id; ?>" class="dropdown-item">
                        <i class="icon-delete"></i>Edit User</a>
                        <div class="dropdown-divider"></div>
                        <a href="#<?php echo $user->id; ?>" class="dropdown-item text-danger">
                        <i class="icon-bin"></i> Delete User</a>
				 </div>
	        	</td>
            
            </td>
         </tr> 

         <?php endforeach; ?>                                            
        </table>


	    </div>