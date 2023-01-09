<table>
    <thead>
    <tr>
        <th>Date of Approval</th>
        <th>Name Of Investor</th>
        <th>Nationality Of Investor</th>
        <th>Location</th>
        <th>Category</th>
        <th>Production Capacity</th>
        <th>Fixed</th>
        <th>Working</th>
        <th>Male</th>
        <th>Female</th>
        <th>Local</th>
        <th>Foreign</th>
    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $i < 10; $i++) {
        echo '<tr>';
        echo '<td>2079-01-'.$i.'</td>';
        echo '<td>RAm Babu</td>';
        echo '<td>Nepali</td>';
        echo '<td>Baneshwor</td>';
        echo '<td>Metal</td>';
        echo '<td>1000</td>';
        echo '<td>Fixed</td>';
        echo '<td>Working</td>';
        echo '<td>500</td>';
        echo '<td>300</td>';
        echo '<td>20</td>';
        echo '<td>5</td>';
        echo '</tr>';
    }
    ?>
    </tbody>
</table>