<table class="table table-striped">
<tr>
    <th>Patient Name</th>
    <th>Type</th>
    <th>Date</th>
    <th>Comment</th>
    <th class="text-center">Edit</th>
    <th class="text-center">Cancel</th>
</tr>  
<?php foreach($consultations as $consultation): ?>
  <tr>
      <td><?= isset($consultation->patients()->get()->first()->profile->username) ? $consultation->patients()->get()->first()->profile->username : ""; ?></td>
      <td><?= $consultation->type->name ?></td>
      <td><?= $consultation->date; ?></td>
      <td><?= isset($consultation->comment) ? $consultation->comment : ""; ?></td>
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