<table>
    <thead>
    <tr>
        <th>Date</th>
        <th>Items</th>

        <th>Unit</th>

        <th>Stock Quantity</th>
        <th>Sales Quantity</th>

    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $i < 5; $i++) { ?>
    <tr>
        <th>2079-01-0{{$i}}</th>
        <th>Salt</th>

        <th>Kilogram</th>

        <th>200</th>
        <th>100</th>
    </tr>
    <?php } ?>

    </tbody>
</table>