<?php

namespace App\Repository\Projects;

use App\Repository\Repository;

/**
 * Class ProjectsRepository
 * @package App\Repository\Projects
 */
class ProjectsRepository implements Repository
{
    /**
     * GET https://YOURACCOUNT.harvestapp.com/projects
     *
     * @return string
     */
    public function getAll()
    {
        return '/projects';
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/projects/{PROJECTID}
     *
     * @param $id
     * @return string
     */
    public function getSingle($id)
    {
        return '/projects/' . $id;
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/projects?client={CLIENTID}
     *
     * @param $cid
     * @return string
     */
    public function getProjectsByClientId($cid)
    {
        return '/projects?client=' . $cid;
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/projects?updated_since=2015-03-25+18%3A30
     *
     * @param $timestamp
     * @return string
     */
    public function getProjectsUpdatedSince($timestamp)
    {
        $date = date('Y-m-d', $timestamp);
        $time = date('H:i', $timestamp);

        return '/projects?updated_since=' . $date . '+' . $time;
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/projects?client={CLIENTID}&updated_since=2015-03-25+18%3A30
     * @param $cid
     * @param $timestamp
     * @return string
     */
    public function getProjectsByClientIdAndUpdatedSince($cid, $timestamp)
    {
        $date = date('Y-m-d', $timestamp);
        $time = date('H:i', $timestamp);

        return '/projects?client=' . $cid . 'updated_since=' . $date . '+' . $time;
    }
}