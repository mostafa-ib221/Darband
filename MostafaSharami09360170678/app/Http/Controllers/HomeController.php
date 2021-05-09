<?php

namespace App\Http\Controllers;

use App\Catering;
use App\Library\Mobile_Detect;
use App\Models\About;
use App\Models\Contact;
use App\Models\Dish;
use App\Models\Extra;
use App\Models\News;
use App\Models\OpenTime;
use App\Models\Option;
use App\Models\Order;
//use Cartalyst\Stripe\Stripe;
use App\Models\Setting;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Http\Request;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $data['contacts'] = Contact::getAllInArray();
        return view('content.home.index', $data);
    }

    public function explore(Request $request) {
        $data['title'] = 'Explore';
        $data['contacts'] = Contact::getAllInArray();
        //return $data['contacts'];
        $data['abouts'] = About::getAllInArray();
        $data['dishes'] = Dish::Both(['extend' => 'Explore']);
        $data['options'] = Option::getAll();
        $basket = $request->session()->get('basket');
        $opt = false;
        if(isset($basket['options']['items'])) $opt = count($basket['options']['items']) > 0;
        foreach($data['options'] as &$option) {
            if($opt && isset($basket['options']['items'][$option->id])) {
                $option->inBasket = $basket['options']['items'][$option->id]['no'];
            } else $option->inBasket = 0;
        }
        foreach($data['dishes']['populars'] as &$popular) {
            //return $popular;
            foreach ($popular->extras as &$extra) {
                $extra->inBasket = 0;
                if(isset($basket['items'][$popular->id])) {
                    if (count($basket['items'][$popular->id]['extra'])) {
                        if (isset($basket['items'][$popular->id]['extra']['items'][$extra->id])) {
                            $extra->inBasket = $basket['items'][$popular->id]['extra']['items'][$extra->id]['no'];
                        }
                    }
                }
            }
        }
        $data['News'] = News::orderBy('updated_at', 'desc')->take(10)->get();
        //return $data['News'];
        return view('content.home.explore', $data);
    }

    public function MenuShow() {
        $detect = new Mobile_Detect();
        $data['isPc'] = !($detect->isMobile() || $detect->isTablet());
        $data['title'] = 'Menu';
        $data['contacts'] = Contact::getAllInArray();
        $data['others'] = Dish::getOtherByCat();
        return view('content.home.menu', $data);
    }
    public function OrderShow(Request $request) {
        $detect = new Mobile_Detect();
        $data['isPc'] = !($detect->isMobile() || $detect->isTablet());
        $data['title'] = 'Order Kale Pach';
        $data['contacts'] = Contact::getAllInArray();
        $data['populars'] = Dish::Popular(8, 'sell');
        $basket = $request->session()->get('basket');
        $data['kps'] = Dish::Popular();
        foreach($data['kps'] as &$kp) {
            //return $kp;
            foreach ($kp->extras as &$extra) {
                $extra->inBasket = 0;
                if(isset($basket['items'][$kp->id])) {
                    if (count($basket['items'][$kp->id]['extra'])) {
                        if (isset($basket['items'][$kp->id]['extra']['items'][$extra->id])) {
                            $extra->inBasket = $basket['items'][$kp->id]['extra']['items'][$extra->id]['no'];
                        }
                    }
                }
            }
        }
        //return $data['populars'];
        $data['options'] = Option::getAll();
        $opt = false;
        if(isset($basket['options']['items'])) $opt = count($basket['options']['items']) > 0;
        foreach($data['options'] as &$option) {
            if($opt && isset($basket['options']['items'][$option->id])) {
                $option->inBasket = $basket['options']['items'][$option->id]['no'];
            } else $option->inBasket = 0;
        }
        //$data['others'] = Dish::getOtherByCat();
        //return $data['others'];
        //return [$basket, count($basket['options']['items']), $data['options']];
        //return $data;
        return view('content.home.order', $data);
    }


    public function CheckoutShow(Request $request) {
        $data['basket'] = $request->session()->get('basket');
        //return $data['basket'];
        $data['goToOrder'] = false;
        /*if(empty($data['basket'])) return redirect()->to('order');
        if($data['basket']['priceAll'] == 0) return redirect()->to('order');
        if(count($data['basket']['items']) == 0) return redirect()->to('order');*/
        try {
            if(empty($data['basket'])) $data['goToOrder'] = true;
            elseif(isset($data['basket']['priceAll']) && ($data['basket']['priceAll'] == 0)) $data['goToOrder'] = true;
            elseif (count($data['basket']['items']) == 0) $data['goToOrder'] = true;
        } catch(\ErrorException $e) {$data['goToOrder'] = true;}
        if($data['goToOrder']) {
            $data['basket'] = [
                'items' => [],
                'options' => [
                    'items' => [],
                    'priceAll' => 0,
                    'no' => 0

                ],
                'priceAll' => 0,
                'comment' => '',
                'no' => 0,
                'delivery_fee' => 0
            ];
            $request->session()->put('basket', $data['basket']);
        }
        //return $data['basket'];
        $data['headerBlack'] = true;
        $data['checkout'] = true;
        $data['title'] = 'Checkout';
        $data['contacts'] = Contact::getAllInArray();
        $data['options'] = Option::getAll();
        $opt = false;
        if(isset($data['basket']['options']['items'])) $opt = count($data['basket']['options']['items']) > 0;
        foreach($data['options'] as &$option) {
            if($opt && isset($data['basket']['options']['items'][$option->id])) {
                $option->inBasket = $data['basket']['options']['items'][$option->id]['no'];
            } else $option->inBasket = 0;
        }
        $data['open'] = OpenTime::getFreeTimes();//get valid open times
        $jqDaysId = ['Sun'=>0, 'Mon'=>1, 'Tue'=>2, 'Wed'=>3, 'Thu'=>4, 'Fri'=>5, 'Sat'=>6];
        $data['daysSelectedId'] = [];
        foreach($data['open']->days as $day) $data['daysSelectedId'][] = $jqDaysId[$day];
        $data['daysSelectedId'] = implode(', ', $data['daysSelectedId']);
        //return $data['open'];

        if($data['basket']['priceAll'] > 0) {
            $df = Setting::get('delivery_fee');
            //$data['basket']['delivery_fee'] = ($data['basket']['priceAll'] < $df->price) ? $df->delivery_fee : 0;
            if (($data['basket']['priceAll'] < $df->price)) {
                if ($data['basket']['delivery_fee'] == 0) {
                    $data['basket']['priceAll'] += $df->delivery_fee;
                }
                $data['basket']['delivery_fee'] = $df->delivery_fee;
            } else {
                if ($data['basket']['delivery_fee'] > 0) {
                    $data['basket']['priceAll'] -= $df->delivery_fee;
                }
                $data['basket']['delivery_fee'] = 0;
            }
            $request->session()->put('basket', $data['basket']);
        }

        //return $data['basket'];
        //return $data;
        return view('content.home.checkout', $data);
    }
    public function CheckoutSave(Request $request) {
        //return $request->all();
        $basket = $request->session()->get('basket');
        $basket['comment'] = $request->comment == null ? '' : $request->comment;
        $delivery_info = $request->except(['_token', 'date', 'time', 'pay_type', 'comment']);
        $order = new Order();
        $order->code = md5(time());
        $order->order = json_encode($basket);
        $order->date_time = $request->date . ' , ' . $request->time;
        $order->address = json_encode($delivery_info);
        $order->pey_type = $request->pay_type;
        //$order->pey_status = 0;
        $order->order_no = Order::MackNo();
        //return $order;
        $order->save();
        if(isset($order->id)) {
            $request->session()->put('basket', []);
            if($order->pey_type == 'cash')
                return redirect()->to(url('confirmation/' . $order->order_no));
            return redirect()->to(url('payment/details/' . $order->order_no));
        } return redirect()->back()->with('error' , 'can\'t save your order. Please try again');
    }


    public function PaymentDetails($order_no) {
        $data['headerBlack'] = true;
        $data['title'] = 'Payment Details';
        $data['contacts'] = Contact::getAllInArray();
        $data['order'] = Order::getByOrderNo($order_no);
        if(empty($data['order'])) return redirect()->to(url('order'));
        //return $data['order'];
        return view('content.home.payment_details', $data);
    }
    public function PaymentDetailsPay(Request $request, $order_no) {
        //return $request->all();
        try {
            $order = Order::getByOrderNo($order_no);
            //return [gettype($orderArray), $orderArray];
            //return [gettype($order->order), gettype($order->address)];
            if(!$order->amIValid()) return redirect()->to(url('order'));
            //return [Order::isValidOrder($order), $order->amIValid(), gettype($order->order->priceAll), $order, $request->all()];
            $charge = Stripe::charges()->create([
                'amount' => $order->order->priceAll,// * 100,
                'currency' => 'CAD',
                'source' => $request->stripeToken,
                'description' => 'Order',
                //'receipt_email' => '',
                'metadata' => [
                    //'order' => $order->order,
                    'order' => json_encode($order->order),
                    'order_no' => $order->order_no,
                    //'type' => 'without Multiplication 100'
                    //'type' => 'without Division 100'
                    'type' => 'without Division or Multiplication'
                ]

            ]);
            /*$order->pey_status = $charge['id'];
            $order->save();*/
            //$order->update(['pey_status' => $charge['id']]);
            Order::UpdatePeyStatus($order, $charge['id']);
            return redirect()->to(url('confirmation/' . $order->order_no));
            return $charge;
        } catch (\Exception $e) {
            //return $e;
            return Back();
        }
    }

    public function Confirmation($order_no) {
        $data['headerBlack'] = true;
        $data['title'] = 'Order Confirmation';
        $data['contacts'] = Contact::getAllInArray();
        $data['order_no'] = Order::getOrderNo($order_no);
        if($data['order_no'] == 'order') return redirect()->to(url('order'));
        elseif($data['order_no'] == '/payment/details/') return redirect()->to(url('/payment/details/'.$order_no));
        return view('content.home.confirmation', $data);
    }

    public function CateringShow() {
        //$data['headerBlack'] = true;
        $data['title'] = 'Catering / Contact Us';
        $data['contacts'] = Contact::getAllInArray();
        return view('content.home.catering', $data);
    }
    public function CateringSave(Request $request) {
        $catering = Catering::create($request->all());
        return redirect()->to(url('catering?' . (isset($catering->id) ? 'ok' : 'no')));
    }


    public function BasketSet(Request $request) {}
    public function BasketAdd(Request $request) {
        //return $request->all();
        $plus = isset($request->plus) ? $request->plus : 1;
        $basket = $request->session()->get('basket');
        if(isset($basket['items'][$request->id])) {
            $basket['items'][$request->id]['no'] += $plus;
            $basket['items'][$request->id]['priceAll'] += $basket['items'][$request->id]['price'] * $plus;
            $basket['priceAll'] += $basket['items'][$request->id]['price'] * $plus;
            $basket['no'] += $plus;
        } else {
            $kp = Dish::find($request->id);
            if(!empty($kp)) {
                //return [$basket, $kp];
                if($basket != null) {
                    $basket['items'][$request->id] = [
                        'name' => $kp->title,
                        'price' => $kp->price * $plus,
                        'pic' => url(STORAGE_PATH . Dish::$PicDir) . '/' . $kp->pic,
                        'no' => $plus,
                        'extra' => [],
                        'priceAll' => $kp->price * $plus,
                    ];
                    $basket['priceAll'] += $kp->price * $plus;
                    $basket['no'] += $plus;
                } else {
                    $basket = [
                        'items' => [
                            $request->id => [
                                'name' => $kp->title,
                                'price' => $kp->price * $plus,
                                'pic' => url(STORAGE_PATH . Dish::$PicDir) . '/' . $kp->pic,
                                'no' => $plus,
                                'extra' => [],
                                'priceAll' => $kp->price * $plus,
                            ],
                        ],
                        'options' => [
                            'items' => [],
                            'priceAll' => 0,
                            'no' => 0

                        ],
                        'priceAll' => $kp->price * $plus,
                        'comment' => '',
                        'no' => $plus,
                        'delivery_fee' => 0
                    ];
                }
            } else return ['status'=>false, 'massage'=>'Kale Pache not found', 'data' => []];
        }
        $request->session()->put('basket', $basket);
        return [
            'status' => true,
            'massage' => 'Kale Pache is set',
            'data' => [
                'receive' => $request->all(),
                'basket' => $request->session()->get('basket'),
                'no' => $basket['items'][$request->id]['no']
            ]
        ];
    }
    public function BasketMinus(Request $request) {
        $basket = $request->session()->get('basket');
        if($basket == null) return ['status' => false, 'massage' => 'basket is empty', 'data' => []];
        if(!isset($basket['items'][$request->id])) return [
            'status' => false,
            'massage' => 'Kale Pache not in basket',
            'data' => [
                'receive' => $request->all(),
                'basket' => $request->session()->get('basket'),
                'no' => 0
            ]
        ];

        $kp = Dish::find($request->id);
        if(empty($kp)) return [
            'status'=>false,
            'massage'=>'Kale Pache not found',
            'data' => [
                'receive' => $request->all(),
                'basket' => $request->session()->get('basket'),
                'no' => 0
            ]];


        $no = 0;
        $minus = isset($request->minus) ? $request->minus : 1;
        if($basket['items'][$request->id]['no'] < $minus+1) {
            $basket['priceAll'] -= $kp->price * $minus;
            $basket['no'] -= $minus;
            unset($basket['items'][$request->id]);
        } else {
            $basket['items'][$request->id]['no'] -= $minus;
            $basket['items'][$request->id]['priceAll'] -= $kp->price * $minus;
            $basket['priceAll'] -= $kp->price * $minus;
            $basket['no'] -= $minus;
            $no = $basket['items'][$request->id]['no'];
        }
        $request->session()->put('basket', $basket);

        return [
            'status' => true,
            'massage' => 'Kale Pache is set',
            'data' => [
                'receive' => $request->all(),
                'basket' => $request->session()->get('basket'),
                'no' => $no
            ]
        ];
    }
    public function BasketGet(Request $request) {
        return [
            'status' => true,
            'massage' => 'get all basket',
            'data' => $request->session()->get('basket')
        ];
    }
    public function BasketOptions(Request $request) {
        $plus = isset($request->plus) ? $request->plus : 1;
        $basket = $request->session()->get('basket');

        $opt = Option::get($request->id);
        if(empty($opt)) return [
            'status'=>false,
            'massage'=>'Option not found',
            'data' => [
                'receive' => $request->all(),
                'basket' => $basket,
                'no' => 0
            ]];
        //return [$opt, $request->all()];

        if(isset($basket['options'])) {
            if(isset($basket['options']['items'][$request->id])) {
                $basket['options']['items'][$request->id]['no'] += $plus;
                $basket['options']['items'][$request->id]['priceAll'] += $opt->price * $plus;
                $basket['options']['no'] += $plus;
                $basket['options']['priceAll'] += $opt->price * $plus;
                $basket['no'] += $plus;
                $basket['priceAll'] += $opt->price * $plus;
            } else {
                $basket['options']['items'][$request->id] = [
                    'name' => $opt->title,
                    'pic' => ($opt->pic != '') ? $opt->pic : asset('home/img/options.png'),
                    'price' => $opt->price,
                    'priceAll' => $opt->price * $plus,
                    'no' => $plus,
                ];
                $basket['options']['no'] += $plus;
                $basket['options']['priceAll'] += $opt->price * $plus;
                $basket['no'] += $plus;
                $basket['priceAll'] += $opt->price * $plus;
            }
        } else {
            $basket = [
                'items' => [],
                'options' => [
                    'items' => [
                        $request->id => [
                            'name' => $opt->title,
                            'pic' => ($opt->pic != '') ? $opt->pic : asset('home/img/options.png'),
                            'price' => $opt->price,
                            'priceAll' => $opt->price * $plus,
                            'no' => $plus,
                        ]
                    ],
                    'priceAll' => $opt->price * $plus,
                    'no' => $plus

                ],
                'priceAll' => $opt->price * $plus,
                'comment' => '',
                'no' => $plus,
                'delivery_fee' => 0
            ];
        }
        $request->session()->put('basket', $basket);
        return [
            'status' => true,
            'massage' => 'Option is set',
            'data' => [
                'receive' => $request->all(),
                'basket' => $request->session()->get('basket'),
                'no' => $basket['options']['items'][$request->id]['no']
            ]
        ];
    }
    public function BasketExtras(Request $request) {
        //return $request->all();
        $plus = isset($request->plus) ? $request->plus : 1;
        $endNo = 0;
        $basket = $request->session()->get('basket');

        $kp = Dish::where('id', $request->kpId)->with(['Extras'])->first();
        if(empty($kp)) return [
            'status'=>false,
            'massage'=>'Kale Pache not found',
            'data' => [
                'receive' => $request->all(),
                'basket' => $basket,
                'no' => 0
            ]];
        $ext = null;
        foreach($kp->extras as $extra) {
            if($extra->id == $request->eId) {
                $ext = $extra;
                break;
            }
        }
        if(empty($ext)) return [
            'status'=>false,
            'massage'=>'Extra not found',
            'data' => [
                'receive' => $request->all(),
                'basket' => $basket,
                'no' => 0
            ]];
        //return ['res'=>$request->all(), 'basket'=>$basket, 'kp'=>$kp, 'ext'=>$ext];
        if(isset($basket['items'])) {
            if(isset($basket['items'][$request->kpId])) {
                if(isset($basket['items'][$request->kpId]['extra']['items'][$request->eId])) {
                    //return 'Line 367';
                    $basketOld = $basket;
                    //return 'Line 369';
                    $basket['items'][$request->kpId]['extra']['items'][$request->eId]['priceAll'] += $ext->price * $plus;
                    //return 'Line 371';
                    $basket['items'][$request->kpId]['extra']['items'][$request->eId]['no'] += $plus;
                    //return 'Line 373';
                    $endNo = $basket['items'][$request->kpId]['extra']['items'][$request->eId]['no'];
                    //return 'Line 375';
                    if(!isset($basket['items'][$request->kpId]['extra']['priceAll'])) $basket['items'][$request->kpId]['extra']['priceAll'] = 0;
                    $basket['items'][$request->kpId]['extra']['priceAll'] += $ext->price * $plus;
                    //return 'Line 377';
                    if(!isset($basket['items'][$request->kpId]['extra']['no'])) $basket['items'][$request->kpId]['extra']['no'] = 0;
                    $basket['items'][$request->kpId]['extra']['no'] += $plus;
                    //return 'Line 379';
                    //$basket += $ext->price * $plus;
                    //return 'Line 381';
                    $basket['priceAll'] += $ext->price * $plus;
                    //return 'Line 383';
                } else {
                    $basket['items'][$request->kpId]['extra']['items'][$request->eId] = [
                        'name' => $ext->title,
                        'pic' => asset('home/img/extras.png'),
                        'price' => $ext->price,
                        'priceAll' => $ext->price * $plus,
                        'no' => $plus,
                    ];
                    $endNo = $plus;
                    if(!isset($basket['items'][$request->kpId]['extra']['priceAll'])) $basket['items'][$request->kpId]['extra']['priceAll'] = 0;
                    $basket['items'][$request->kpId]['extra']['priceAll'] += $ext->price * $plus;
                    if(!isset($basket['items'][$request->kpId]['extra']['no'])) $basket['items'][$request->kpId]['extra']['no'] = 0;
                    $basket['items'][$request->kpId]['extra']['no'] += $plus;
                    $basket['items'][$request->kpId]['priceAll'] += $ext->price * $plus;
                    $basket['priceAll'] += $ext->price * $plus;
                }
            } else {
                //return 'Line 337';
                $basket['items'][$request->kpId] = [
                    'name' => $kp->title,
                    'price' => $kp->price,
                    'pic' => url(STORAGE_PATH . Dish::$PicDir) . '/' . $kp->pic,
                    'extra' => [
                        'items' => [
                            $request->eId => [
                                'name' => $ext->title,
                                'pic' => asset('home/img/extras.png'),
                                'price' => $ext->price,
                                'priceAll' => $ext->price * $plus,
                                'no' => $plus,
                            ],
                        ],
                        'priceAll' => $ext->price * $plus,
                        'no' => $plus
                    ],
                    'priceAll' => $kp->price + ($ext->price * $plus),
                    'no' => 1,
                ];
                $basket['priceAll'] += $kp->price + ($ext->price * $plus);
                $basket['no']++;
                $endNo = $plus;
            }
        } else {
            //return 'Line 362';
            $basket = [
                'items' => [
                    $request->kpId => [
                        'name' => $kp->title,
                        'price' => $kp->price,
                        'pic' => url(STORAGE_PATH . Dish::$PicDir) . '/' . $kp->pic,
                        'extra' => [
                            'items' => [
                                $request->eId => [
                                    'name' => $ext->title,
                                    'pic' => asset('home/img/extras.png'),
                                    'price' => $ext->price,
                                    'priceAll' => $ext->price * $plus,
                                    'no' => $plus,
                                ],
                            ],
                            'priceAll' => $ext->price * $plus,
                            'no' => $plus
                        ],
                        'priceAll' => $kp->price + ($ext->price * $plus),
                        'no' => 1,
                    ],
                ],
                'options' => [
                    'items' => [],
                    'priceAll' => 0,
                    'no' => 0

                ],
                'priceAll' => $kp->price + ($ext->price * $plus),
                'comment' => '',
                'no' => 1,
                'delivery_fee' => 0
            ];
            $endNo = $plus;
        }
        //return 'Line 456';

        $request->session()->put('basket', $basket);
        return [
            'status' => true,
            'massage' => 'Extra is set',
            'data' => [
                'receive' => $request->all(),
                'basket' => $request->session()->get('basket'),
                'no' => $endNo
            ]
        ];
    }
    public function BasketComment(Request $request) {
        $basket = $request->session()->get('basket');
        //return [$basket['comment'], isset($basket['items']), $basket];
        if(isset($basket['items'])) {
            //return 'Line: 484';
            //$basket['comment'] = $request->comment;
            $basket['comment'] = $request->comment == null ? '' : $request->comment;
        } else {
            //return 'Line: 487';
            $basket = [
                'items' => [],
                'options' => [
                    'items' => [],
                    'priceAll' => 0,
                    'no' => 0

                ],
                'priceAll' => 0,
                'comment' => $request->comment,
                'no' => 0,
                'delivery_fee' => 0
            ];
        }

        $request->session()->put('basket', $basket);
        return [
            'status' => true,
            'massage' => 'Comment is set',
            'data' => [
                'receive' => $request->all(),
                'basket' => $request->session()->get('basket'),
                'no' => 0
            ]
        ];
    }
    public function BasketUpdate(Request $request) {}
    public function BasketDel(Request $request) {
        //return $request->all();
        //return [explode('_', $request->id), strpos($request->id, 'opt')];
        $basket = $request->session()->get('basket');
        if($basket == null) return ['status' => false, 'massage' => 'basket is empty', 'data' => []];

        if(strpos($request->id, 'opt') === false) {
            if (isset($request->id)) {
                if (!isset($basket['items'][$request->id])) return [
                    'status' => false,
                    'massage' => 'Kale Pache not in basket',
                    'data' => [
                        'receive' => $request->all(),
                        'basket' => $basket,
                        'no' => 0
                    ]
                ];

                $basket['priceAll'] -= $basket['items'][$request->id]['priceAll'];
                $basket['no'] -= $basket['items'][$request->id]['no'];
                unset($basket['items'][$request->id]);
                $request->session()->put('basket', $basket);
                $basket = $request->session()->get('basket');
                return [
                    'status' => true,
                    'massage' => 'item removed from basket',
                    'data' => [
                        'receive' => $request->all(),
                        'basket' => $basket,
                        'no' => $basket['no']
                    ]
                ];
            } else {
                $request->session()->forget('basket');
                return [
                    'status' => true,
                    'massage' => 'basket is clear',
                    'data' => [
                        'receive' => $request->all(),
                        'basket' => [],
                        'no' => 0
                    ]
                ];
            }
        } else {
            $opt = explode('_', $request->id)[0];
            if(!isset($basket['options']['items'][$opt])) return [
                'status' => false,
                'massage' => 'Option not in basket',
                'data' => [
                    'receive' => $request->all(),
                    'basket' => $basket,
                    'no' => 0,
                    '$opt' => $opt
                ]
            ];

            $price = $basket['options']['items'][$opt]['priceAll'];
            $no = $basket['options']['items'][$opt]['no'];
            unset($basket['options']['items'][$opt]);
            $basket['options']['priceAll'] -= $price;
            $basket['options']['no'] -= $no;
            $basket['priceAll'] -= $price;
            $basket['no'] -= $no;
            $request->session()->put('basket', $basket);

            return [
                'status' => true,
                'massage' => 'Option deleted',
                'data' => [
                    'receive' => $request->all(),
                    'basket' => $request->session()->get('basket'),
                    'no' => 0
                ]
            ];
        }
    }
    public function BasketClear(Request $request) {}
}
