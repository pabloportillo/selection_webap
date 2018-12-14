<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Empresas Model
 *
 * @method \App\Model\Entity\Empresa get($primaryKey, $options = [])
 * @method \App\Model\Entity\Empresa newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Empresa[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Empresa|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Empresa patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Empresa[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Empresa findOrCreate($search, callable $callback = null, $options = [])
 */
class EmpresasTable extends Table
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

        $this->setTable('empresas');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
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
            ->scalar('CIF')
            ->requirePresence('CIF', 'create')
            ->notEmpty('CIF')
            ->add('CIF', 'unique', ['rule' => 'validateUnique', 'provider' => 'table', 'message' => 'CIF ya existente en la base de datos'])
			->add('CIF', [
				'lengthbetween' => [
					'rule' => ['lengthbetween', 9, 9],
					'last' => true, // Si quieres parar la ejecución cuando esta condición falla ponemos el last true.
					'message' => 'El CIF debe de estar compuesto por 9 caracteres.'
				],
				'numeric' => [
					'rule' => ['alphaNumeric'],
					'message' => 'alphanumeric'
				],
				'isValidCIF' => [
					'rule' => 'isValidCIF',
					'message' => 'Formato de CIF no valido',
					'provider' => 'table' // PROVIDER TABLE para que pille el script de esta misma página. si no, no lo pilla.
				 ]
			]);
					
        $validator
            ->scalar('NombreEmpresa')
            ->maxLength('NombreEmpresa', 200)
            ->requirePresence('NombreEmpresa', 'create')
            ->notEmpty('NombreEmpresa')
            ->add('NombreEmpresa', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('NombreContacto')
            ->maxLength('NombreContacto', 60)
            ->allowEmpty('NombreContacto');

        $validator
            ->scalar('ApellidoContacto')
            ->maxLength('ApellidoContacto', 200)
            ->allowEmpty('ApellidoContacto');

		$validator
            ->scalar('TelefonoContacto')
            ->requirePresence('TelefonoContacto', 'create')
            ->notEmpty('TelefonoContacto')
			// PORTILLO: añadido regla para validar telefono.
			->add('TelefonoContacto', [
				'lengthbetween' => [
					'rule' => ['lengthbetween', 9, 12],
					'last' => true, // Si quieres parar la ejecución cuando esta condición falla ponemos el last true.
					'message' => 'Introduce al menos 9 dígitos numéricos.'
				],
				'numeric' => [
					'rule' => ['numeric'],
					'message' => 'Introduce al menos 9 dígitos numéricos.'
				]
			]);

        $validator
            ->scalar('DeclaracionResponsable')
            ->maxLength('DeclaracionResponsable', 100)
            ->allowEmpty('DeclaracionResponsable');

        return $validator;
    }


/*
* PORTILLO:
*
* Funciones para validar el CIF. 
* Tener en cuenta, que al llamar a otras funciones tienes que poner delante de la llamada $this->
*
* Sacada de aqui:
* https://github.com/amnesty/drupal-nif-nie-cif-validator/blob/master/includes/nif-nie-cif.php
*/
	
	public function isValidCIF( $docNumber ) {
        $isValid = FALSE;
        $fixedDocNumber = "";
        $correctDigit = "";
        $writtenDigit = "";
        $fixedDocNumber = strtoupper( $docNumber );
        $writtenDigit = substr( $fixedDocNumber, -1, 1 );
		
        if( $this->isValidCIFFormat( $fixedDocNumber ) == 1 ) {
            $correctDigit = $this->getCIFCheckDigit( $fixedDocNumber );
            if( $writtenDigit == $correctDigit ) {
                $isValid = TRUE;
            }
        }
				
        return $isValid;
    }
	
	public function isValidCIFFormat( $docNumber ) {
			return
				$this->respectsDocPattern(
					$docNumber,
					'/^[PQSNWR][0-9][0-9][0-9][0-9][0-9][0-9][0-9][A-Z0-9]/' )
			or
				$this->respectsDocPattern(
					$docNumber,
					'/^[ABCDEFGHJUV][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]/' );
		}
	
	public function getCIFCheckDigit( $docNumber ) {
        $fixedDocNumber = "";
        $centralChars = "";
        $firstChar = "";
        $evenSum = 0;
        $oddSum = 0;
        $totalSum = 0;
        $lastDigitTotalSum = 0;
        $correctDigit = "";
        $fixedDocNumber = strtoupper( $docNumber );
        if( $this->isValidCIFFormat( $fixedDocNumber ) ) {
            $firstChar = substr( $fixedDocNumber, 0, 1 );
            $centralChars = substr( $fixedDocNumber, 1, 7 );
            $evenSum =
                substr( $centralChars, 1, 1 ) +
                substr( $centralChars, 3, 1 ) +
                substr( $centralChars, 5, 1 );
            $oddSum =
                $this->sumDigits( substr( $centralChars, 0, 1 ) * 2 ) +
                $this->sumDigits( substr( $centralChars, 2, 1 ) * 2 ) +
                $this->sumDigits( substr( $centralChars, 4, 1 ) * 2 ) +
                $this->sumDigits( substr( $centralChars, 6, 1 ) * 2 );
            $totalSum = $evenSum + $oddSum;
            $lastDigitTotalSum = substr( $totalSum, -1 );
            if( $lastDigitTotalSum > 0 ) {
                $correctDigit = 10 - ( $lastDigitTotalSum % 10 );
            } else {
                $correctDigit = 0;
            }
        }
        // If CIF number starts with P, Q, S, N, W or R, check digit sould be a letter  
        if( preg_match( '/[PQSNWR]/', $firstChar ) ) {
            $correctDigit = substr( "JABCDEFGHI", $correctDigit, 1 );
        }
        return $correctDigit;
    }
	
	public function respectsDocPattern( $givenString, $pattern ) {
        $isValid = FALSE;
        $fixedString = strtoupper( $givenString );
        if( is_int( substr( $fixedString, 0, 1 ) ) ) {
            $fixedString = substr( "000000000" . $givenString , -9 );
        }
        if( preg_match( $pattern, $fixedString ) ) {
            $isValid = TRUE;
        }
        return $isValid;
    }
	
	public function sumDigits( $digits ) {
        $total = 0;
        $i = 1;
        while( $i <= strlen( $digits ) ) {
            $thisNumber = substr( $digits, $i - 1, 1 );
            $total += $thisNumber;
            $i++;
        }
        return $total;
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
        $rules->add($rules->isUnique(['CIF']));
        $rules->add($rules->isUnique(['NombreEmpresa']));

        return $rules;
    }
}
