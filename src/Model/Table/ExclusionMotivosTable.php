<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ExclusionMotivos Model
 *
 * @property \App\Model\Table\ConvocatoriasTable|\Cake\ORM\Association\BelongsTo $Convocatorias
 * @property \App\Model\Table\SolicitudHasExclusionMotivosTable|\Cake\ORM\Association\HasMany $SolicitudHasExclusionMotivos
 *
 * @method \App\Model\Entity\ExclusionMotivo get($primaryKey, $options = [])
 * @method \App\Model\Entity\ExclusionMotivo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ExclusionMotivo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ExclusionMotivo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ExclusionMotivo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ExclusionMotivo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ExclusionMotivo findOrCreate($search, callable $callback = null, $options = [])
 */
class ExclusionMotivosTable extends Table
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

        $this->setTable('exclusion_motivos');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Convocatorias', [
            'foreignKey' => 'convocatoria_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('SolicitudHasExclusionMotivos', [
            'foreignKey' => 'exclusion_motivo_id'
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
            ->maxLength('descripcion', 45)
            ->allowEmpty('descripcion');

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
        $rules->add($rules->existsIn(['convocatoria_id'], 'Convocatorias'));

        return $rules;
    }
}
