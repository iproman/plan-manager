<?php
/**
 * Created by PhpStorm.
 * User: iproman
 * Date: 07.01.2019
 * Time: 10:00
 */

namespace app\widgets;

use yii\helpers\Url;
use yii\base\Widget;
use app\models\entities\Task;
use app\models\service\Statuses;

class ViewDetails extends Widget
{
    /**
     * @var integer
     */
    public $status;
    /**
     * @var integer
     */
    public $count;
    /**
     * @var string
     */
    public $icon;
    /**
     * @var string
     */
    public $text;
    /**
     * @var string
     */
    public $link;

    public function init()
    {
        parent::init();
        if ($this->status === null) {
            $this->status = Statuses::STATUS_NEW;
        }
        if ($this->count === null) {
            $this->count = Task::find()
                ->where(['=', 'status', Statuses::STATUS_NEW])
                ->count();
        }
        if ($this->icon === null) {
            $this->icon = 'glyphicon glyphicon-list-alt';
        }
        if ($this->text === null) {
            $this->text = 'New challenge!';
        }
        if ($this->link === null) {
            $this->link = Url::to(['/']);
        }
    }

    public function run()
    {
        return $this->render(
            'view-details',
            [
                'status' => $this->status,
                'count' => $this->count,
                'icon' => $this->icon,
                'text' => $this->text,
                'link' => $this->link,
            ]
        );
    }
}