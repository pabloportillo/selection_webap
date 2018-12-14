<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Acciones Model
 *
 * @property \App\Model\Table\PerfilAccionesTable|\Cake\ORM\Association\HasMany $PerfilAcciones
 *
 * @method \App\Model\Entity\Accione get($primaryKey, $options = [])
 * @method \App\Model\Entity\Accione newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Accione[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Accione|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Accione patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Accione[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Accione findOrCreate($search, callable $callback = null, $options = [])
 */
class AccionesTable extends Table
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

        $this->setTable('acciones');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->hasMany('PerfilAcciones', [
            'foreignKey' => 'accione_id'
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
            ->scalar('metodo')
            ->maxLength('metodo', 20)
            ->requirePresence('metodo', 'create')
            ->notEmpty('metodo');

        $validator
            ->scalar('controlador')
            ->maxLength('controlador', 20)
            ->requirePresence('controlador', 'create')
            ->notEmpty('controlador');

        $validator
            ->scalar('descripcion')
            ->maxLength('descripcion', 200)
            ->requirePresence('descripcion', 'create')
            ->notEmpty('descripcion');

        return $validator;
    }
}
