<?php

require_once '../../config/config.php';

requireRole('admin');

$section = $_GET['section'] ?? 'activity-logs';
$action = $_GET['action'] ?? '';



//  Activity Logs Query #3

$stmt = $pdo->query("
    SELECT
        activity_log_id,
        user_id,
        user_email,
        activity_log_action,
        activity_log_status,
        activity_log_ip_address,
        activity_log_user_agent,
        activity_log_created_at

    FROM activity_logs

    ORDER BY activity_log_created_at DESC
");

$activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

if($action == 'export'){
	
	if($section == 'activity-logs'){
		
		$stmt = $pdo->query("
			SELECT
				activity_log_id,
				user_id,
				user_email,
				activity_log_action,
				activity_log_status,
				activity_log_ip_address,
				activity_log_user_agent,
				activity_log_created_at
			FROM activity_logs
			ORDER BY activity_log_created_at
		");
		
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		logActivity(
			$pdo,
			$_SESSION['user_id'],
			$_SESSION['user_email'],
			'export_activity_logs',
			'success'
		);
		
		exportCsv(
			'activity_logs',
			[
				'Record ID', 'User ID', 'User Email', 'Action',
				'Status','IP Address', 'User Agent', 'Date & Time',
			],
			$rows
		);
	}
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Activity Logs</title>

</head>

<body>

    <h1>Welcome Admin</h1>
  <a href="./../auth/signout.php">Logout</a>
   
<?php if($section==='activity-logs'):?>
	
		<h4>Activity Logs
			<a href="index.php?section=activity-logs&amp;action=export">Export CSV</a>
		</h4>
		
		<table id="example" class="table table-striped" style="width:auto">



        <thead>

            <tr>
                 <th>Record ID</th>
                <th>User ID</th>
                <th>User Email</th>
                <th>Action</th>
                <th>Status</th>
                <th>IP Address</th>
                <th>User Agent</th>
                <th>Date & Time</th>
            </tr>

        </thead>


        <tbody>

            <?php foreach ($activities as $activity): ?>

                <tr>

                    <td>
                        <?= htmlspecialchars(
                            $activity['activity_log_id']
                        ) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars(
                            $activity['user_id']
                        ) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars(
                            $activity['user_email']
                        ) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars(
                            $activity['activity_log_action']
                        ) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars(
                            $activity['activity_log_status']
                        ) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars(
                            $activity['activity_log_ip_address']
                        ) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars(
                            $activity['activity_log_user_agent']
                        ) ?>
                    </td>

                    <td>
                        <?= htmlspecialchars(
                            $activity['activity_log_created_at']
                        ) ?>
                    </td>

                </tr>

            <?php endforeach; ?>

        </tbody>

    </table>

    	<?php endif;?>   

</body>

</html>