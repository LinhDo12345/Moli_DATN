<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Game;
use App\Repositories\ActivityRepository;
use App\Repositories\GameRepository;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    private $request;
    private $gameRepository;
    private $activityRepository;

    public function __construct(
        Request $request,
        GameRepository $gameRepository,
        ActivityRepository $activityRepository
    ) {
        $this->request            = $request;
        $this->gameRepository     = $gameRepository;
        $this->activityRepository = $activityRepository;
    }

    public function getList()
    {
        $listActivity = $this->activityRepository->getListAct([Activity::IS_ACTIVE, Activity::IN_ACTIVE]);
        $listGame     = $this->gameRepository->getList([Game::IS_ACTIVE])->keyBy('id');
        $status       = Activity::LIST_STATUS;
        return view('admin.activity.list', ['listActivity' => $listActivity, 'status' => $status, 'listGame' => $listGame]);
    }

    public function getAddActivity()
    {
        $listGame = $this->gameRepository->getList([Game::IS_ACTIVE])->keyBy('id');
        return view('admin.activity.add', ['listGame' => $listGame]);
    }

    public function postAddActivity()
    {
        $this->validateAdd();

        $path = time() . '.' . $this->request->path->getClientOriginalExtension();

        $this->request->path->move(public_path('zip/activity'), $path);

        $data                 = $this->getDataAdd($path);
        $data['time_created'] = time();
        $this->activityRepository->insert($data);
        return redirect('admin/activity/list-activity')->with('message', 'Thêm mới activity thành công');
    }

    private function validateAdd($flag = false)
    {
        $rules = [
            'name'    => 'required',
            'game_id' => 'required',
            'path'    => !$flag ? 'required' : ''
        ];

        $message = [
            'name.required'    => 'Tên game không được để trống',
            'game_id.required' => 'Game không được để trống',
            'path.required'    => 'File data không được để trống',
        ];

        $this->validate($this->request, $rules, $message);
    }

    private function getDataAdd($path)
    {
        return [
            'name'         => $this->request->input('name'),
            'game_id'      => $this->request->input('game_id'),
            'path'         => $path,
            'status'       => $this->request->input('status') != null ? $this->request->input('status') : Activity::IS_ACTIVE,
            'time_updated' => time()
        ];
    }

    public function getDelete($id)
    {
        $this->activityRepository->update($id, ['status' => Activity::CANCEL]);
        return redirect('admin/activity/list-activity')->with('message', 'Xóa activity thành công!');
    }

    public function getEditActivity($id)
    {
        $activity = $this->activityRepository->find($id);
        $listGame = $this->gameRepository->getList([Game::IS_ACTIVE])->keyBy('id');
        $status   = Activity::LIST_STATUS;
        return view('admin.activity.edit', ['activity' => $activity, 'listGame' => $listGame, 'status' => $status]);
    }

    public function postEditActivity($id)
    {
        $this->validateAdd(true);

        $existFilePath = $this->request->hasFile('path');
        if ($existFilePath) {
            $pathName = time() . '.' . $this->request->path->getClientOriginalExtension();
            $this->request->path->move(public_path('zip/activity'), $pathName);
        } else {
            $pathName = '';
        }

        $dataUpdate = [
            'name'         => $this->request->input('name'),
            'game_id'      => $this->request->input('game_id'),
            'status'       => $this->request->input('status'),
            'time_updated' => time()
        ];
        if ($pathName != '') {
            $dataUpdate['path'] = $pathName;
        }

        $this->activityRepository->update($id, $dataUpdate);
        return redirect('admin/activity/list-activity')->with('message', 'Cập nhật activity thành công');
    }

}

