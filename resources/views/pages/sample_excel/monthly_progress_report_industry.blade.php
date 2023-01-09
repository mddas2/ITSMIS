<table>
    <thead>
	    <tr>
	    	<th rowspan="2">User</th>
	    	@foreach($indicators as $indicator)
	    		<th colspan="2">{{$indicator}}</th>
	    	@endforeach
	    </tr>
	    <tr>
	    	@php $cnt = 0;@endphp
	    	@foreach($indicators as $indicator)
	    		<th>Number</th>
	    		<th>Progress</th>
	    		@php $cnt = $cnt+2; @endphp
	    	@endforeach
	    </tr>
	</thead>
	<tbody>
		<?php 
			for ($i=1; $i <= 10; $i++) { 
			echo '<tr>';
				echo '<td>Village Municipality 1</td>';
				for ($z=1; $z <= $cnt; $z++) { 
					echo '<td>'.($z + $cnt) * $i.'</td>';
            	}
        	echo '</tr>';
            }
		?>
	</tbody>
</table>
