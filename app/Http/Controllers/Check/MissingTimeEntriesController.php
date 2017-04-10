<?php declare(strict_types=1);

namespace App\Http\Controllers\Check;

use App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Repository\Mapper\TimesheetMapper;
use App\Repository\Mapper\UserMapper;
use App\Repository\TimesheetsRepository;
use App\Repository\UsersRepository;

/**
 * Class MissingTimeEntriesController
 * @package App\Http\Controllers\Check
 */
class MissingTimeEntriesController extends Controller
{
    /**
     * @var Client $api
     */
    private $api;
    /**
     * @var TimesheetsRepository $timesheets
     */
    public $timesheets;
    /**
     * @var UsersRepository $user
     */
    private $user;
    /**
     * @var UserMapper $userMapper
     */
    private $userMapper;
    /**
     * @var TimesheetMapper $timesheetMapper
     */
    private $timesheetMapper;

    /**
     * MissingTimeEntriesController constructor.
     */
    public function __construct()
    {
        $this->api = new Client();
        $this->timesheets = new TimesheetsRepository();
        $this->user = new UsersRepository();
        $this->userMapper = new UserMapper();
        $this->timesheetMapper = new TimesheetMapper();
    }

    public function run()
    {
        $users = $this->getAllUserFromHarvest();

        if ($users) {
            foreach ($users as $user) {
                $uid = $this->getUserIdFromHarvest($user);

                if ($uid) {
                    $timesheet = $this->getTimesheetsFromHarvestByUserId($uid);

                    // todo: check for times < 4 hours

                    // todo: check for time entries <= 0
                }
            }
        }
    }

    private function getAllUserFromHarvest()
    {
        return $this->api->getResponse(
            $this->user->getAll()
        );
    }

    private function getUserIdFromHarvest($user)
    {
        $u = $this->userMapper->setUserData($user);
        return $u->getId();
    }

    private function getTimesheetsFromHarvestByUserId($uid)
    {
        return $this->api->getResponse(
            $this->timesheets->getEntriesOfUserById($uid)
        );
    }
}
