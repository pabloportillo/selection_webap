<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Reclamaciones Model
 *
 * @property \App\Model\Table\SolicitudesTable|\Cake\ORM\Association\BelongsTo $Solicitudes
 *
 * @method \App\Model\Entity\Reclamacione get($primaryKey, $options = [])
 * @method \App\Model\Entity\Reclamacione newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Reclamacione[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Reclamacione|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Reclamacione patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Reclamacione[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Reclamacione findOrCreate($search, callable $callback = null, $options = [])
 */
class ReclamacionesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('reclamaciones');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Solicitudes', [
            'foreignKey' => 'solicitude_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->scalar('descripcion')
            //->maxLength('descripcion', 3550)
            ->allowEmpty('descripcion');

        $validator
            ->scalar('tipo')
            ->maxLength('tipo', 45)
            ->allowEmpty('tipo');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['solicitude_id'], 'Solicitudes'));

        return $rules;
    }
}
