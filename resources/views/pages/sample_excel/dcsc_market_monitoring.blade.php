<table>
    <thead>
	    <tr>
	        <th>Date</th>
	        <th>No Of Monitored Firm</th>
	        <th>Type Of Firm</th>
	        <th>Action Taken</th>
	        <th>Monitored By</th>
	         <?php 
            	for ($i=10; $i < count($columns); $i++) { 
            		$column = ucfirst(str_replace('_'," ", $columns[$i]));
            		echo '<th>'.$column.'</th>';
            	}
            ?>
	    </tr>
	</thead>
	<tbody>
		<?php 
			// for ($i=0; $i < 10; $i++) { 
			// 	echo '<tr>';
			// 	echo '<td>2021-01-'.$i.'</td>';
			// 	echo '<td>'.($i * 2).'</td>';
			// 	echo '<td>Kirana , Pharmacy </td>';
			// 	echo '<td>Action Taken</td>';
			// 	echo '<td>DAO</td>';
	  //       	echo '</tr>';
   //          }
		?>
	</tbody>
</table>