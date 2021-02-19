<div class="col-md-12 card card-body">
        <form action="<?=BASE_URL?>auth/saveEdit" method="post">
            <fieldset>
                <legend class="font-weight-semibold"><i class="icon-user mr-2"></i>
                  Edit  <?=$user->name;?>
                </legend>

                <div class="form-group row">
                    <div class="col-lg-12">
                        <div class="row">

                        <?php ($this->session->flashdata('msg'))?'<h3>'.$this->session->flashdata('msg').'</h3>':''; ?>

                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Full Name</label>
                                <input type="text" name="names" placeholder="Full Name" value="<?=$user->name?>" class="form-control" required>
                            </div>

                            <div class="form-group">
                            <label>Username</label>
                                <input type="text" name="username" value="<?=$user->login?>" placeholder="Username" class="form-control" required autocomplete="off">
                            </div>
                            <div class=" form-group">
                            <label>Password</label>
                                <input type="password" name="password" value="" placeholder="Password" class="form-control"   autocomplete="off">
                            </div>
                            <div class=" form-group">
                            <label>Email</label>
                                <input type="email" name="email" value="<?=$user->email?>" placeholder="Email" class="form-control" required>
                                <input type="hidden" name="user_id" value="<?=$user->id?>">
                            </div>
                            </div>

                            <div class="col-md-6">
                            <div class="form-group">
                            <label>Login Status</label>
                                <select name="active" class="form-control">
                                      <option value='1'>Active</option>
                                      <option value='0'>Block</option>
                                </select>
                             </div>
                            <div class="form-group">
                            <label>Choose Permissions (CTRL + Click to select more)</label>
                                    <select multiple data-placeholder="Select Permissions" class="form-control form-control-select2" name="permissions[]" required>
                                        <?php foreach($permissions as $perm):
                                            $selected= "";
                                            if( in_array($perm->id,$user_permissions) )
                                              $selected= "selected = 'selected'";
                                        ?>
                                        <option value="<?=$perm->id?>" <?=$selected?> ><?=ucwords(str_replace('_',' ',$perm->description))?></option>
                                        
                                        <?php endforeach; ?>
                                    </select>
                            </div>
                            <div class="form-group col-md-4 text-center" > 
                                <button type="submit" class="btn btn-dark btn-block btn-sm">SAVE CHANGES</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

            </fieldset>
        </form>
</div>