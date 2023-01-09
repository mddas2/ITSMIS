<table>
    <thead>
    <tr>
        <th>Date of Approval</th>
        <th>Name Of Industry</th>
        <th>Nationality Of Foreigner Investor</th>
        <th>Duraiton</th>
        <th>Currency</th>
        <th>Type Of TTA</th>

    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $i < 10; $i++) {
        echo '<tr>';
        echo '<td>2079-01-'.$i.'</td>';
        echo '<td>Water Factory</td>';
        echo '<td>Korean</td>';
        echo '<td>5 year</td>';
        echo '<td>USD</td>';
        echo '<td>yes</td>';
        echo '</tr>';
    }
    ?>
    </tbody>
</table>