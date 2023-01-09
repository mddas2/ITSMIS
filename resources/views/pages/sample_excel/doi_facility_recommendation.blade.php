<table>
    <thead>
    <tr>
        <th>Date of Registration</th>
        <th>Name Of Industry</th>
        <th>Type of Recommendation</th>


    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $i < 10; $i++) {
        echo '<tr>';
        echo '<td>2079-01-'.$i.'</td>';
        echo '<td>Water Factory</td>';
        echo '<td>Recommendation</td>';

    }
    ?>
    </tbody>
</table>