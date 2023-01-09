<table>
    <thead>
    <tr>
        <th>Date</th>
        <th>Items</th>
        <th>Unit</th>
        <th>Quantity</th>



    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $i < 5; $i++) { ?>
    <tr>
        <th>2079-01-0{{$i}}</th>
        <th>Apple</th>

        <th>Kilogram</th>
        <th>5</th>


    </tr>


    <?php } ?>
    </tbody>
</table>