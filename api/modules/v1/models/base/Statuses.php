<?php


namespace api\modules\v1\models\base;


/**
 * Class Statuses
 * @package app\models\service
 */
abstract class Statuses
{
    /**
     * Constants
     */
    const STATUS_NEW = 0;
    const STATUS_IN_WORK = 1;
    const STATUS_DONE = 2;
    const STATUS_WARNING = 3;
    const STATUS_REJECTED = 4;

    /**
     * Returns statuses
     *
     * @return array
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_NEW,
            self::STATUS_IN_WORK,
            self::STATUS_DONE,
            self::STATUS_WARNING,
            self::STATUS_REJECTED,
        ];
    }

    /**
     * Returns statuses names
     *
     * @return array
     */
    public static function getStatusNames()
    {
        return [
            self::STATUS_NEW => 'New',
            self::STATUS_IN_WORK => 'In work',
            self::STATUS_DONE => 'Done',
            self::STATUS_WARNING => 'Hot',
            self::STATUS_REJECTED => 'Rejected',
        ];
    }

    /**
     * Returns status labels
     *
     * @return array
     */
    public static function getStatusLabels()
    {
        return [
            self::STATUS_NEW => 'new',
            self::STATUS_IN_WORK => 'in work',
            self::STATUS_DONE => 'done',
            self::STATUS_WARNING => 'warning',
            self::STATUS_REJECTED => 'rejected',
        ];
    }

    /**
     * Returns status for css
     *
     * @return array
     */
    public static function getStatusCss()
    {
        return [
            self::STATUS_NEW => 'success',
            self::STATUS_IN_WORK => 'info',
            self::STATUS_DONE => 'default',
            self::STATUS_WARNING => 'warning',
            self::STATUS_REJECTED => 'danger',
        ];
    }
}