<?php


namespace api\modules\v1\models;


use api\modules\v1\models\base\BaseModel;

class Task extends BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'task';
    }

    public function rules()
    {
        return [
            [
                'name',
                'required'
            ],
            [
                'name',
                'string',
                'max' => 64
            ],
            [
                'name',
                'filter',
                'filter' => function ($v) {
                    return trim(strip_tags($v));
                }
            ],
            [
                'content',
                'default',
                'value' => null,
            ],
            [
                'content',
                'string',
                'max' => 2000
            ],
            [
                'name',
                'filter',
                'filter' => function ($v) {
                    return $v; // TODO: base on scenario, HtmlPurifier
                }
            ],
            [
                'status',
                'in',
                'range' => Statuses::getStatuses(),
            ],
            [
                'status',
                'default',
                'value' => Statuses::STATUS_NEW,
            ],
            [
                'branch',
                'match',
                'pattern' => '/^[a-z\d]+$/iu',
                'message' => 'Branch must contain only letters and numbers'
            ],
            [
                'project_id',
                'required'
            ],
            [
                'project_id',
                'integer'
            ],
            [

                'project_id',
                'exist',
                'skipOnError' => true,
                'targetClass' => Project::class,
                'targetAttribute' => [
                    'project_id' => 'id'
                ]
            ],
            [['event_time'], 'integer'], // TODO: Auto fill as timestamp.
        ];
    }


}