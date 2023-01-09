<table>
    <thead>
    <tr>
        <th>Date</th>
        <th>Produced Product</th>
        <th>Produced Category</th>
        <th>Quantity</th>
        <th>Unit</th>
        <th>Produced By</th>

    </tr>
    </thead>
    <tbody>
    <?php
    for ($i=0; $i < 5; $i++) { ?>
    <tr>
        <th>2021-01-0{{$i}}</th>
        <th>Apple</th>
        <th>Agricultural</th>
        <th>58</th>
        <th>Kilogram</th>
        <th>Thakali Samaj</th>
    </tr>
    <?php
    } ?>

    </tbody>
</table>