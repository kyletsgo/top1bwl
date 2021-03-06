<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\Backend\UserService;
use Illuminate\Http\Request;
use App\Services\Backend\PageManagementService;
use App\Repository\Backend\PageManagementRepository;
use App\Repository\Backend\SiteManagementRepository;
use App\Repository\Backend\ResourceManagementRepository;
use App\Repository\Backend\CarouselManagementRepository;
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
    protected $carouselManagementRepo;

    public function __construct(PageManagementService $siteManagementService,
                                UserService $userService,
                                PageManagementRepository $pageManagementRepository,
                                SiteManagementRepository $siteManagementRepository,
                                ResourceManagementRepository $resourceManagementRepository,
                                UserRepository $userRepository,
                                ResourceManagementService $resourceManagementService,
                                CarouselManagementRepository $carouselManagementRepository)
    {
        $this->pageManagementServ = $siteManagementService;
        $this->userSv = $userService;
        $this->pageManagementRepo = $pageManagementRepository;
        $this->siteManagementRepo = $siteManagementRepository;
        $this->resourceManagementRepo = $resourceManagementRepository;
        $this->userRepo = $userRepository;
        $this->resourceManagementSv = $resourceManagementService;
        $this->carouselManagementRepo = $carouselManagementRepository;
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
            $row->url = url("/page/$row->folder_name/$row->page_id");

            $subdomain_url = url("/page/$row->page_id");
            $row->subdomain_url = str_replace("www",$row->folder_name,$subdomain_url);
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
        <!-- 圖片 -->
        <div class="images">
            <div class="images__content">
                <img src="https://pt.top1bwl.com/wp-content/uploads/2020/10/cropped-img_9904.jpg" alt="">
            </div>
        </div>
        ';

        $component2 = '
        <!-- 文章(置中) -->
        <div class="note note__center">
            <div class="note__content">
                <div class="content">
                    <h2 class="content__title">效果好，高回購率、容易分享</h2>
                    <p class="content__text">公司研發產品，團隊透過線上、線上，配合完整教育系統，團隊超強優勢，輕鬆建立小團隊。</p>
                </div>
            </div>
        </div>
        ';

        $component3 = '
        <!-- 圖文組合 -->
        <div class="combine combine__half">
            <div class="combine__content">
                <div class="content__img">
                    <img src="https://pt.top1bwl.com/wp-content/uploads/2020/11/img_5812-1-1024x1024.jpg" alt="">
                </div>
                <div class="content__article">
                    <div class="article">
                        <h2 class="article__title">皙之密效果看的到<br/>商機就看得到</h2>
                        <p class="article__text">剛開始用皙之密基礎套組，會擁有代理權，就算不經營也會保留一年，有消費自動續約一年，沒年費、沒月費。</p>
                    </div>
                </div>
            </div>
        </div>
        ';

        $component4 = '
        <!-- 文章列表 -->
        <div class="category">
            <div class="category__content">
                <!-- 文章 -->
                <div class="array">
                    <div class="array__img">
                        <img src="https://pt.top1bwl.com/wp-content/uploads/2020/11/3-1-1.jpg" alt="">
                    </div>
                    <div class="array__content">
                        <p class="array__title">
                            皙之密影片教學
                        </p>
                        <p class="array__date">
                            2020-1-18
                        </p>
                        <p class="array__text">
                        </p>
                        <a class="array__link" href="https://pt.top1bwl.com/blog-p/2084/">READ MORE</a>
                    </div>
                </div>
                <!-- 文章 -->
                <div class="array">
                    <div class="array__img">
                        <img src="https://pt.top1bwl.com/wp-content/uploads/2020/11/S__90038278-1-1.jpg" alt="">
                    </div>
                    <div class="array__content">
                        <p class="array__title">
                            全美世界皙之密保養品不妝真我透亮肌
                        </p>
                        <p class="array__date">
                            2020-1-18
                        </p>
                        <p class="array__text">
                            全美世界皙之密1-9號全部膚質都適用，主打不妝真我，也就是透過好成分，皙之密有效成分滲透到底層建立健康的肌膚，由內而外的自信，透亮象燈泡肌一樣。
                        </p>
                        <a class="array__link" href="https://pt.top1bwl.com/blog-p/2085/">READ MORE</a>
                    </div>
                </div>
                <!-- 文章 -->
                <div class="array">
                    <div class="array__img">
                        <img src="https://pt.top1bwl.com/wp-content/uploads/2020/11/img_5812-1-1024x1024.jpg" alt="">
                    </div>
                    <div class="array__content">
                        <p class="array__title">
                            皙之密不當一斑的女人保養新趨勢妳知道嗎?
                        </p>
                        <p class="array__date">
                            2020-1-18
                        </p>
                        <p class="array__text">
                            全美世界皙之密效果真的這麼好?到底是什麼原理?用了晳之密真的可以素顏?<br> 皙之密為什麼能達到素顏健康美肌, 是因為在深夜都在為你的肌膚在加強健康與更新<br> 當我們進入睡眠時，肌膚也在進行著深層代謝與給養份的工作：生成新的肌膚細胞，代謝老化細胞。因此夜間…….生成新的肌膚細胞，代謝老化細胞。
                            <br> 這是肌膚最需要營養補給的時間
                            <br> 也是抗老化.抗氧化成份發揮作用的時候
                            <br> 每天晚上睡眠時間，透過這些有效的營養成份，給你細胞餵飽飽，不斷的給細胞養份 → 代謝→ 更新 → 淨化<br> 相信你，很快就能達到自然健康的透亮肌膚哦～
                        </p>
                        <a class="array__link" href="https://pt.top1bwl.com/blog-p/2088/">READ MORE</a>
                    </div>
                </div>
                <!-- 文章 -->
                <div class="array">
                    <div class="array__img">
                        <img src="https://pt.top1bwl.com/wp-content/uploads/2020/11/S__90038278-1-1.jpg" alt="">
                    </div>
                    <div class="array__content">
                        <p class="array__title">
                            皙之密產品見證
                        </p>
                        <p class="array__date">
                            2020-1-18
                        </p>
                        <p class="array__text">
                            
                        </p>
                        <a class="array__link" href="https://pt.top1bwl.com/blog-p/2087/">READ MORE</a>
                    </div>
                </div>
                <!-- 文章 -->
                <div class="array">
                    <div class="array__img">
                        <img src="https://pt.top1bwl.com/wp-content/uploads/2020/11/扜芞厙_500437231_wx_痄雄誑薊厙踢⺈扦蝠ㄗ準き珛妀蚚ㄘ.jpg" alt="">
                    </div>
                    <div class="array__content">
                        <p class="array__title">
                            皙之密斜槓教學
                        </p>
                        <p class="array__date">
                            2020-1-18
                        </p>
                        <p class="array__text">
                            全美世界皙之密小教室
                        </p>
                        <a class="array__link" href="https://pt.top1bwl.com/blog-p/2089/">READ MORE</a>
                    </div>
                </div>
                <!-- 文章 -->
                <div class="array">
                    <div class="array__img">
                    <img src="https://pt.top1bwl.com/wp-content/uploads/2020/11/線上購-1.jpg" alt="">
                    </div>
                    <div class="array__content">
                        <p class="array__title">
                            全美世界皙之密非會員線上購
                        </p>
                        <p class="array__date">
                            2020-1-18
                        </p>
                        <p class="array__text">
                            全美世界皙之密非會員線上購物專區。
                        </p>
                        <a class="array__link" href="https://pt.top1bwl.com/blog-p/2092/">READ MORE</a>
                    </div>
                </div>
                <!-- 文章 -->
                <div class="array">
                    <div class="array__img">
                        <img src="https://pt.top1bwl.com/wp-content/uploads/2020/11/img2-1-300x223.png?is-pending-load=1" alt="">
                    </div>
                    <div class="array__content">
                        <p class="array__title">
                            皙之密代理獎金制度
                        </p>
                        <p class="array__date">
                            2020-1-18
                        </p>
                        <p class="array__text">
                        </p>
                        <a class="array__link" href="https://pt.top1bwl.com/blog-p/2091/">READ MORE</a>
                    </div>
                </div>
                <!-- 文章 -->
                <div class="array">
                    <div class="array__img">
                        <img src="https://pt.top1bwl.com/wp-content/uploads/2020/10/投影片32-300x169.jpg?is-pending-load=1" alt="">
                    </div>
                    <div class="array__content">
                        <p class="array__title">
                            全美世界皙之密事業分析
                        </p>
                        <p class="array__date">
                            2020-1-18
                        </p>
                        <p class="array__text">
                                全美世界皙之密事業分析，全美世界皙之密是美的行業，跟傳統創業不太一樣，不用花大錢，小資族就可以創業。
                        </p>
                        <a class="array__link" href="https://pt.top1bwl.com/blog-p/2091/">READ MORE</a>
                    </div>
                </div>
            </div>
        </div>
        ';

        $component5 = '
        <!-- 影片 -->
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
                    <h2 class="content__title">服務項目</h2>
                    <p class="content__text"></p>
                </div>
            </div>
            <div class="item__content">
                <div class="content">
                    <div class="article">
                        <img class="article__img" src="images/icon-04.png" alt="">
                        <h2 class="article__title">外場皙之密品牌分享會</h2>
                        <p class="article__text">簡單輕鬆聊天，大家互相交流，輕鬆得氛圍，讓不習慣去公司的朋友，也喜歡。</p>
                        <!-- <ul class="article__list">
                            <li>適合個人使用</li>
                            <li>輕度追劇上癮</li>
                            <li>$270</li>
                        </ul> -->
                    </div>
                </div>
                <div class="content">
                    <div class="article">
                        <img class="article__img" src="images/icon-03.png" alt="">
                        <h2 class="article__title">創業培訓</h2>
                        <p class="article__text">每個月都有進修課，想進修專業課程都可以報名創訓、皙之密產品課，不會強迫上課。</p>
                        <!-- <ul class="article__list">
                            <li>適合經常上網追劇</li>
                            <li>中度追劇上癮</li>
                            <li>$330</li>
                        </ul> -->
                    </div>
                </div>
                <div class="content">
                    <div class="article">
                        <img class="article__img" src="images/icon-02.png" alt="">
                        <h2 class="article__title">網路陌生人脈的建立</h2>
                        <p class="article__text">輕鬆分享自己的故事，建立個人品牌，透過網路建立陌生人脈，輕鬆打造小團隊、大生意，開分店快速建立被動收入，每月都有網路課程傳授。</p>
                    </div>
                </div>
            </div>
        </div>
        ';

        $ck_template = [
            [
                'title' => '圖片',
                'image' => 'template1.png',
                'description' => '預設模組',
                'html' => $component1
            ],
            [
                'title' => '文章(置中)',
                'image' => 'template2.png',
                'description' => '預設模組',
                'html' => $component2
            ],
            [
                'title'=> '圖文組合',
                'image'=> 'template3.png',
                'description'=> '預設模組',
                'html'=> $component3
            ],
            [
                'title'=> '文章列表',
                'image'=> 'template4.png',
                'description'=> '預設模組',
                'html'=> $component4
            ],
            [
                'title'=> '影片',
                'image'=> 'template5.png',
                'description'=> '預設模組',
                'html'=> $component5
            ],
            [
                'title'=> '項目',
                'image'=> 'template6.png',
                'description'=> '預設模組',
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
                'description' => '文章範本',
                'html' => $row->content
            ];
            $ck_template[] = $temp;
        }

        $carousel_rows = $this->carouselManagementRepo->getByUserId($user_id);
        foreach ($carousel_rows as $row) {
            $content = $row->content;
            $contentObj = json_decode($content);

            $img_htmls = '<div class="carousel">
                            <div class="carousel__content">
                                <div class="swiper-container carousel__normal">
                                    <div class="swiper-wrapper">';
            foreach ($contentObj as $item) {
                $img_html = '<div class="swiper-slide">
                                <img src="'.$item->img_url.'" alt="">
                                <div class="carousel__text">
                                    '.$item->title.'
                                </div>
                            </div>';

                $img_htmls .= $img_html;
            }

            $img_htmls .= '</div>
                            <div class="swiper-button-next swiper-button-next1"></div>
                            <div class="swiper-button-prev swiper-button-prev2"></div>
                        </div>
                    </div>
                </div>';

            $temp = [
                'title' => $row->title,
                'image' => 'template7.png',
                'description' => '輪播模組',
                'html' => $img_htmls
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
