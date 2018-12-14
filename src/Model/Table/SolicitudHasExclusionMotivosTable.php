<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SolicitudHasExclusionMotivos Model
 *
 * @property \App\Model\Table\ExclusionMotivosTable|\Cake\ORM\Association\BelongsTo $ExclusionMotivos
 * @property \App\Model\Table\SolicitudesTable|\Cake\ORM\Association\BelongsTo $Solicitudes
 *
 * @method \App\Model\Entity\SolicitudHasExclusionMotivo get($primaryKey, $options = [])
 * @method \App\Model\Entity\SolicitudHasExclusionMotivo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SolicitudHasExclusionMotivo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SolicitudHasExclusionMotivo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SolicitudHasExclusionMotivo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SolicitudHasExclusionMotivo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SolicitudHasExclusionMotivo findOrCreate($search, callable $callback = null, $options = [])
 */
class SolicitudHasExclusionMotivosTable extends Table
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

        $this->setTable('solicitud_has_exclusion_motivos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('ExclusionMotivos', [
            'foreignKey' => 'exclusion_motivo_id',
            'joinType' => 'INNER'
        ]);
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
        $rules->add($rules->existsIn(['exclusion_motivo_id'], 'ExclusionMotivos'));
        $rules->add($rules->existsIn(['solicitude_id'], 'Solicitudes'));

        return $rules;
    }
}
