<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Baikurentals Model
 *
 * @method \App\Model\Entity\Baikurental newEmptyEntity()
 * @method \App\Model\Entity\Baikurental newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Baikurental[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Baikurental get($primaryKey, $options = [])
 * @method \App\Model\Entity\Baikurental findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Baikurental patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Baikurental[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Baikurental|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Baikurental saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Baikurental[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Baikurental[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Baikurental[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Baikurental[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class BaikurentalsTable extends Table
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

        $this->setTable('baikurentals');
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
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('sharyoID')
            ->maxLength('sharyoID', 50)
            ->requirePresence('sharyoID', 'create')
            ->notEmptyString('sharyoID');

        $validator
            ->scalar('sharyomei')
            ->maxLength('sharyomei', 225)
            ->requirePresence('sharyomei', 'create')
            ->notEmptyString('sharyomei');

        $validator
            ->scalar('keiyakusha')
            ->maxLength('keiyakusha', 50)
            ->requirePresence('keiyakusha', 'create')
            ->notEmptyString('keiyakusha');

        $validator
            ->scalar('jyushou')
            ->maxLength('jyushou', 225)
            ->requirePresence('jyushou', 'create')
            ->notEmptyString('jyushou');

        $validator
            ->scalar('denwabango')
            ->maxLength('denwabango', 20)
            ->requirePresence('denwabango', 'create')
            ->notEmptyString('denwabango');

        $validator
            ->integer('kingaku')
            ->requirePresence('kingaku', 'create')
            ->notEmptyString('kingaku');

        $validator
            ->date('keiyakuhi')
            ->requirePresence('keiyakuhi', 'create')
            ->notEmptyDate('keiyakuhi');

        return $validator;
    }
}
