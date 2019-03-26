<?php
/**
 * Created by PhpStorm.
 * User: iproman
 * Date: 07.01.2019
 * Time: 10:00
 */

namespace app\components;

use yii\helpers\Url;
use rmrevin\yii\fontawesome\FAS;
use yii\base\Widget;
use app\models\entities\Task;

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
    public $fa;
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
            $this->status = Task::STATUS_NEW;
        }
        if ($this->count === null) {
            $this->count = Task::find()
                ->where(['=', 'status', Task::STATUS_NEW])
                ->count();
        }
        if ($this->fa === null) {
            $this->fa = FAS::_CLIPBOARD_LIST;
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
                'fa' => $this->fa,
                'text' => $this->text,
                'link' => $this->link,
            ]
        );
    }
}