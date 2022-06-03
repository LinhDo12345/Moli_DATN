<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\News;
use App\Repositories\ActivityRepository;
use App\Repositories\GameRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
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
        $listGame = $this->gameRepository->getList([Game::IS_ACTIVE, Game::IN_ACTIVE]);
        $status   = Game::LIST_STATUS;
        return view('admin.game.list', ['listGame' => $listGame, 'status' => $status]);
    }

    public function getAddGame()
    {
        return view('admin.game.add');
    }

    public function postAddGame()
    {
        $this->validateAdd();
        $imageName = time() . '.' . $this->request->image->getClientOriginalExtension();

        $this->request->image->move(public_path('image/game'), $imageName);

        $path = time() . '.' . $this->request->path->getClientOriginalExtension();

        $this->request->path->move(public_path('zip/game'), $path);

        $data                 = $this->getDataAdd($imageName, $path);
        $data['time_created'] = time();
        $this->gameRepository->insert($data);
        return redirect('admin/game/list-game')->with('message', 'Thêm mới game thành công');
    }

    private function validateAdd($flag = false)
    {
        $rules = [
            'name'  => 'required',
            'image' => !$flag ? 'required|image|mimes:jpeg,png,jpg,gif,svg' : 'image|mimes:jpeg,png,jpg,gif,svg',
            'path'  => !$flag ? 'required' : ''
        ];

        $message = [
            'name.required'  => 'Tên game không được để trống',
            'image.required' => 'Hình ảnh game không được để trống',
            'path.required'  => 'Resource game không được để trống',
        ];

        $this->validate($this->request, $rules, $message);
    }

    private function getDataAdd($imageName, $path)
    {
        return [
            'name'         => $this->request->input('name'),
            'thumb'        => $imageName,
            'path'         => $path,
            'status'       => $this->request->input('status') != null ? $this->request->input('status') : Game::IS_ACTIVE,
            'time_updated' => time()
        ];
    }

    public function getDelete($id)
    {
        $issetAct = $this->activityRepository->getByGameId($id);
        if ($issetAct) {
            return redirect()->back()->with('message-error', 'Xóa game không thành công. Đang tồn tại activity cho game này !');
        }

        $this->gameRepository->update($id, ['status' => Game::CANCEL]);
        return redirect('admin/game/list-game')->with('message', 'Xóa game thành công!');
    }

    public function getEditGame($id)
    {
        $game   = $this->gameRepository->find($id);
        $status = Game::LIST_STATUS;
        return view('admin.game.edit', ['game' => $game, 'status' => $status]);
    }

    public function postEditGame($id)
    {
        $this->validateAdd(true);

        $existFile = $this->request->hasFile('image');
        if ($existFile) {
            $imageName = time() . '.' . $this->request->image->getClientOriginalExtension();
            $this->request->image->move(public_path('image/game'), $imageName);
        } else {
            $imageName = '';
        }

        $existFilePath = $this->request->hasFile('path');
        if ($existFilePath) {
            $pathName = time() . '.' . $this->request->path->getClientOriginalExtension();
            $this->request->path->move(public_path('zip/game'), $pathName);
        } else {
            $pathName = '';
        }

        $dataUpdate = [
            'name'         => $this->request->input('name'),
            'status'       => $this->request->input('status'),
            'time_updated' => time()
        ];

        if ($imageName != '') {
            $dataUpdate['thumb'] = $imageName;
        }
        if ($pathName != '') {
            $dataUpdate['path'] = $pathName;
        }

        $this->gameRepository->update($id, $dataUpdate);
        return redirect('admin/game/list-game')->with('message', 'Cập nhật game thành công');
    }

}

