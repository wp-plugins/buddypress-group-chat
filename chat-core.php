<?php
class BP_tinychat_group_chat extends BP_Group_Extension {	
	public function  __construct() {
		global $bp;
		$this->name = 'Group Chat';
		$this->slug = 'group-chat';
		$this->create_step_position = 100;
		$this->nav_item_position = 283;
		if ( groups_get_groupmeta( $bp->groups->current_group->id, 'bp_tinychat_group_chat_enabled' ) == '1' ) {
			$this->enable_nav_item = true;
		} else {
			$this->enable_nav_item = false;}
			}
public function create_screen($group_id = null) {
		global $bp;
		if ( !bp_is_group_creation_step( $this->slug ) )
			return false;
		wp_nonce_field( 'groups_create_save_' . $this->slug ); ?>
<input type="checkbox" name="bp_tinychat_group_chat_enabled" id="bp_tinychat_group_chat_enabled" value="1"  
			<?php if ( groups_get_groupmeta( $bp->groups->current_group->id, 'bp_tinychat_group_chat_enabled' ) == '1' ) {echo 'checked=1';}?>		/>
        Enable Group Chat
		<hr>
		<?php }
public function create_screen_save($group_id = null) {
		global $bp;
		check_admin_referer( 'groups_create_save_' . $this->slug );	
		if ( $_POST['bp_tinychat_group_chat_enabled'] == 1 ) {
			groups_update_groupmeta( $bp->groups->current_group->id, 'bp_tinychat_group_chat_enabled', 1 );}}
public	function edit_screen($group_id = null) {
		global $bp;
		if ( !groups_is_user_admin( $bp->loggedin_user->id, $bp->groups->current_group->id ) ) {
			return false;}	
		if ( !bp_is_group_admin_screen( $this->slug ) )
			return false;
		wp_nonce_field( 'groups_edit_save_' . $this->slug );?>
<input type="checkbox" name="bp_tinychat_group_chat_enabled" id="bp_tinychat_group_chat_enabled" value="1"  
<?php if ( groups_get_groupmeta( $bp->groups->current_group->id, 'bp_tinychat_group_chat_enabled' ) == '1' ) {echo 'checked=1';}?>/>
        Enable Group Chat
		<hr>
		<input type="submit" name="save" value="Save" />
		<?php }
public	function edit_screen_save($group_id = null) {
		global $bp;
		if ( !isset( $_POST['save'] ) )
			return false;
		check_admin_referer( 'groups_edit_save_' . $this->slug );
		if ( $_POST['bp_tinychat_group_chat_enabled'] == 1 ) {
			groups_update_groupmeta( $bp->groups->current_group->id, 'bp_tinychat_group_chat_enabled', 1 );
		} else {
			groups_update_groupmeta( $bp->groups->current_group->id, 'bp_tinychat_group_chat_enabled', 0 );}
		bp_core_add_message( __( 'Settings saved successfully', 'buddypress' ) );
		bp_core_redirect( bp_get_group_permalink( $bp->groups->current_group ) . 'admin/' . $this->slug );}
public	function display($group_id = null) {
		global $bp;?>
            <?php
			echo '<div id="message" class="error"><p>Plugin only available on Github!</p></div>';
			}} bp_register_group_extension( 'BP_tinychat_group_chat' ); ?>