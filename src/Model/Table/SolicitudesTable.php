<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Solicitudes Model
 *
 * @property \App\Model\Table\ConvocatoriasTable|\Cake\ORM\Association\BelongsTo $Convocatorias
 * @property \App\Model\Table\SolicitudHasExclusionMotivosTable|\Cake\ORM\Association\HasMany $SolicitudHasExclusionMotivos
 * @property \App\Model\Table\SolicitudHasMeritosTable|\Cake\ORM\Association\HasMany $SolicitudHasMeritos
 * @property \App\Model\Table\SolicitudHasRequisitosTable|\Cake\ORM\Association\HasMany $SolicitudHasRequisitos
 *
 * @method \App\Model\Entity\Solicitude get($primaryKey, $options = [])
 * @method \App\Model\Entity\Solicitude newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Solicitude[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Solicitude|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Solicitude patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Solicitude[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Solicitude findOrCreate($search, callable $callback = null, $options = [])
 */
class SolicitudesTable extends Table
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

        $this->setTable('solicitudes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Convocatorias', [
            'foreignKey' => 'convocatoria_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Usuarios', [
            'foreignKey' => 'usuario_solicitante',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('SolicitudHasExclusionMotivos', [
            'foreignKey' => 'solicitude_id'
        ]);
        $this->hasMany('SolicitudHasMeritos', [
            'foreignKey' => 'solicitude_id'
        ]);
        $this->hasMany('SolicitudHasRequisitos', [
            'foreignKey' => 'solicitude_id'
        ]);
        $this->hasMany('Reclamaciones', [
            'foreignKey' => 'solicitude_id'
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
            ->integer('usuario_solicitante')
            ->requirePresence('usuario_solicitante', 'create')
            ->notEmpty('usuario_solicitante');

        $validator
            ->integer('usuario_evaluador')
            ->allowEmpty('usuario_evaluador');
        
        $validator
            ->scalar('estadoSolicitud')
            ->maxLength('estadoSolicitud', 20)
            ->allowEmpty('estadoSolicitud');        

        $validator
            ->decimal('autoPuntuacion')
            ->allowEmpty('autoPuntuacion');

        $validator
            ->boolean('reclamacion')
            ->allowEmpty('reclamacion');
        
        $validator
            ->boolean('reclamacionEvaluacion')
            ->allowEmpty('reclamacionEvaluacion');        
        
        $validator
            ->boolean('leido_declaracion_responsable')
            ->allowEmpty('leido_declaracion_responsable');
        
        $validator
            ->boolean('valido_evidencias_requisitos')
            ->allowEmpty('valido_evidencias_requisitos');
        
        $validator
            ->boolean('valido_evidencias_meritos')
            ->allowEmpty('valido_evidencias_meritos');
        
        $validator
            ->boolean('valido_evaluacion_requisitos ')
            ->allowEmpty('valido_evaluacion_requisitos ');

        $validator
            ->decimal('puntuacionEvaluacion')
            ->allowEmpty('puntuacionEvaluacion'); 
        
        $validator
            ->decimal('puntuacionConocimiento')
            ->allowEmpty('puntuacionConocimiento');
        
        $validator
            ->decimal('puntuacionPsicotecnico')
            ->allowEmpty('puntuacionPsicotecnico');
        
        $validator
            ->decimal('puntuacionEntrevista')
            ->allowEmpty('puntuacionEntrevista');        

        $validator
            ->boolean('aceptado')
            ->allowEmpty('aceptado');

        $validator
            ->date('fechaCreacion')
            ->allowEmpty('fechaCreacion');

        $validator
            ->date('fechaEvaluacion')
            ->allowEmpty('fechaEvaluacion');

        $validator
            ->date('fechaReclamacion')
            ->allowEmpty('fechaReclamacion');

        $validator
            ->date('fechaReclamacionEvaluacion')
            ->allowEmpty('fechaReclamacionEvaluacion');            
        
        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
        
        $rules->add($rules->existsIn(['convocatoria_id'], 'Convocatorias'));

        return $rules;
    }
}