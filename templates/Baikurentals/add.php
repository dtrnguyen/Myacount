<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Baikurental $baikurental
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Baikurentals'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="baikurentals form content">
            <?= $this->Form->create($baikurental) ?>
            <fieldset>
                <legend><?= __('Add Baikurental') ?></legend>
                <?php
                    echo $this->Form->control('sharyoID');
                    echo $this->Form->control('sharyomei');
                    echo $this->Form->control('keiyakusha');
                    echo $this->Form->control('jyushou');
                    echo $this->Form->control('denwabango');
                    echo $this->Form->control('kingaku');
                    echo $this->Form->control('keiyakuhi');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
