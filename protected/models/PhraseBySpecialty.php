<?php

/**
 * This is the model class for table "phrase_by_specialty".
 *
 * The followings are the available columns in table 'phrase_by_specialty':
 * @property string $id
 * @property string $name
 * @property string $phrase
 * @property string $section_id
 * @property string $display_order
 * @property string $specialty_id
 *
 * The followings are the available model relations:
 * @property Specialty $specialty
 * @property Section $section
 */
class PhraseBySpecialty extends BaseActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return PhraseBySpecialty the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'phrase_by_specialty';
	}

	public function relevantSectionTypes()
	{
		return array('Letter', 'Exam');
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('section_id, display_order, specialty_id, phrase_name_id', 'length', 'max'=>10),
			array('phrase, section_id, specialty_id', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, phrase, section_id, display_order, specialty_id', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'specialty' => array(self::BELONGS_TO, 'Specialty', 'specialty_id'),
			'section' => array(self::BELONGS_TO, 'Section', 'section_id'),
			'name' => array(self::BELONGS_TO, 'PhraseName', 'phrase_name_id')
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'phrase' => 'Phrase',
			'section_id' => 'Section',
			'display_order' => 'Display Order',
			'specialty_id' => 'Specialty',
			'phrase_name_id' => 'Name',
		);
	}

	/**
	* @param string the name of the attribute to be validated
	* @param array options specified in the validation rule
	*/

	public function ValidatorPhraseNameId($attribute,$params)
	{
		// this phrase name id must not exist at this level (not select * from phrase_by_firm where section_id=x and firm_id=y)
		if (PhraseBySpecialty::model()->findByAttributes(array('section_id' => $this->section_id, 'specialty_id' => $this->specialty_id, 'phrase_name_id' => $this->phrase_name_id))) {
			if (!$this->id) {
				$this->addError($attribute,'That phrase name has already been overridden for this section (' . $this->section_id . ') and specialty (' . $this->specialty_id . ')');
			}
		}
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('phrase',$this->phrase,true);
		$criteria->compare('section_id',$this->section_id,true);
		$criteria->compare('display_order',$this->display_order,true);
		$criteria->compare('specialty_id',$this->specialty_id,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Retrieves a list of phrase_name models that can be overridden by a user
	 */
	public function getOverrideableNames($sectionId, $specialtyId)
	{
		// we want the overrideable global phrase names minus those already defined for the given specialty and section

		$params[':sectionid'] = $sectionId;
		$params[':specialtyid'] = $specialtyId;

		$sql = 'select t1.id, t1.name from (
				-- set of phrase names associated with global phrases defined for the given section
				select phrase_name.id, phrase_name.name from phrase_name
				join phrase on phrase_name.id=phrase.phrase_name_id
				where phrase.section_id=:sectionid
			) as t1 left join (
				-- set of phrase names associated with phrases by specialty defined for the given section and specialty; in short we are subtracting this set from the previous since you cant override that which is already overridden
				select phrase_name.id, phrase_name.name from phrase_name
				join phrase_by_specialty on phrase_name.id=phrase_by_specialty.phrase_name_id and phrase_by_specialty.specialty_id=:specialtyid and phrase_by_specialty.section_id=:sectionid
			) as t2	
			on t1.id=t2.id where t2.id is null';

		$results = PhraseName::model()->findAllBySql($sql, $params);

		return $results;
	}
}
