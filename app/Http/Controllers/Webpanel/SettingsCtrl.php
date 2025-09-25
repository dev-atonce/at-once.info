<?php

namespace App\Http\Controllers\Webpanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsCtrl extends Controller
{
    protected $path = 'back-end';
    protected $prefix = 'webpanel';
    public function __construct()
    {
        $this->config = (object)[
            'css' => (object)[
                'validate'=>"back-end/css/validate.css",
                'draggable'=>"js/draggable-nestable-list/src/dist/DraggableNestableList.min.css",
            ],
            'js' => (object)[
                'axios' => (object)['src'=>'js/axios.min.js'],
                'jquery' => (object)['type'=>"text/javascript",'src'=>"back-end/js/jquery.min.js",'class'=>"view-script"],
                'jqueryUi' => (object)['src'=>"js/jquery-ui.min.js"],
                'tabledragger' => (object)["src"=>"back-end/js/table-dragger.min.js"],
                'draggable' => (object)['src'=>'js/draggable-nestable-list/src/DraggableNestableList.js'],
                'sweetalert' => (object)["src"=>'back-end/js/sweetalert2.all.min.js'],
                'validate' => (object)["type"=>"text/javascript","src"=>"back-end/jquery-validation-1.19.1/dist/jquery.validate.min.js"],
                'build' => (object)[
                    'setting' => ["type"=>"text/javascript","src"=>"back-end/build/setting.js"]
                ]
            ],
        ];
    }

    public function category(Request $request)
    {

        return view('back-end.modules.setting.index',[
            'js' => [
                $this->config->js->jquery->src,
                $this->config->js->jqueryUi->src,
                $this->config->js->draggable->src,
                $this->config->js->sweetalert->src,
            ],
            'prefix' => $this->prefix,
            'folder' => 'setting.category',
            'page' => 'index'
        ]);
    }
    public function categoryDetail(Request $request)
    {
        return view('back-end.modules.setting.category.detail',[
            'js' => [
                $this->config->js->jquery->src,
                $this->config->js->jqueryUi->src,
                $this->config->js->draggable->src,
                $this->config->js->sweetalert->src,
            ],
            'prefix' => $this->prefix
        ]);
    }
    public function categoryDetailUpdate(Request $request)
    {
        $res = ['status'=>false,'message'=>'500 Internal error'];
        $data = \App\Models\CategoryMd::where('id',$request->id)->first();
        if(@$data->id){
            $data->detail_th = $request->detail_th;
            $data->detail_en = $request->detail_en;
            $data->detail_jp = $request->detail_jp;
            $data->detail_zh = $request->detail_zh;
            if ($data->save()) {
                $res = [
                    'status' => true,
                    'message' => 'Data has been updated!'
                ];
            }
        }
        echo '<h2 style="display:flex;justify-content:center;margin-top:40px;">'.$res['message'].'</h2>';


        if($res['status'] === true) {
            echo '<h4 style="display:flex;justify-content:center;">Auto close in <span id="countdown" style="margin-left:5px;">5</span></h4>';
        }else{
            echo '<h4 style="display:flex;justify-content:center;">Auto redirect in <span id="countdown" style="margin-left:5px;">5</span></h4>';
        }
        echo '<script>
                var timeleft = 5;
                var downloadTimer = setInterval(function(){
                    if(timeleft <= 0){
                        clearInterval(downloadTimer);
                        window.close();
                    } else {
                        document.getElementById("countdown").innerHTML = timeleft;
                    }
                    timeleft -= 1;
                }, 1000);
            </script>';
    }
}
