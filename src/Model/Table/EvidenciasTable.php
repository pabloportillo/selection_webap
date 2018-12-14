<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Evidencias Model
 *
 * @property \App\Model\Table\SolicitudHasRequisitosTable|\Cake\ORM\Association\BelongsTo $SolicitudHasRequisitos
 * @property \App\Model\Table\SolicitudHasMeritosTable|\Cake\ORM\Association\BelongsTo $SolicitudHasMeritos
 * @property |\Cake\ORM\Association\BelongsTo $Reclamaciones
 *
 * @method \App\Model\Entity\Evidencia get($primaryKey, $options = [])
 * @method \App\Model\Entity\Evidencia newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Evidencia[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Evidencia|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Evidencia patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Evidencia[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Evidencia findOrCreate($search, callable $callback = null, $options = [])
 */
class EvidenciasTable extends Table
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

        $this->setTable('evidencias');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('SolicitudHasRequisitos', [
            'foreignKey' => 'solicitud_has_requisitos_id'
        ]);
        $this->belongsTo('SolicitudHasMeritos', [
            'foreignKey' => 'solicitud_has_meritos_id'
        ]);
        $this->belongsTo('Reclamaciones', [
            'foreignKey' => 'reclamacion_id'
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
            ->allowEmpty('evidencia');

        $validator
            ->scalar('descripcionEvidencia')
            ->maxLength('descripcionEvidencia', 100)
            ->allowEmpty('descripcionEvidencia');

        $validator
            ->scalar('nombre_archivo')
            ->maxLength('nombre_archivo', 45)
            ->allowEmpty('nombre_archivo');

        $validator
            ->scalar('extension')
            ->maxLength('extension', 5)
            ->allowEmpty('extension');

        $validator
            ->scalar('tamanho')
            ->maxLength('tamanho', 45)
            ->allowEmpty('tamanho');

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
        $rules->add($rules->existsIn(['solicitud_has_requisitos_id'], 'SolicitudHasRequisitos'));
        $rules->add($rules->existsIn(['solicitud_has_meritos_id'], 'SolicitudHasMeritos'));
        $rules->add($rules->existsIn(['reclamacion_id'], 'Reclamaciones'));

        return $rules;
    }
        
}