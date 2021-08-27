<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Butsuryucenter Entity
 *
 * @property int $id
 * @property string $shouhinID
 * @property string $companyname
 * @property string $companytel
 * @property string $companyaddress
 * @property string $tenponame
 * @property string $tenpotel
 * @property string $tenpoaddress
 * @property string $shohinmei
 * @property string $shurui
 * @property string $kakaku
 * @property string $unchintoraku
 * @property string $tantosha
 * @property \Cake\I18n\FrozenDate $nyukoubi
 * @property \Cake\I18n\FrozenDate $shukoubi
 */
class Butsuryucenter extends Entity
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
        'shouhinID' => true,
        'companyname' => true,
        'companytel' => true,
        'companyaddress' => true,
        'tenponame' => true,
        'tenpotel' => true,
        'tenpoaddress' => true,
        'shohinmei' => true,
        'shurui' => true,
        'kakaku' => true,
        'unchintoraku' => true,
        'tantosha' => true,
        'nyukoubi' => true,
        'shukoubi' => true,
    ];
}
