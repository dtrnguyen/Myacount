<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Baikurental[]|\Cake\Collection\CollectionInterface $baikurentals
 */
?>
<div class="baikurentals index content">
    <?= $this->Html->link(__('New Baikurental'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Baikurentals') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('sharyoID') ?></th>
                    <th><?= $this->Paginator->sort('sharyomei') ?></th>
                    <th><?= $this->Paginator->sort('keiyakusha') ?></th>
                    <th><?= $this->Paginator->sort('jyushou') ?></th>
                    <th><?= $this->Paginator->sort('denwabango') ?></th>
                    <th><?= $this->Paginator->sort('kingaku') ?></th>
                    <th><?= $this->Paginator->sort('keiyakuhi') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($baikurentals as $baikurental): ?>
                <tr>
                    <td><?= $this->Number->format($baikurental->id) ?></td>
                    <td><?= h($baikurental->sharyoID) ?></td>
                    <td><?= h($baikurental->sharyomei) ?></td>
                    <td><?= h($baikurental->keiyakusha) ?></td>
                    <td><?= h($baikurental->jyushou) ?></td>
                    <td><?= h($baikurental->denwabango) ?></td>
                    <td><?= $this->Number->format($baikurental->kingaku) ?></td>
                    <td><?= h($baikurental->keiyakuhi) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $baikurental->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $baikurental->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $baikurental->id], ['confirm' => __('Are you sure you want to delete # {0}?', $baikurental->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
