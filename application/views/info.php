<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Contacts Information</title>

	<style type="text/css">

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	#container {
		margin: 10px;
		padding: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Contacts Information</h1>

	<div class="table-responsive">
		<table class="table table-striped">
			<tr>
				<?php foreach($table_fields as $field): ?>
					<th><?=ucfirst($field)?></th>
				<?php endforeach; ?>
			</tr>

			<?php $count = count($table_fields); 
				foreach($data as $item): ?>
				<tr>
				<?php foreach(array_keys((array) $item) as $key) : ?>
						<td>
							<?php if($key == "phone_number"):
								$new_val = preg_replace('/0/', '+27', $item->{$key}, 1);
								$values = sprintf("%s %s %s %s",
									substr($new_val, 0, 3),
									substr($new_val, 3, 2),
									substr($new_val, 5, 3),
									substr($new_val, 8));
								?>
									<?=$values?>
							<?php else:?>
									<?=$item->{$key} ?>
							<?php endif;?>
						</td>	
				<?php endforeach; ?>
				</tr> 
			<?php endforeach; ?>
		</table>
	</div>

</div>
</body>
</html>
