<div class="users form">
<?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('View User') ?></legend>
        <?= $this->Form->input('username', ['value' => $user->username]) ?>
        <?= $this->Form->input('password') ?>
        <?= $this->Form->input('role', [
            'value' => $user->role,
            'options' => ['admin' => 'Admin', 'author' => 'Author']
        ]) ?>
   </fieldset>
<?= $this->Form->end() ?>
</div>