<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Baikurental Entity
 *
 * @property int $id
 * @property string $sharyoID
 * @property string $sharyomei
 * @property string $keiyakusha
 * @property string $jyushou
 * @property string $denwabango
 * @property int $kingaku
 * @property \Cake\I18n\FrozenDate $keiyakuhi
 */
class Baikurental extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'sharyoID' => true,
        'sharyomei' => true,
        'keiyakusha' => true,
        'jyushou' => true,
        'denwabango' => true,
        'kingaku' => true,
        'keiyakuhi' => true,
    ];
}
