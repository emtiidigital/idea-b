<?php

namespace App\Repository\Users;

use App\Repository\Repository;

/**
 * Class UsersRepository
 * @package App\Repository\Users
 */
class UsersRepository implements Repository
{
    /**
     * https://YOURACCOUNT.harvestapp.com/people
     *
     * @return string
     */
    public function getAll()
    {
        return '/people';
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/people/{USERID}
     *
     * @param $id
     * @return string
     */
    public function getSingle($id)
    {
        return '/people/' . $id;
    }

    /**
     * GET https://YOURACCOUNT.harvestapp.com/people?updated_since=2015-04-25+18%3A30
     *
     * @param $timestamp
     * @return string
     */
    public function getUserUpdatedSince($timestamp)
    {
        $date = date('Y-m-d', $timestamp);
        $time = date('H:i', $timestamp);

        return '/people?updated_since=' . $date . '+' . $time;
    }
}