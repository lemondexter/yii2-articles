<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @github https://github.com/cinghie/yii2-articles
 * @license GNU GENERAL PUBLIC LICENSE VERSION 3
 * @package yii2-articles
 * @version 0.6.6
 */

namespace cinghie\articles\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%article_tags_assign}}".
 *
 * @property integer $id
 * @property integer $tag_id
 * @property integer $item_id
 *
 * @property ActiveQuery $tag
 * @property ActiveQuery $item
 */
class Tagsassign extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_tags_assign}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','tag_id', 'item_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('articles', 'ID'),
            'tag_id' => Yii::t('articles', 'Tag'),
            'item_id' => Yii::t('articles', 'Item'),
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Items::class, ['id' => 'item_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getTag()
    {
        return $this->hasOne(Tags::class, ['id' => 'tag_id']);
    }

    /**
     * @inheritdoc
     *
     * @return TagsassignQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TagsassignQuery( static::class );
    }

}
