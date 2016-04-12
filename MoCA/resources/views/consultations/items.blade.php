<table class="table table-striped">
<tr>
    <th><?= Lang::get('consultations.patient_name') ?></th>
    <th><?= Lang::get('commons.type') ?></th>
    <th><?= Lang::get('commons.date') ?></th>
    <th><?= Lang::get('consultations.comment') ?></th>
    <th class="text-center"><?= Lang::get('commons.result') ?></th>
    <th class="text-center"><?= Lang::get('commons.edit') ?></th>
    <th class="text-center"><?= Lang::get('commons.cancel') ?></th>
</tr>  
<?php foreach($consultations as $consultation): ?>
  <tr>
      <td><?= isset($consultation->patients()->get()->first()->profile->username) ? $consultation->patients()->get()->first()->profile->username : ""; ?></td>
      <td><?= $consultation->type->name ?></td>
      <td><?= $consultation->date; ?></td>
      <td><?= isset($consultation->comment) ? $consultation->comment : ""; ?></td>
      <td class="text-center">
        <?php if($consultation->hasResult()):?>
            <a href="/consultation/showresults/<?= $consultation->id ?>" ><?= Lang::get('commons.view') ?></a>
        <?php endif; ?>
      </td>
      <td class="text-center">
          <a class="text-orange" href="/consultation/edit/<?= $consultation->id ?>">
              <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
          </a>
      </td>
      <td class="text-center">
          <a class="text-red" href="/consultation/cancel/<?= $consultation->id ?>">
              <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
          </a>
      </td>
  </tr>
<?php endforeach; ?>
</table>