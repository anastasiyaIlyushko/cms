<?php

/**
 * This is the model class for table "page".
 *
 * The followings are the available columns in table 'page':
 * @property integer $id
 * @property integer $parentId
 * @property string $menuTitle
 * @property string $pageTitle
 * @property string $content
 * @property string $seoTitle
 * @property string $seoDescription
 * @property string $seoKeywords
 * @property integer $isShow
 * @property integer $isDelete
 * @property integer $type
 * @property integer $sorter
 */
class Page extends CActiveRecord {

    public $maxSorter;
    public $minSorter;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'page';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('parentId, menuTitle, pageTitle, isShow, isDelete, type, sorter', 'required'),
            array('parentId, isShow, isDelete, type, sorter', 'numerical', 'integerOnly' => true),
            array('menuTitle, pageTitle, seoTitle, seoDescription, seoKeywords', 'length', 'max' => 255),
            array('content', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('id, parentId, menuTitle, pageTitle, content, seoTitle, seoDescription, seoKeywords, isShow, isDelete, type, sorter', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'parentId' => 'Родительская страница',
            'menuTitle' => 'Название пункта меню',
            'pageTitle' => 'Название ссылки',
            'content' => 'Содержимое',
            'seoTitle' => 'Заголовок Seo',
            'seoDescription' => 'Описание Seo',
            'seoKeywords' => 'Ключевые слова Seo',
            'isShow' => 'Показать в меню',
            'isDelete' => 'Is Delete',
            'type' => 'Тип',
            'sorter' => 'Порядок отображения',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('parentId', $this->parentId);
        $criteria->compare('menuTitle', $this->menuTitle, true);
        $criteria->compare('pageTitle', $this->pageTitle, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('seoTitle', $this->seoTitle, true);
        $criteria->compare('seoDescription', $this->seoDescription, true);
        $criteria->compare('seoKeywords', $this->seoKeywords, true);
        $criteria->compare('isShow', $this->isShow);
        $criteria->compare('isDelete', $this->isDelete);
        $criteria->compare('type', $this->type);
        $criteria->compare('sorter', $this->sorter);

        $criteria->condition = 'isDelete = 0';
        $criteria->order = 'sorter';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Page the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public static function getSorterLimit($boundName) {
        $criteria = new CDbCriteria;
        $criteria->select = 'max(sorter) AS maxSorter, min(sorter) AS minSorter';
        $sorterParams = Page::model()->find($criteria);
        if ($boundName == 'up') {
            return $sorterParams->minSorter;
        } elseif ($boundName == 'down') {
            return $sorterParams->maxSorter;
        }
    }

//        public function beforeSave() {
//            parent::beforeSave();
//            if(!isset($this->parentId)){
//                $this->parentId = 0;
//            }
//            
//        }
}
