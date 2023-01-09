<table>
    <thead>
    <tr>
        <th>Date</th>
        <th>Program</th>
        <th>Programe in Nepali</th>
        <th>Training Type</th>
        <th>Male</th>
        <th>Female</th>
        <th>Age</th>
        <th>Budget Spend Per Unit	</th>
    </tr>
    </thead>
    <tbody>
    <?php
            $count = 1;
    foreach ($trainingTypes as $training) { ?>
    <tr>
        <th>2021-01-0{{$count}}</th>
        <th>Program</th>
        <th>Program</th>
        <th>{{$training}}</th>
        <th>58</th>
        <th>25</th>
        <th>25 - 45</th>
        <th>400</th>

    </tr>
    <?php $count++;
     } ?>

    </tbody>
</table>