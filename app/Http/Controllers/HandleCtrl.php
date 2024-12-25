<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HandleCtrl extends Controller
{
    /*
    [
        'company' => [
                'jp' => null,
                'th' => null
        ],
        'domestics' => null,
        'internationals' => [],
        'methods' => [],
        'items' => [],
        'services' => [],
        'warehouse' => [],
        'logo' => null
        'detail' => [
            'jp' => null,
            'th' => null],
        'description' => [
            'jp' => null,
            'th' => null],
        'location' => [
            'jp' => null,
            'th' => null,
            'province' => null,
            'district' => null,
            'subdistrict' => null,
            'postcode' => null
        ],
        'phone' => null,
        'email' => null,
        'working_hours' => [
            2 => '08:00 - 17:00',
            3 => '08:00 - 17:00',
            4 => '08:00 - 17:00',
            5 => '08:00 - 17:00',
            6 => '08:00 - 17:00',
        ],
        'facebook' => null,
        'line' => null,
        'website' => null,
        'map' => null,
    ]
    */

    public function handle(Request $request)
    {
        $new = [
            [
                'company' => [
                        'jp' => 'Sutee Group',
                        'th' => 'Sutee Group'
                ],
                'domestics' => 1,
                'internationals' => [],
                'methods' => [1],
                'items' => [4,8],
                'services' => [],
                'warehouse' => [],
                'logo' => 'images/logo_suteegroup.png',
                'detail' => [
                    'jp' => 'Founded as a dished head manufacturer, the Sutee Group has continuously developed our expertise in manufacturing a variety of dished heads for various products, including pressure tanks, oil tanks, LPG tanks and industrial boilers.<br>With our long-term experience in manufacturing category, Sutee Group recognized the importance of logistics system in improving transportation, warehousing and inventory of products. Therefore, we have established 6 affiliate companies to cover all facets of logistics service, Including trucks and trailers, conveyor systems, factory and building designing and fabricating, as well as factory automation systems and robots. Our 6 affiliate companies are.',
                    'th' => 'Founded as a dished head manufacturer, the Sutee Group has continuously developed our expertise in manufacturing a variety of dished heads for various products, including pressure tanks, oil tanks, LPG tanks and industrial boilers.<br>With our long-term experience in manufacturing category, Sutee Group recognized the importance of logistics system in improving transportation, warehousing and inventory of products. Therefore, we have established 6 affiliate companies to cover all facets of logistics service, Including trucks and trailers, conveyor systems, factory and building designing and fabricating, as well as factory automation systems and robots. Our 6 affiliate companies are.'
                ],
                'description' => [
                    'jp' => '45 years of leadership in logistics technology in Southeast Asia 45 years of being a Southeast Asia leader in logistics technology “Sutee Group”',
                    'th' => '45 years of leadership in logistics technology in Southeast Asia 45 years of being a Southeast Asia leader in logistics technology “Sutee Group”'
                ],
                'location' => [
                    'jp' => '27/5 Moo 7 King kaew-Teparak Rd.',
                    'th' => '27/5 หมู่ 7 ถ.กิ่งแก้ว-เทพารักษ์',
                    'province' => 2,
                    'district' => 54,
                    'subdistrict' => 110301,
                    'postcode' => 10540
                ],
                'phone' => '(+66)88-397-7667, (+66)2-751-0900',
                'email' => "thanomsri.w@suteegroup.com, info@suteegroup.com",
                'working_hours' => [
                    2 => '08:00 - 17:00',
                    3 => '08:00 - 17:00',
                    4 => '08:00 - 17:00',
                    5 => '08:00 - 17:00',
                    6 => '08:00 - 17:00',
                    7 => '08:00 - 17:00',
                ],
                'facebook' => null,
                'line' => null,
                'website' => 'www.suteegroup.com/',
                'map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15510.948945829374!2d100.7025622!3d13.6128539!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x5ebcb9f0e2f7493a!2sSutee%20Group!5e0!3m2!1sth!2sth!4v1603881654360!5m2!1sth!2sth" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>',
            ]
        ];


        $into = $this->store($new);
        echo "<pre>";
        print_r($into);
        echo "</pre>";
    }

    function store($data)
    {
        try {
            $insert = [];
            foreach($data as $key => $cp){

                // insert into table : company
                $company = $cp['company'];
                $location = $cp['location'];
                $logo = $cp['logo'];
                $detail = $cp['detail'];            
                $description = $cp['description'];
                $phone = $cp['phone'];
                $email = $cp['email'];
                $facebook = $cp['facebook'];
                $line = $cp['line'];
                $website = $cp['website'];
                $map = $cp['map'];

                $comp = new \App\Models\CompanyMd;
                $comp->name_jp = $company['jp'];
                $comp->name_th = $company['th'];
                $comp->address_jp = $location['jp'];
                $comp->address_th = $location['th'];
                $comp->province = $location['province'];
                $comp->district = $location['district'];
                $comp->subdistrict = $location['subdistrict'];
                $comp->postcode = $location['postcode'];
                $comp->logo = $logo;
                $comp->detail_jp = $detail['jp'];
                $comp->detail_th = $detail['th'];
                $comp->description_jp = $description['jp'];
                $comp->description_th = $description['th'];
                $comp->phone = $phone;
                $comp->email = $email;
                $comp->facebook = $facebook;
                $comp->line = $line;
                $comp->website = $website;
                $comp->gmap = $map;

                if($comp->save()){

                    // insert into table : domestic
                    $domestics = $cp['domestics'];
                    if ($domestics!=null) {
                        $in['dom'] = new \App\Models\Filter\CpDomesticMd;
                        $in['dom']->_id = $comp->id;
                        $in['dom']->transport = $domestics;
                        $in['dom']->save();
                    }
                    
                    // insert into table : international
                    $internationals = $cp['internationals'];
                    if (count($internationals)>0) {
                        foreach ($internationals as $a => $int) {
                            $in['int'] = new \App\Models\Filter\CpInternationalMd;
                            $in['int']->_id = $comp->id;
                            $in['int']->transport = $int;
                            $in['int']->save();
                    }}

                    // insert into table : cp_method
                    $methods = $cp['methods'];
                    if(count($methods)>0){
                        foreach ($methods as $b => $met) {
                            $in['met'][$b] = new \App\Models\Filter\CpMethodMd;
                            $in['met'][$b]->_id = $comp->id;
                            $in['met'][$b]->method = $met;
                            $in['met'][$b]->save();
                    }}

                    // insert into table : cp_item
                    $items = $cp['items'];
                    if(count($items)>0){
                        foreach ($items as $c => $itm) {
                            $in['ite'][$c] = new \App\Models\Filter\CpItemMd;
                            $in['ite'][$c]->_id = $comp->id;
                            $in['ite'][$c]->item = $itm;
                            $in['ite'][$c]->save();
                        }
                    }

                    // insert into table : cp_service
                    $services = $cp['services'];
                    if(count($services)>0){
                        foreach ($services as $d => $ser) {
                            $in['ser'][$d] = new \App\Models\Filter\CpServiceMd;
                            $in['ser'][$d]->_id = $comp->id;
                            $in['ser'][$d]->service = $ser;
                            $in['ser'][$d]->save();
                        }
                    }

                    // insert into table : warehouse
                    $warehouse = $cp['warehouse'];
                    if(count($warehouse)>0){
                        foreach ($warehouse as $e => $war) {
                            $in['war'][$e] = new \App\Models\Filter\CpWarehouseMd;
                            $in['war'][$e]->_id = $comp->id;
                            $in['war'][$e]->warehouse = $war;
                            $in['war'][$e]->save();
                        }
                    }

                    // insert into table : cp_working_hours
                    $working_hours = $cp['working_hours'];
                    if(count($working_hours)>0){
                        foreach ($working_hours as $f => $wor) {
                            $in['wor'][$f] = new \App\Models\Filter\CpWorkingHourMd;
                            $in['wor'][$f]->_id = $comp->id;
                            $in['wor'][$f]->day = $f;
                            $in['wor'][$f]->time = $wor;
                            $in['wor'][$f]->save();
                        }
                    }


                    $insert[$key] = ['status'=>'Data inserted'];

                }else{

                    $insert[$key] = ['status'=>'Failed'];

                }
                
            }
            return $insert;
        } catch(\Illuminate\Database\QueryException $e){
            dd($e->getMessage());
        } catch(\ErrorException $e) {
            dd($e->getMessage());
        }
    }

}