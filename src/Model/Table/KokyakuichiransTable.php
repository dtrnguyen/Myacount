<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Kokyakuichirans Model
 *
 * @method \App\Model\Entity\Kokyakuichiran newEmptyEntity()
 * @method \App\Model\Entity\Kokyakuichiran newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Kokyakuichiran[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Kokyakuichiran get($primaryKey, $options = [])
 * @method \App\Model\Entity\Kokyakuichiran findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Kokyakuichiran patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Kokyakuichiran[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Kokyakuichiran|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Kokyakuichiran saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Kokyakuichiran[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Kokyakuichiran[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Kokyakuichiran[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Kokyakuichiran[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class KokyakuichiransTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('kokyakuichirans');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('shouhinID')
            ->maxLength('shouhinID', 225)
            ->requirePresence('shouhinID','create','商品IDと会社名を必ず入力してください')
            ->notEmptyString('shouhinID','商品IDが必要です。');

        $validator
            ->scalar('companyname')
            // ->maxLength('companyname', 225)
            //->requirePresence('companyname','create','会社名が必要です。')
            ->notEmptyString('companyname','会社名が必要です。');

        $validator
            ->scalar('companytel')
            // ->maxLength('companytel', 225)
            // ->requirePresence('companytel')
            ->notEmptyString('companytel','電話番号がありません。');

        $validator
            ->scalar('companyaddress')
            // ->maxLength('companyaddress', 225)
            // ->requirePresence('companyaddress')
            ->notEmptyString('companyaddress','住所がありません。');

        $validator
            ->scalar('tenponame')
            // ->maxLength('tenponame', 225)
            // ->requirePresence('tenponame')
            ->allowEmptyString('tenponame');

        $validator
            ->scalar('tenpotel')
            // ->maxLength('tenpotel', 225)
            // ->requirePresence('tenpotel')
            ->allowEmptyString('tenpotel');

        $validator
            ->scalar('tenpoaddress')
            ->maxLength('tenpoaddress', 225)
            ->requirePresence('tenpoaddress')
            ->allowEmptyString('tenpoaddress');

        return $validator;
    }
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['shouhinID'],'重複する商品IDです。'));
        return $rules;
    }
}
