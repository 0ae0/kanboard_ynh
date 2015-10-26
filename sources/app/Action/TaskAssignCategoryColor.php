<?php

namespace Kanboard\Action;

use Kanboard\Model\Task;

/**
 * Set a category automatically according to the color
 *
 * @package action
 * @author  Frederic Guillot
 */
class TaskAssignCategoryColor extends Base
{
    /**
     * Get the list of compatible events
     *
     * @access public
     * @return array
     */
    public function getCompatibleEvents()
    {
        return array(
            Task::EVENT_CREATE_UPDATE,
        );
    }

    /**
     * Get the required parameter for the action (defined by the user)
     *
     * @access public
     * @return array
     */
    public function getActionRequiredParameters()
    {
        return array(
            'color_id' => t('Color'),
            'category_id' => t('Category'),
        );
    }

    /**
     * Get the required parameter for the event
     *
     * @access public
     * @return string[]
     */
    public function getEventRequiredParameters()
    {
        return array(
            'task_id',
            'color_id',
        );
    }

    /**
     * Execute the action (change the category)
     *
     * @access public
     * @param  array   $data   Event data dictionary
     * @return bool            True if the action was executed or false when not executed
     */
    public function doAction(array $data)
    {
        $values = array(
            'id' => $data['task_id'],
            'category_id' => $this->getParam('category_id'),
        );

        return $this->taskModification->update($values);
    }

    /**
     * Check if the event data meet the action condition
     *
     * @access public
     * @param  array   $data   Event data dictionary
     * @return bool
     */
    public function hasRequiredCondition(array $data)
    {
        return $data['color_id'] == $this->getParam('color_id');
    }
}
