<?php if (validation_errors()) : ?>
<div class="notification error">
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>

<div class="admin-box">
	<h3><?php echo $toolbar_title ?> <?php echo isset($role) ? ': '. $role->role_name : ''; ?></h3>
	
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
	
	<fieldset>
		<legend><?php echo lang('role_details') ?></legend>
	
		<div class="control-group <?php echo form_has_error('role_name') ? 'error' : ''; ?>">
			<label for="role_name"><?php echo lang('role_name'); ?></label>
			<div class="controls">
				<input type="text" name="role_name" class="input-xlarge" value="<?php echo isset($role) ? $role->role_name : '' ?>" />
				<span class="help-inline"><?php echo form_error('role_name'); ?></span>
			</div>
		</div>
	
		<div class="control-group <?php echo form_has_error('description') ? 'error' : ''; ?>" style="vertical-align: top">
			<label for="description"><?php echo lang('bf_description'); ?></label>
			<div class="controls">
				<textarea name="description" rows="3" class="input-xlarge"><?php echo isset($role) ? $role->description : '' ?></textarea>
				<span class="help-inline"><?php echo form_error('description') ? form_error('description') : lang('role_max_desc_length'); ?></span>
			</div>
		</div>
	
		<div class="control-group <?php echo form_has_error('login_destination') ? 'error' : ''; ?>">
			<label for="login_destination"><?php echo lang('role_login_destination'); ?>?</label>
			<div class="controls">
				<input type="text" name="login_destination" class="input-xlarge" value="<?php echo isset($role) ? $role->login_destination : '' ?>"  />
				<span class="help-inline"><?php echo form_error('login_destination') ? form_error('login_destination') : lang('role_destination_note'); ?></span>
			</div>
		</div>
	
		<div class="control-group <?php echo form_has_error('default') ? 'error' : ''; ?>">
			<div class="controls">
				<label>
					<input type="checkbox" name="default" value="1" <?php echo isset($role) && $role->default == 1 ? 'checked="checked"' : '' ?> />
					<?php echo lang('role_default_note'); ?>
				</label>
			</div>
		</div>
	
		<div class="control-group">
			<label for="can_delete"><?php echo lang('role_can_delete_role'); ?>?</label>
			<div class="controls">
				<div class="inputs-list">
					<label>
						<input type="radio" name="can_delete" value="1" <?php echo isset($role) && $role->can_delete == 1 ? 'checked="checked"' : '' ?> /> Yes
					</label>
					<label>
						<input type="radio" name="can_delete" value="0" <?php echo isset($role) && $role->can_delete == 0 ? 'checked="checked"' : '' ?> /> No
					</label>
					<span class="help-inline" style="display: inline"><?php echo lang('role_can_delete_note'); ?></span>
				</div>
			</div>
		</div>
		
		</fieldset>
	
		<!-- Permissions -->
		<?php if (has_permission('Permissions.Settings.Manage')) : ?>
		<fieldset>
			<legend><?php echo lang('role_permissions'); ?></legend>
				<br/>
				<p class="intro"><?php echo lang('role_permissions_check_note'); ?></p>
	
				<?php echo modules::run('roles/settings/matrix'); ?>
	
		</fieldset>
		<?php endif; ?>
	
		<div class="form-actions">
			<input type="submit" name="submit" class="btn primary" value="<?php echo lang('role_save_role'); ?>" /> or <?php echo anchor(SITE_AREA .'/settings/roles', lang('bf_action_cancel')); ?>
		</div>
	
		<?php if (isset($role) && $role->can_delete && has_permission('Bonfire.Roles.Delete')) : ?>
		<div class="box delete rounded">
			<h3><?php echo lang('role_delete_role'); ?></h3>
	
			<p><?php echo lang('role_delete_note'); ?></p>
	
			<a class="btn danger" href="<?php echo site_url(SITE_AREA .'/settings/roles/delete/'. $role->role_id); ?>" onclick="return confirm('Are you sure you want to delete this role?')"><?php echo lang('role_delete_role'); ?></a>
		</div>
		<?php endif; ?>
	<?php echo form_close(); ?>
</div>