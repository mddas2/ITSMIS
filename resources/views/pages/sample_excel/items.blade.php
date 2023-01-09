<table>
    <thead>
    <tr>

        <th>Commodit</th>

    </tr>
    </thead>
    <tbody>
    <?php
    foreach($items as  $item) {
        echo '<tr>';

        echo '<td>' . $item . '</td>';

        echo '</tr>';
    }
    ?>
    </tbody>
</table>