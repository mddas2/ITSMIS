<table>
    <thead>
	    <tr>
	        <th rowspan="2" style="min-width: 160px !important;">Products</th>
	        <th rowspan="2" style="min-width: 160px !important;">Users</th>
	        <th>A</th>
	        <th>B</th>
	        <th>C</th>
	        <th>D</th>
	        <th>E</th>
	        <th>F</th>
	        <th rowspan="2">Remarks</th>
	    </tr>
	    <tr>
	    	<th>Opening Stock</th>
	    	<th>Productive</th>
	    	<th>Import</th>
	    	<th>Export</th>
	    	<th>Consumption</th>
	    	<th>Closing Stock</th>
	    </tr>
	</thead>
	<tbody>
		<?php 
			for ($i=0; $i < 10; $i++) { 
			echo '<tr>';
				echo '<td>'.$items[$i].'</td>';
				echo '<td>Village Municipality 1</td>';
				for ($z=1; $z <= 6; $z++) { 
					echo '<td>'.($z + 6) * $i.'</td>';
            	}
            	echo '<td>Remarks</td>';
        	echo '</tr>';
            }
		?>
	</tbody>
</table>