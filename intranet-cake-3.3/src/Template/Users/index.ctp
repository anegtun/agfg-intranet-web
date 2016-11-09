<table>
<?php foreach ($users as $user): ?>
    <tr>
        <td><?= $user->username ?></td>
        <td><?= $user->name ?></td>
        <td><?= $user->role ?></td>
        <td><?= $user->created ?></td>
        <td><?= $user->modified ?></td>
        <td class="actions">
            <?= $this->Html->link(__('Edit'), ['action' => 'view', $user->id]) ?>
            <?php //$this->Form->postLink(__('Delete'), ['action' => 'delete', $application->id], ['confirm' => __('Are you sure you want to delete # {0}?', $application->id)]) ?>
        </td>
    </tr>
<?php endforeach ?>
</table>