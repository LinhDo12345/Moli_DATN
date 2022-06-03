<?php

namespace App\Http\Controllers;

use App\Repositories\ActivityRepository;
use App\Repositories\GameRepository;
use App\Repositories\StaffRepository;
use App\Repositories\TopicRepository;
use App\Repositories\UserRepository;


class DashboardController extends Controller
{
    private $gameRepository;
    private $staffRepository;
    private $topicRepository;
    private $activityRepository;
    private $userRepository;

    public function __construct(
        StaffRepository $staffRepository,
        GameRepository $gameRepository,
        TopicRepository $topicRepository,
        ActivityRepository $activityRepository,
        UserRepository $userRepository
    ) {
        $this->gameRepository     = $gameRepository;
        $this->staffRepository    = $staffRepository;
        $this->topicRepository    = $topicRepository;
        $this->activityRepository = $activityRepository;
        $this->userRepository     = $userRepository;
    }

    public function reportTotal()
    {
        $data['countTopic']    = count($this->topicRepository->getListTopic());
        $data['countGame']     = count($this->gameRepository->getList([0,1]));
        $data['countActivity'] = count($this->activityRepository->getListAct([0, 1]));
        $data['countUser']     = $this->userRepository->countAll();

        return view('admin.dashboard.report', ['data' => $data]);
    }
}
