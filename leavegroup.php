<?php
session_start();
include 'connect.php';

if (isset($_GET['leavegroup'])) {
    $group_id = $_GET['group_id'];
    $user_id = $_GET['session_id'];

    

    $leavechatgroup_query = "DELETE FROM groupmember WHERE user_id = '$user_id' AND group_id = '$group_id'";
    $leavechatgroup_query_result = mysqli_query($connection, $leavechatgroup_query);

    if ($leavechatgroup_query_result) {
        $_SESSION['leave_message'] = "You have successfully left the group.";
        header("Location: index.php");
        exit;
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
           <strong>Warning!</strong> Something went wrong!
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>';
        echo "Error: " . mysqli_error($connection);
        exit;
    }
}
?>