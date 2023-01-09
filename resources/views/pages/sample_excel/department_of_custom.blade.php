<table>
    <thead>
    <tr>

        <th>HSCode</th>
        <th>Item</th>
        <th>Description</th>
        <th>Asmt Date</th>
        <th>Customs</th>
        <th>Unit</th>
        <th>Quantity</th>
        <th>CIF_Value</th>
        <th>hs4</th>
        <th>ch</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i = 0; $i < 20; $i++) {
        echo '<tr>';
        echo '<td>2021-06-' . $i . '</td>';
        echo '<td>02023000</td>';
        echo '<td>Meat (All types Frozen boneless bovine meat)</td>';
        echo '<td>21/11/2021</td>';
        echo '<td>BIRGUNJ</td>';
        echo '<td>Kg</td>';
        echo '<td>28022</td>';
        echo '<td>1005512.5</td>';
        echo '<td>0202</td>';
        echo '<td>02</td>';
        echo '</tr>';
    }
    ?>
    </tbody>
</table>