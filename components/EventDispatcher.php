<?php
/**
 * Created by PhpStorm.
 * User: iproman
 * Date: 12.04.2019
 * Time: 6:12
 */

namespace app\components;

use Yii;
use yii\base\Event;
use yii\base\Component;
use rmrevin\yii\fontawesome\FA;
use yii\base\BootstrapInterface;
use app\models\entities\Task;
use app\models\entities\Event as Eve;

/**
 * Class EventDispatcher
 * @package app\components
 */
class EventDispatcher extends Component implements BootstrapInterface
{
    /**
     * Event constants.
     */
    const EVENT_UPDATED_TASK = 'Updated Task';
    const EVENT_DELETED_TASK = 'Deleted Task';
    const EVENT_INSERTED_TASK = 'Created Task';

    /**
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {
        Event::on(Task::class, Task::EVENT_AFTER_UPDATE, [$this, 'onTaskAfterUpdate']);
        Event::on(Task::class, Task::EVENT_AFTER_DELETE, [$this, 'onTaskAfterDelete']);
        Event::on(Task::class, Task::EVENT_AFTER_INSERT, [$this, 'onTaskAfterInsert']);
    }

    /**
     * Task after update
     *
     * @param Event $event
     */
    public function onTaskAfterUpdate(Event $event)
    {
        $task = $event->sender;
        $model = new Eve();
        $model->setAttributes([
            'title' => self::EVENT_UPDATED_TASK . ' #' . $task->id,
            'icon_name' => FA::_PENCIL,
            'event_id' => $task->id,
            'event_name' => $task->name,
        ], false);
        if (!$model->save()) {
            return $this->flashMessages('error', 'Update event not saved');
        }
    }

    /**
     * Task after delete
     *
     * @param Event $event
     */
    public function onTaskAfterDelete(Event $event)
    {
        $task = $event->sender;
        $model = new Eve();
        $model->setAttributes([
            'title' => self::EVENT_DELETED_TASK . ' #' . $task->id,
            'icon_name' => FA::_TRASH,
            'event_id' => $task->id,
            'event_name' => $task->name,
        ], false);
        if (!$model->save()) {
            return $this->flashMessages('error', 'Delete event not saved');
        }
    }

    /**
     * Task after create
     *
     * @param Event $event
     */
    public function onTaskAfterInsert(Event $event)
    {
        $task = $event->sender;
        $model = new Eve();
        $model->setAttributes([
            'title' => self::EVENT_INSERTED_TASK . ' #' . $task->id,
            'icon_name' => FA::_TASKS,
            'event_id' => $task->id,
            'event_name' => $task->name,
        ], false);
        if (!$model->save()) {
            return $this->flashMessages('error', 'Create event not saved');
        }
    }

    /**
     * Returns session flash messages
     *
     * @param string $key
     * @param bool $message
     * @param bool $remove
     */
    final protected function flashMessages(string $key, $message = true, $remove = true)
    {
        return Yii::$app->session->setFlash($key, $message, $remove);
    }
}