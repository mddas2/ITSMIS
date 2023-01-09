<table>
    <thead>
	    <tr>
	        <th>Date</th>
	        <th>Title</th>
	        <th>Amount</th>
	        <th>Price</th>
	        <th>Revenue</th>
	    </tr>
	</thead>
	<tbody>
		<?php 
			for ($i=0; $i < 10; $i++) { 
				echo '<tr>';
					echo '<td>2021-01-'.$i.'</td>';
					echo '<td>Title</td>';
					for ($z=1; $z <= 3; $z++) { 
						echo '<td>'.($z + 6) * $i.'</td>';
	            	}
	        	echo '</tr>';
            }
		?>
	</tbody>
</table>