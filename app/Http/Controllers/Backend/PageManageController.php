<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Backend\UserService;
use Illuminate\Http\Request;
use App\Services\Backend\PageManagementService;
use App\Repository\Backend\PageManagementRepository;
use App\Repository\Backend\SiteManagementRepository;
use App\Repository\Backend\ResourceManagementRepository;
use App\Services\Backend\ResourceManagementService;
use App\Repository\Backend\UserRepository;
use Auth;

class PageManageController extends Controller
{
    protected $pageManagementServ;
    protected $userSv;
    protected $pageManagementRepo;
    protected $siteManagementRepo;
    protected $resourceManagementRepo;
    protected $userRepo;
    protected $resourceManagementSv;

    public function __construct(PageManagementService $siteManagementService,
                                UserService $userService,
                                PageManagementRepository $pageManagementRepository,
                                SiteManagementRepository $siteManagementRepository,
                                ResourceManagementRepository $resourceManagementRepository,
                                UserRepository $userRepository,
                                ResourceManagementService $resourceManagementService)
    {
        $this->pageManagementServ = $siteManagementService;
        $this->userSv = $userService;
        $this->pageManagementRepo = $pageManagementRepository;
        $this->siteManagementRepo = $siteManagementRepository;
        $this->resourceManagementRepo = $resourceManagementRepository;
        $this->userRepo = $userRepository;
        $this->resourceManagementSv = $resourceManagementService;
    }

    /**
     * 列表頁
     *
     */
    public function index(Request $request)
    {
        // 取得登入的會員
        $user_id = Auth::user()->id;
        $current_user = $this->userRepo->getById($user_id);
        $current_user_site = $this->siteManagementRepo->getByUserId($user_id);

        $rows = $this->pageManagementServ->searchList($current_user, $request, 15);

        foreach ($rows as &$row) {
//            $row->url = "https://realleaftaiwan.our-work.com.tw/page/$row->folder_name/$row->page_id";
            $row->url = "https://www.top1bwl.com/page/$row->folder_name/$row->page_id";
        }

        return view('admin.page_manage.list', [
            'rows' => $rows,
            'current_user_role' => $current_user->role,
            'current_user_site_enable' => $current_user_site->enable,
        ]);
    }

    /**
     * 選擇版型頁
     *
     */
    public function selectTemplatePage()
    {
        return view('admin.page_manage.create_select_template');
    }

    /**
     * 新增頁
     *
     */
    public function createPage(Request $request)
    {
        $template_id = $request->input('template');

        $template = $this->pageManagementRepo->getTemplate($template_id);
        $content = $template->content;

        return view('admin.page_manage.create', [
            'content' => $content
        ]);
    }

    /**
     * 新增
     *
     */
    public function create(Request $request)
    {
        $user_id = Auth::user()->id;
        $site = $this->siteManagementRepo->getByUserId($user_id);
        $site_id = $site->site_id;

        $this->pageManagementServ->createItem($request, $site_id);

        return redirect('/backend/page_manage');
    }

    /**
     * 修改頁
     *
     */
    public function editPage($id)
    {
        $row = $this->pageManagementServ->getEditItem($id);

        return view('admin.page_manage.edit', [
            'row' => $row
        ]);
    }

    /**
     * 修改
     *
     */
    public function edit(Request $request)
    {
        $id = $this->pageManagementServ->updateItem($request);

        return redirect('/backend/page_manage/edit/' . $id);
    }

    public function getTemplate()
    {
        $component1 = '
            <!-- 特殊視覺 -->
            <div class="main">
                <div class="note note__center main__note">
                    <div class="note__content">
                        <div class="content">
                            <h2 class="content__title">全美世界12周年慶 優惠送不完</h2>
                            <p class="content__text">全美世界12周年慶優惠來了!全美世界皙之密平常買不下手，但週年慶來了，想撿便宜趁現在喔，數量有限趁現在!! </p>
                        </div>
                    </div>
                </div>
                <div class="images main__images">
                    <div class="images__content images__half">
                        <img src="/assets/template/images/banner6.jpg" alt="">
                    </div>
                </div>
            </div>
            ';

        $component2 = '
            <!-- 文章(置中) -->
            <div class="note note__center">
                <div class="note__content">
                    <div class="content">
                        <h2 class="content__title">想舒緩全身痠痛，熱敷還是冰敷才有效？</h2>
                        <p class="content__text">運動可以健身，但是很常在運動後出現肌肉痠痛的現象，這時是應該要冰敷還是熱敷來緩解痠痛呢？運動醫學科醫師指出，應該要先冰敷，冰敷三天之後，再熱敷，而且冰敷與熱敷時間不宜太長，一次以十分鐘為限。</p>
                        <ul class="content__list">
                            <li>每週運動三至五天　每次半小時</li>
                            <li>應該要先冰敷　不要超過十分鐘</li>
                            <li>過了急性發炎期　應該要熱敷</li>
                        </ul>
                    </div>
                    <div class="event">
                        <a class="event__btn" href="javascript:void(0)">前往瞭解</a>
                    </div>
                </div>
            </div>
        ';

        $component3 = '
<!-- 圖文組合 -->
        <div class="combine combine__reverse combine__half">
            <div class="combine__content">
                <div class="content__img">
                    <img src="https://www.enbw.com.tw/FileUpload/Portals/pic1.jpg" alt="">
                </div>
                <div class="content__article">
                    <div class="article">
                        <h2 class="article__title">German Energiewende德國能源轉型之旅</h2>
                        <p class="article__text">德國是全球最早開始進行能源轉型改革的國家之一。能源轉型(Energiewende)對德國來說，不僅僅只是減少傳統燃煤與核能發電，或提高再生能源發電比例而已，而是一場「能源革命」。這是從發電、送電、配電到用電全面進行變革的轉型大計，並擴展到德國全體國民的共同參與。</p>
                        <ul class="article__list">
                            <li>清單(一)</li>
                            <li>清單列表(二)</li>
                            <li>清單(三)</li>
                            <li>清單列表(四)</li>
                        </ul>
                    </div>
                    <div class="event">
                        <a class="event__btn" href="javascript:void(0)">前往瞭解</a>
                    </div>
                </div>
            </div>
        </div>
';

        $component4 = '
<!-- 輪播 -->
    <div class="carousel">
        <div class="carousel__content">
            <div class="swiper-container carousel__normal">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="/assets/template/images/banner1 (1).jpg" alt="">
                        <div class="carousel__text">
                            圖片(ㄧ)
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <img src="/assets/template/images/banner2 (1).jpg" alt="">
                        <div class="carousel__text">
                            圖片(二)
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <img src="/assets/template/images/banner1 (1).jpg" alt="">
                        <div class="carousel__text">
                            圖片(三)
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <img src="/assets/template/images/banner5 (1).jpg" alt="">
                        <div class="carousel__text">
                            圖片(四)
                        </div>
                    </div>
                </div>
                <div class="swiper-button-next swiper-button-next1"></div>
                <div class="swiper-button-prev swiper-button-prev2"></div>
            </div>
        </div>
    </div>
';

        $component5 = '
<!-- 圖片 -->
    <div class="images images__half">
        <div class="images__content">
            <img src="/assets/template/images/banner1 (1).jpg" alt="">
        </div>
    </div>
    <div class="images images__half">
        <div class="images__content">
            <div class="iframe">
                <iframe src="https://www.youtube.com/embed/9ckZ_8ROvd8" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
        </div>
    </div>
';

        $component6 = '
<!-- 項目 -->
    <div class="item">
        <div class="item__article">
            <div class="content">
                <h2 class="content__title">Netflix 收費方案解析 高畫質要多少錢</h2>
                <p class="content__text">2016 年登台的 Netflix 主要以歐美影集為大宗，最一開始的免費試用一個月優惠吸引許多人躍躍欲試，前陣子台灣免費試用期取消，最近重新回鍋！不用註冊帳號就可以免費收看10部作品，包含熱門電影和影集。加入註冊後就要開始收費。雖然不像
                    Spotify、Apple Music 一樣有多人共用的「家庭方案」，但可以選擇最高級的訂閱方案，找 4 名親朋好友一起分享，一個人單月不用 100 元就能看到飽，實在非常吸引人。</p>
            </div>
        </div>
        <div class="item__content">
            <div class="content">
                <div class="article">
                    <h2 class="article__title">基本會員</h2>
                    <p class="article__text">基本方案每個月月費為 NT$ 270 可以收看標準畫質 SD 影片，只能在 1 個裝置螢幕觀看。</p>
                    <ul class="article__list">
                        <li>適合個人使用</li>
                        <li>輕度追劇上癮</li>
                        <li>$270</li>
                    </ul>
                </div>
            </div>
            <div class="content">
                <div class="article">
                    <h2 class="article__title">標準會員</h2>
                    <p class="article__text">標準方案每個月月費為 NT$ 330 可以收看高畫質 HD 影片，能在 2 個裝置螢幕上觀看。</p>
                    <ul class="article__list">
                        <li>適合經常上網追劇</li>
                        <li>中度追劇上癮</li>
                        <li>$330</li>
                    </ul>
                </div>
            </div>
            <div class="content">
                <div class="article">
                    <h2 class="article__title">高級會員</h2>
                    <p class="article__text">高級方案月費為 NT$ 390 三種，可以收看超高畫質 UltraHD 影片，最多同時能在 4 個裝置螢幕上觀看影片。</p>
                    <ul class="article__list">
                        <li>追劇是人生沒意義</li>
                        <li>重度追劇上癮</li>
                        <li>$390</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
';

        $ck_template = [
            [
                'title' => '特殊視覺',
                'image' => 'template1.png',
                'description' => '特殊視覺樣板',
                'html' => $component1
            ],
            [
                'title' => '文章(置中)',
                'image' => 'template2.png',
                'description' => '文章(置中)樣板',
                'html' => $component2
            ],
            [
                'title'=> '圖文組合',
                'image'=> 'template3.png',
                'description'=> '圖文組合樣板',
                'html'=> $component3
            ],
            [
                'title'=> '輪播',
                'image'=> 'template4.png',
                'description'=> '輪播樣板',
                'html'=> $component4
            ],
            [
                'title'=> '圖片',
                'image'=> 'template5.png',
                'description'=> '圖片樣板',
                'html'=> $component5
            ],
            [
                'title'=> '項目',
                'image'=> 'template6.png',
                'description'=> '項目樣板',
                'html'=> $component6
            ],
        ];

        $user_id = Auth::user()->id;
        if ($user_id === 1) {
            $user_ids = null;
        } else {
            $user_ids = [$user_id, '1'];
        }

        $rows = $this->resourceManagementRepo->getFromUsers($user_ids);
        foreach ($rows as $row) {
            $temp = [
                'title' => $row->title,
                'image' => 'template7.png',
                'description' => '範本文章',
                'html' => $row->content
            ];
            $ck_template[] = $temp;
        }

        return response()->json([
            'code' => 0,
            'message' => 'ok',
            'data' => ['ck_template' => $ck_template],
        ],200);
    }

    /**
     * 刪除
     */
    public function delete(Request $request)
    {
        $itemId = $request->input('itemId');

        $this->pageManagementServ->deleteItem($itemId);

        return response()->json([
            'code' => 0,
            'message' => 'ok',
            'data' => [],
        ],200);
    }

}
