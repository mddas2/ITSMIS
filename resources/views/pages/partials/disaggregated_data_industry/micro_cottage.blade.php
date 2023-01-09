<table class="table table-bordered table-hover table-checkable mt-10" id="kt_datatable">
    <thead>
        <tr>
            <th rowspan="2"></th>
            <th rowspan="2">Investment</th>
            <th colspan="2">Employment</th>
        </tr>
        <tr>
        	<th>Male</th>
        	<th>Female</th>

        </tr>
    </thead>
    <tbody id="tb_id">
    	<?php 
    		if (!$data->isEmpty()){
        		foreach($data as $key=>$row) :
		?>
        <tr>
            <td>
                <input type="hidden" name="data[{{$key}}][id]" value="{{$row->id}}">
                <input type="hidden" name="data[{{$key}}][entry_date]" value="{{$currentDate}}">
                <input type="hidden" name="data[{{$key}}][province]" value="{{$row->province}}">
                {{$row->province}}
            </td>
            <?php 
                $params = unserialize($row->param);
                $value = unserialize($row->value);
            ?>
            @foreach ($params as $cnt=>$param)
                 <td>
                    <input type="hidden" name="data[{{$key}}][param][$cnt]" value="{{$param[$cnt]}}">
                    <input type="text" name="data[{{$key}}][value][$cnt]" value="{{$value[$cnt]}}" autocomplete="off" class="form-control">
                </td>
            @endforeach
        </tr>
        <?php 
        	endforeach;
        } else { 
        	$provinces = ["Province 1","Province 2","Province 3","Province 4","Province 5","Province 6","Province 7"];
    		foreach ($provinces as $key=>$province):
    	?>
    	<tr>
    		<td>
    			<input type="hidden" name="data[{{$key}}][id]">
    			<input type="hidden" name="data[{{$key}}][entry_date]" value="{{$currentDate}}">
    			<input type="hidden" name="data[{{$key}}][province]" value="{{$province}}">
				{{$province}}
			</td>
			<td>
    			<input type="hidden" name="data[{{$key}}][param][0]" value="investment">
    			<input type="text" name="data[{{$key}}][value][0]" value="" autocomplete="off" class="form-control">
			</td>
			<td>
    			<input type="hidden" name="data[{{$key}}][param][1]" value="employment_male">
    			<input type="text" name="data[{{$key}}][value][1]" value="" autocomplete="off" class="form-control">
			</td>
			<td>
    			<input type="hidden" name="data[{{$key}}][param][2]" value="employement_female">
    			<input type="text" name="data[{{$key}}][value][2]" value="" autocomplete="off" class="form-control">
			</td>
    	</tr>
        <?php 
        	endforeach;
    		}
        ?>
    </tbody>
    <tfoot>
    	<tr>
    		<td colspan="3"></td>
    		<td>
    			<button class="btn btn-success btn-sm text-align-center" type="submit">
    				<i class="fa fa-plu icon-sm"></i>Save Changes
    			</button>
    		</td>
    	</tr>
    </tfoot>
</table>