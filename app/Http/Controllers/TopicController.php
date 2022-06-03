<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Game;
use App\Models\Topic;
use App\Repositories\ActivityRepository;
use App\Repositories\GameRepository;
use App\Repositories\TopicHasActivityRepository;
use App\Repositories\TopicRepository;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    private $request;
    private $topicRepository;
    private $gameRepository;
    private $activityRepository;
    private $topicHasActivityRepo;

    public function __construct(
        Request $request,
        TopicRepository $topicRepository,
        GameRepository $gameRepository,
        ActivityRepository $activityRepository,
        TopicHasActivityRepository $topicHasActivityRepo
    ) {
        $this->request              = $request;
        $this->topicRepository      = $topicRepository;
        $this->gameRepository       = $gameRepository;
        $this->activityRepository   = $activityRepository;
        $this->topicHasActivityRepo = $topicHasActivityRepo;
    }

    public function getListTopic()
    {
        $pathDisplay  = $this->request->getSchemeAndHttpHost();
        $listTopic    = $this->topicRepository->getList()->toArray();
        $listActTopic = $this->activityRepository->getList()->groupBy('topic_id')->toArray();

        foreach ($listActTopic as &$listAct) {
            foreach ($listAct as &$act) {
                $act['path_activity'] = $pathDisplay . '/zip/activity/' . $act['path_activity'];
                $act['thumb_game']    = $pathDisplay . '/image/game/' . $act['thumb_game'];
                $act['path_game']     = $pathDisplay . '/zip/game/' . $act['path_game'];
            }
        }

        $listGame = $this->gameRepository->getList([Game::IS_ACTIVE]);
        foreach ($listGame as &$game) {
            $game['thumb'] = $pathDisplay . '/image/game/' . $game['thumb'];
            $game['path']  = $pathDisplay . '/zip/game/' . $game['path'];
        }

        foreach ($listTopic as $key => &$value) {
            $value['thumb'] = $pathDisplay . '/image/topic/' . $value['thumb'];
            $id             = $value['id'];
            if (isset($listActTopic[$id])) {
                $value['act'] = $listActTopic[$id];
                continue;
            }
            $value['act'] = [];
        }

        $data['status']  = 'success';
        $data['message'] = 'Thành công';
        $data['code']    = 200;

        $data['data']['list_topic'] = $listTopic;
        $data['data']['list_game']  = $listGame;
        return response()->json($data);
    }

    public function getList()
    {
        $listTopic = $this->topicRepository->getListTopic();
        $status    = Topic::LIST_STATUS;
        return view('admin.topic.list', ['listTopic' => $listTopic, 'status' => $status]);
    }

    public function getAddTopic()
    {
        $listActivity = $this->activityRepository->getListAct([Activity::IS_ACTIVE]);
        return view('admin.topic.add', ['listActivity' => $listActivity]);
    }

    public function postAddTopic()
    {

        $this->validateAdd();
        $imageName = time() . '.' . $this->request->image->getClientOriginalExtension();

        $listAct = $this->request->input('activity_id');

        $this->request->image->move(public_path('image/topic'), $imageName);

        $data                 = $this->getDataAdd($imageName);
        $data['time_created'] = time();
        $topicId              = $this->topicRepository->insertGetId($data);

        $this->updateTopicHasAct($topicId, $listAct);

        return redirect('admin/topic/list-topic')->with('message', 'Thêm mới chủ đề thành công');
    }

    private function updateTopicHasAct($topicId, $listAct)
    {
        $this->topicHasActivityRepo->deleteByTopicId($topicId);
        $dataInsert = [];
        foreach ($listAct as $value) {
            $item['topic_id']    = $topicId;
            $item['activity_id'] = $value;
            $dataInsert[]        = $item;
        }
        $this->topicHasActivityRepo->insert(array_values($dataInsert));
    }

    private function validateAdd($flag = false)
    {
        $rules = [
            'name'        => 'required',
            'activity_id' => 'required',
            'image'       => !$flag ? 'required|image|mimes:jpeg,png,jpg,gif,svg' : 'image|mimes:jpeg,png,jpg,gif,svg'
        ];

        $message = [
            'name.required'        => 'Tên chủ đề không được để trống',
            'activity_id.required' => 'Bạn chưa chọn activity',
            'image.required'       => 'Hình ảnh không được để trống',
            'image.image'          => 'Định dạng file không đúng',
        ];

        $this->validate($this->request, $rules, $message);
    }

    private function getDataAdd($imageName)
    {
        return [
            'name'         => $this->request->input('name'),
            'thumb'        => $imageName,
            'status'       => $this->request->input('status') != null ? $this->request->input('status') : Topic::IS_ACTIVE,
            'time_updated' => time()
        ];
    }

    public function getDelete($id)
    {
        $this->topicRepository->update($id, ['status' => Topic::IS_CANCEL]);
        return redirect('admin/topic/list-topic')->with('message', 'Xóa chủ đề thành công!');
    }

    public function getEditTopic($id)
    {
        $topic        = $this->topicRepository->find($id);
        $status       = Topic::LIST_STATUS;
        $listActivity = $this->activityRepository->getListAct([Activity::IS_ACTIVE]);
        return view('admin.topic.edit', ['topic' => $topic, 'status' => $status, 'listActivity' => $listActivity]);
    }

    public function postEditTopic($id)
    {
        $this->validateAdd(true);

        $listAct = $this->request->input('activity_id');

        $existFile = $this->request->hasFile('image');
        if ($existFile) {
            $imageName = time() . '.' . $this->request->image->getClientOriginalExtension();
            $this->request->image->move(public_path('image/topic'), $imageName);
        } else {
            $imageName = '';
        }
        $dataUpdate = [
            'name'         => $this->request->input('name'),
            'status'       => $this->request->input('status'),
            'time_updated' => time()
        ];

        if ($imageName != '') {
            $dataUpdate['thumb'] = $imageName;
        }

        $this->updateTopicHasAct($id, $listAct);

        $this->topicRepository->update($id, $dataUpdate);
        return redirect('admin/topic/list-topic')->with('message', 'Cập nhật chủ đề thành công');
    }

}

