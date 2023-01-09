<table>
    <thead>
    <tr>
        <th>Date of Approval</th>
        <th>Name Of Industry</th>
        <th>Nationality Of Foreigner Investor</th>
        <th>Amount</th>
        <th>Currency</th>
        <th>Dividend</th>
        <th>Royalty</th>
        <th>Other</th>

    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $i < 10; $i++) {
        echo '<tr>';
        echo '<td>2079-01-'.$i.'</td>';
        echo '<td>Water Factory</td>';
        echo '<td>Korean</td>';
        echo '<td>1000000</td>';
        echo '<td>USD</td>';
        echo '<td>yes</td>';
        echo '<td>yes</td>';
        echo '<td>other</td>';
        echo '</tr>';
    }
    ?>
    </tbody>
</table>