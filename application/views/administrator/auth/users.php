
<div class="card m-3">
    <div class="card-header">
        <h4 class="card-title">Data User</h4>
		<a href="<?php echo base_url()."auth/create_user"; ?>" class="btn btn-sm btn-outline-primary">Tambah</a>
    </div>
    <div class="card-body">
        <table width="100%" class="table table-bordered table-striped">
            <thead class="thead-dark text-center" style="v-align:middle">
                <tr>
                    <th>Action</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>User Groups</th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach($users as $user): ?>
                    <tr>
						<td style="width:3%;" class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-outline-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu">
                                    <a href="<?php echo base_url()."auth/edit_user/{$user->id}"; ?>" class="dropdown-item btn btn-sm btn-outline-primary">Edit</a>
                                    <div class="dropdown-divider"></div>
                                    <a href="<?php echo base_url()."auth/reset_password_user/{$user->id}"; ?>" class="dropdown-item btn btn-sm btn-outline-primary">Reset Password</a>
                                </div>
                            </div>
                            
                        </td>
						<td style="width:10%"><?php echo htmlspecialchars($user->first_name,ENT_QUOTES,'UTF-8');?></td>
						<td style="width:10%"><?php echo htmlspecialchars($user->username,ENT_QUOTES,'UTF-8');?></td>
						<td style="width:10%"><?php echo htmlspecialchars($user->email,ENT_QUOTES,'UTF-8');?></td>
						<td style="width:10%">
							<?php foreach ($user->groups as $group):?>
                                <?= $group->name ?><br />
							<?php endforeach?>
						</td>
						<!-- <td style="width:10%"><?php echo ($user->active) ? anchor("auth/deactivate/".$user->id, lang('index_active_link')) : anchor("auth/activate/". $user->id, lang('index_inactive_link'));?></td> -->
                    </tr>
                <?php endforeach?>
            </tbody>
        </table>
    </div>
</div>
