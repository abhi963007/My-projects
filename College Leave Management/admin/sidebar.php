<div id="side_bar">
    <ul>
        <li class="menu_head">Control Panel</li>
        <li class="<?php if ($page == 'add_staff') { echo 'activec';}?>"><a href="add_staff.php">Add Students</a></li>
        <li class="<?php if ($page == 'view_staff') { echo 'activec';}?>"><a href="view_staff.php">View Students</a></li>
        <li class="<?php if ($page == 'update_staff') { echo 'activec';}?>"><a href="search_staff_for_updation.php">Update Students</a></li>
        <li class="<?php if ($page == 'delete_staff') { echo 'activec';}?>"><a href="search_staff_for_deletion.php">Delete Students</a></li>
        <li class="<?php if ($page == 'add_leave') { echo 'activec';}?>"><a href="add_leave.php">Add Leave Type</a></li>
        <li class="<?php if ($page == 'delete_leave') { echo 'activec';}?>"><a href="delete_leave_type.php">Delete Leave Type</a></li>
        <li class="<?php if ($page == 'program_coordinator') { echo 'activec';}?>"><a href="search_staff_to_assign_pc.php">Teacher</a></li>
        <li class="<?php if ($page == 'program_coordinator') { echo 'activec';}?>"><a href="approve_reject_admin.php">Leave Approval</a></li>

        <!-- Links for Program Coordinator Management -->
        <li class="<?php if ($page == 'view_pc') { echo 'activec';}?>"><a href="view_pc.php">View Teachers</a></li>
        <li class="<?php if ($page == 'add_pc') { echo 'activec';}?>"><a href="add_pc.php">Add Teachers</a></li>
        <li class="<?php if ($page == 'update_pc') { echo 'activec';}?>"><a href="select_pc_to_update.php">Update Teachers</a></li>
    </ul>
</div>
