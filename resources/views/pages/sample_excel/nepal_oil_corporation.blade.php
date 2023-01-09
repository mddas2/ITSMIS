<table>
    <thead>
    <tr>
        <th>Date</th>
        <th>Item(Product Description)</th>
        <th>Import Quantity</th>
        <th>Unit</th>
        <th>Import Cost (Per Unit)</th>
        <th>Stock Date</th>
        <th>Stock Quantity (In Liters)</th>
        <th>Sales Quantity</th>

    </tr>
    </thead>
    <tbody>
    <?php
            $count = 0;
    foreach ($items as  $item){
        echo '<tr>';
        echo '<td>2021-01-'.$count.'</td>';
        echo '<td>'. $item .'</td>';
        echo '<td>6000</td>';
        echo '<td>Liter</td>';
        echo '<td>8920000</td>';
        echo '<td>2020-01-'.$count.'</td>';
        echo '<td>6000</td>';
        echo '<td>4000</td>';
        echo '</tr>';
        $count++;
    }
    ?>
    </tbody>
</table>