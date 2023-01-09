<table>
    <thead>
	    <tr>
	        <th>Date</th>
	        <th>No Of Registered Company</th>
	        <th>Type Of Company</th>
	        <th>Revenue Raised</th>
	    </tr>
	</thead>
	<tbody>
		<?php 
			for ($i=0; $i < 10; $i++) { 
				echo '<tr>';
				echo '<td>2021-01-'.$i.'</td>';
				echo '<td>'.($i * 2).'</td>';
				echo '<td>Kirana , Pharmacy </td>';
				echo '<td>'.($i * 2).'</td>';
	        	echo '</tr>';
            }
		?>
	</tbody>
</table>