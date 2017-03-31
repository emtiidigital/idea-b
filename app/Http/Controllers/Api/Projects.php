<?php
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Client;
use App\Http\Controllers\Controller;

class Projects extends Controller
{
    const HARVEST_API_ENDPOINT = 'projects/';

    const ONLY_BILLABLE = true;
    const ONLY_ACTIVE  = true;

    /** @var \DateTime $date */
    private $date;

    public function __construct()
    {
        $this->date = new \DateTime();
    }

    public function getProjectsByCustomerIdUpdatedThisWeek($cid)
    {
        $updated_since = $this->date
            ->modify('monday this week')
            ->format('Y-m-d');

        $request = self::HARVEST_API_ENDPOINT . '?client=' . $cid . '&updated_since=' . $updated_since;

        $client = new Client(self::HARVEST_API_ENDPOINT, $request);

        return $client->getResponse();
    }

    public function getAllTimeEntriesByProjectId($pid)
    {
        $start = 'from=1900-01-01';
        $today = '&to=' . $this->date
                ->format('Y-m-d');
        $billable = '&billable=' . $this->getOnlyBillableProjects();
        $active = '&is_closed=' . $this->getOnlyActiveProjects();

        $request = self::HARVEST_API_ENDPOINT . $pid . 'entries?' . $start . $today . $billable . $active;

        $client = new Client(self::HARVEST_API_ENDPOINT, $request);

        return $client->getResponse();
    }

    private function getOnlyBillableProjects()
    {
        if (self::ONLY_BILLABLE) {
            return 'yes';
        } else {
            return 'no';
        }
    }

    private function getOnlyActiveProjects()
    {
        if (self::ONLY_ACTIVE) {
            return 'no';
        } else {
            return 'yes';
        }
    }

    public function getProjectsByCustomerId($cid)
    {
        $request = self::HARVEST_API_ENDPOINT . '?client=' . $cid;

        $client = new Client(self::HARVEST_API_ENDPOINT, $request);

        return $client->getResponse();
    }
}