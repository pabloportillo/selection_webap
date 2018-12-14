<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PerfilAcciones Model
 *
 * @property \App\Model\Table\PerfilesTable|\Cake\ORM\Association\BelongsTo $Perfiles
 * @property \App\Model\Table\AccionesTable|\Cake\ORM\Association\BelongsTo $Acciones
 *
 * @method \App\Model\Entity\PerfilAccione get($primaryKey, $options = [])
 * @method \App\Model\Entity\PerfilAccione newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PerfilAccione[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PerfilAccione|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PerfilAccione patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PerfilAccione[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PerfilAccione findOrCreate($search, callable $callback = null, $options = [])
 */
class PerfilAccionesTable extends Table
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

        $this->setTable('perfil_acciones');

        $this->belongsTo('Perfiles', [
            'foreignKey' => 'perfile_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Acciones', [
            'foreignKey' => 'accione_id',
            'joinType' => 'INNER'
        ]);
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
        $rules->add($rules->existsIn(['perfile_id'], 'Perfiles'));
        $rules->add($rules->existsIn(['accione_id'], 'Acciones'));

        return $rules;
    }
}
