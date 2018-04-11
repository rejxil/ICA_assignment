<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>Surname</th>
			<th>Email</th>
			<th>Mobile No.</th>
			<th>Course</th>
			<th>Edit</th>
		</tr>
	</thead>
	<tbody>

        <?php foreach($users->result_array() as $user): ?>
		<tr>
			<td><?=$user['name'];?></td>
			<td><?=$user['surname'];?></td>
			<td><?=$user['id_number'];?></td>
			<td><?=$user['email'];?></td>
			<td><?=$user['course_name'];?></td>
			<td><?=anchor("welcome/edit/{$user['id']}", "Edit");?></td>

		</tr>
<?php endforeach; ?>

	</tbody>
</table>
