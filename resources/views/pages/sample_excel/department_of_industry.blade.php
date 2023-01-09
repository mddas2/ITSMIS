<table>
    <thead>
	    <tr>
			<th>Date of Registration</th>
			<th>Name Of Industry</th>
			<th>Location</th>
			<th>Category</th>
			<th>Production Capacity</th>
			<th>Capacity Utilization</th>
			<th>Private Firm</th>
			<th>Proprietorship</th>
			<th>Company</th>
			<th>Fixed</th>
			<th>Working</th>
			<th>Male</th>
			<th>Female</th>
	    </tr>
	</thead>
	<tbody>
		<?php 
			for ($i=0; $i < 10; $i++) { 
				echo '<tr>';
				echo '<td>2079-01-'.$i.'</td>';
				echo '<td>Metal Industry</td>';
				echo '<td>Koteshwor </td>';
				echo '<td>Metal</td>';
				echo '<td>10000</td>';
				echo '<td>500</td>';
				echo '<td>Private</td>';
				echo '<td>Proprietorship</td>';
				echo '<td>Company</td>';
				echo '<td>Fixed</td>';
				echo '<td>Working</td>';
				echo '<td>500</td>';
				echo '<td>300</td>';
	        	echo '</tr>';
            }
		?>
	</tbody>
</table>