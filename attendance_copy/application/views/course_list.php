<table>
	<thead>
		<tr>
			<th>Course Name</th>
		</tr>
	</thead>
	<tbody>

        <?php foreach($courses->result_array() as $course): ?>
		<tr>
			<td><?=$course['course_name'];?></td>
		</tr>
<?php endforeach; ?>

	</tbody>
</table>
