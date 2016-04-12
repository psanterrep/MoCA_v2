<table class="table table-striped">
    <tr>
        <th><?= Lang::get('commons.name') ?></th>
        <th><?= Lang::get('tests.version') ?></th>
        <th><?= Lang::get('commons.result') ?></th>
    </tr>  
    <tr>
        <td><?= $test->name ?></td>
        <td><?= $consultation->type->name ?></td>
        <td><?= $consultation->date; ?></td>
        <td>
        <?php foreach ($consultation->tests()->get() as $test): ?>
        <?php if (is_null($test->result)): ?>
        <button class="btn btn-primary" onclick="takeTest(<?= $consultation->id ?>,<?= $test->id ?>);" ><?= Lang::get('tests.start') ?> <?= $test->name ?></button>
        <?php else: ?>
        <?= Lang::get('tests.passed') ?>
        <?php endif ?>
        <?php endforeach ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>