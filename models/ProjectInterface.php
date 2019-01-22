<?php
/**
 * Created by PhpStorm.
 * User: iproman
 * Date: 22.01.2019
 * Time: 23:57
 */

namespace app\models;


interface ProjectInterface
{
    /**
     * Returns project name
     *
     * @param $projectId
     * @return mixed
     */
    public static function getProjectName($projectId);

    /**
     * Returns all projects
     *
     * @return mixed
     */
    public static function getProjects();
}