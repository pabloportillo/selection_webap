<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Usuarioperfilempresas Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $Usuarios
 * @property |\Cake\ORM\Association\BelongsTo $Perfiles
 * @property |\Cake\ORM\Association\BelongsTo $Empresas
 *
 * @method \App\Model\Entity\Usuarioperfilempresa get($primaryKey, $options = [])
 * @method \App\Model\Entity\Usuarioperfilempresa newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Usuarioperfilempresa[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Usuarioperfilempresa|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Usuarioperfilempresa patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Usuarioperfilempresa[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Usuarioperfilempresa findOrCreate($search, callable $callback = null, $options = [])
 */
class UsuarioperfilempresasTable extends Table
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

        $this->setTable('usuarioperfilempresas');
        $this->setDisplayField('Usuario_id');
        $this->setPrimaryKey(['Usuario_id', 'Perfile_id', 'Empresa_id']);

        $this->belongsTo('Usuarios', [
            'foreignKey' => 'Usuario_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Perfiles', [
            'foreignKey' => 'Perfile_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Empresas', [
            'foreignKey' => 'Empresa_id',
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
        $rules->add($rules->existsIn(['Usuario_id'], 'Usuarios'));
        $rules->add($rules->existsIn(['Perfile_id'], 'Perfiles'));
        $rules->add($rules->existsIn(['Empresa_id'], 'Empresas'));

        return $rules;
    }
}
