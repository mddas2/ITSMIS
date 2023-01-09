<table>
    <thead>
	    <tr>
	        <th>Date</th>
	        <th>No Of Registered Firm</th>
	        <th>Type Of Registered Firm</th>
	        <th>No Of Firm Renewal</th>
	        <th>Type Of Film</th>
	        <th>Firm Cancellation</th>
	        <th>Revenue Raised</th>
	        <?php 
            	for ($i=12; $i < count($columns); $i++) { 
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
			// 	echo '<td>Private , Agency </td>';
			// 	echo '<td>'.($i * 2).'</td>';
			// 	echo '<td>Private , Agency </td>';
			// 	echo '<td>'.($i * 2).'</td>';
			// 	echo '<td>'.($i * 3).'</td>';
	  //       	echo '</tr>';
   //          }
		?>
	</tbody>
</table>