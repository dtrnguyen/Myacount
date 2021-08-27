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
            <?= $this->Html->link(__('Edit Baikurental'), ['action' => 'edit', $baikurental->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Baikurental'), ['action' => 'delete', $baikurental->id], ['confirm' => __('Are you sure you want to delete # {0}?', $baikurental->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Baikurentals'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Baikurental'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="baikurentals view content">
            <h3><?= h($baikurental->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('SharyoID') ?></th>
                    <td><?= h($baikurental->sharyoID) ?></td>
                </tr>
                <tr>
                    <th><?= __('Sharyomei') ?></th>
                    <td><?= h($baikurental->sharyomei) ?></td>
                </tr>
                <tr>
                    <th><?= __('Keiyakusha') ?></th>
                    <td><?= h($baikurental->keiyakusha) ?></td>
                </tr>
                <tr>
                    <th><?= __('Jyushou') ?></th>
                    <td><?= h($baikurental->jyushou) ?></td>
                </tr>
                <tr>
                    <th><?= __('Denwabango') ?></th>
                    <td><?= h($baikurental->denwabango) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($baikurental->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Kingaku') ?></th>
                    <td><?= $this->Number->format($baikurental->kingaku) ?></td>
                </tr>
                <tr>
                    <th><?= __('Keiyakuhi') ?></th>
                    <td><?= h($baikurental->keiyakuhi) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
