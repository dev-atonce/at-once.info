<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class CenterCtrl extends Controller
{
    public function __construct()
    {
        $this->prefix = 'front-end';
        $this->category = request()->segment(2);
    }
    public function categoryId()
    {
        $data = \App\Models\CategoryMd::where('key',$this->category)->first();
        if (@$data->id) return $data->id;
    }
    public function categoryName()
    {
        $lang = Session('lang');
        $data = \App\Models\CategoryMd::select("name_$lang as name")->where('key',$this->category)->first();
        if (@$data->name) return $data->name;
    }
    public function index(Request $request)
    {
        // try {

            $lang = Session('lang');
            $data = $this->CompanyData($request);

            return view("$this->prefix.layout.index",[
                'prefix' => $this->prefix,
                'module' => $this->category,
                'categoryName' => $this->categoryName(),
                'lang' => $lang,
                'company' => $data['rows'],
                'filter' => $this->filterOfCategory(),
                'online' => $data['online'],
                'expanded' => $data['expanded'],
                'aboutThis' => $data['aboutThis'],
                'sponsor' => \App\Http\Controllers\SponsorCtrl::__blank(),
                'category' => \App\Http\Controllers\CategoryCtrl::_index(),
                'categoryId' => $this->categoryId(),
                'blogs' => \App\Http\Controllers\BlogCtrl::inMainpage($type=$this->categoryId(),$limit=12),
                'blogs_company' => \App\Http\Controllers\BlogCtrl::inMainPageCompany($type=$this->categoryId(),$limit=12),
                'seo' => \App\Helpers\SeoLandingPage::getCategorySeoKeyword($this->categoryId())
            ]);

        // }catch(\Illuminate\Database\QueryException $e){
        //     dd($e->getMessage());
        // }catch(\ErrorException $e){
        //     dd($e->getMessage());
        // }
    }

    public function CompanyData($request)
    {
        $category = request()->segment(2);

        $online = 0;
        $aboutThis = "";
        switch ($category) {
            case 'electrical-appliance': // 1.1.1 = 1
                $data = \App\Http\Controllers\Category\ElectricalApplianceCtrl::index($request);
                break;
            case 'office-appliance': // 1.1.2 = 2
                $data = \App\Http\Controllers\Category\OfficeApplianceCtrl::index($request);
                break;
            case 'home-appliance': // 1.1.3 = 3
                $data = \App\Http\Controllers\Category\HomeApplianceCtrl::index($request);
                break;
            case 'ceremony-appliance': // 1.1.4 = 4
                $data = \App\Http\Controllers\Category\CeremonyApplianceCtrl::index($request);
                break;
            case 'baby-appliance': // 1.1.5 = 5
                $data = \App\Http\Controllers\Category\BabyApplianceCtrl::index($request);
                break;
            case 'home-decoration': // 1.1.6 = 6
                $data = \App\Http\Controllers\Category\HomeDecorationCtrl::index($request);
                break;
            case 'costume-and-beauty':  // 1.1.7 = 7
                $data = \App\Http\Controllers\Category\CustomeBeautyCtrl::index($request);
                break;
            case 'automotive-spareparts': // 1.1.8 = 8
                $data = \App\Http\Controllers\Category\AutomotiveSparepartsCtrl::index($request);
                break;
            case 'music-audio': // 1.1.9 = 9
                $data = \App\Http\Controllers\Category\MusicAudioCtrl::index($request);
                break;
            case 'sport': // 1.1.10 = 10
                $data = \App\Http\Controllers\Category\SportCtrl::index($request);
                break;
            case 'construction-materials': // 1.1.11 = 11
                $data = \App\Http\Controllers\Category\ConstructionMaterialsCtrl::index($request);
                break;
            case 'chemicals': // 1.1.12 = 12
                $data = \App\Http\Controllers\Category\ChemicalsCtrl::index($request);
                break;
            case 'packaging': // 1.1.13 = 13
                $data = \App\Http\Controllers\Category\PackagingCtrl::index($request);
                break;
            case 'other-product': // 1.1.14 = 14
                $data = \App\Http\Controllers\Category\OtherProductCtrl::index($request);
                break;
            case 'food': // 1.2.1 = 15
                $data = \App\Http\Controllers\Category\FoodCtrl::index($request);
                break;
            case 'drinks':  // 1.2.2 = 16
                $data = \App\Http\Controllers\Category\DrinksCtrl::index($request);
                break;
            case 'factory-equipment': // 1.3.1 = 17
                $data = \App\Http\Controllers\Category\FactoryEquipmentCtrl::index($request);
                break;
            case 'hand-tool': // 1.3.2 = 18
                $data = \App\Http\Controllers\Category\HandToolCtrl::index($request);
                break;
            case 'machine-parts': // 1.3.3 = 19
                $data = \App\Http\Controllers\Category\MachinePartsCtrl::index($request);
                break;
            case 'medicines': // 1.4.1 = 20
                $data = \App\Http\Controllers\Category\MedicinesCtrl::index($request);
                break;
            case 'medical-equipment': // 1.4.2 = 21
                $data = \App\Http\Controllers\Category\MedicalEquipmentCtrl::index($request);
                break;
            case 'visa-support': // 1.5.1 = 22
                $data = \App\Http\Controllers\Category\VisaCtrl::index($request);
                break;
            case 'company-register': // 1.5.2 = 23
                $data = \App\Http\Controllers\Category\CompanyRegisterCtrl::index($request);
                break;
            case 'law-firm': // 1.5.3 = 24
                $data = \App\Http\Controllers\Category\LawFirmCtrl::index($request);
                break;
            case 'space-for-rent': // 1.5.4 = 25
                $data = \App\Http\Controllers\Category\SpaceForRentCtrl::index($request);
                break;
            case 'consultant':// 1.5.5 = 26
                $data = \App\Http\Controllers\Category\ConsultantCtrl::index($request);
                break;
            case 'translater': // 1.5.6 = 27
                $data = \App\Http\Controllers\Category\TranslateCtrl::index($request);
                break;
            case 'accounting': // 1.5.7 = 28
                $data = \App\Http\Controllers\Category\AccountingCtrl::index($request);
                break;
            case 'prefabricated-office': // 1.5.8 = 29
                $data = \App\Http\Controllers\Category\PrefabricateOfficeCtrl::index($request);
                break;
            case 'logistics': // 1.6.1 = 30
                $data = \App\Http\Controllers\Category\LogisticsCtrl::index($request);
                $aboutThis = $this->prefix.".category.$category.AboutThis";
                break;
            case 'warehouse': // 1.6.2 = 31
                $data = \App\Http\Controllers\Category\WarehouseCtrl::index($request);
                break;
            case 'forklift': // 1.6.3 = 32
                $data = \App\Http\Controllers\Category\ForkliftCtrl::index($request);
                break;
            case 'heavy-machinery': // 1.6.4 = 33
                $data = \App\Http\Controllers\Category\HeavyMachineryCtrl::index($request);
                break;
            case 'transportation-warehouse-equipment': // 1.6.5 = 34
                $data = \App\Http\Controllers\Category\TransportEquipmentCtrl::index($request);
                break;
            case 'credit-loan': // 1.7.1 = 35
                $data = \App\Http\Controllers\Category\CreditLoanCtrl::index($request);
                break;
            case 'insurance': // 1.7.2 = 36
                $data = \App\Http\Controllers\Category\InsuranceCtrl::index($request);
                break;
            case 'financial': // 1.7.3 = 37
                $data = \App\Http\Controllers\Category\FinancialCtrl::index($request);
                break;
            case 'online-marketing': // 1.8.1 = 38
                $data = \App\Http\Controllers\Category\OnlineMarketingCtrl::index($request);
                break;
            case 'it-hardware': // 1.8.2 = 39
                $data = \App\Http\Controllers\Category\ItCtrl::index($request);
                break;
            case 'web-system': // 1.8.3 = 40
                $data = \App\Http\Controllers\Category\WebSystemCtrl::index($request);
                break;
            case 'software-development': // 1.8.4 = 41
                $data = \App\Http\Controllers\Category\SoftwareDevelopmentCtrl::index($request);
                break;
            case 'printing': // 1.9.1 = 42
                $data = \App\Http\Controllers\Category\PrintingCtrl::index($request);
                break;
            case 'advertising': // 1.9.2 = 43
                $data = \App\Http\Controllers\Category\AdvertisingCtrl::index($request);
                break;
            case 'car-rental': // 1.10.1 = 44
                $data = \App\Http\Controllers\Category\CarrentCtrl::index($request);
                break;
            case 'public-transportation': // 1.10.2 = 45
                $data = \App\Http\Controllers\Category\PublicTransportCtrl::index($request);
                break;
            case 'security-system': // 1.11.1 = 46
                $data = \App\Http\Controllers\Category\SecuritySystemCtrl::index($request);
                break;
            case 'recruitment': // 1.11.2 = 47
                $data = \App\Http\Controllers\Category\RecruitmentCtrl::index($request);
                break;
            case 'organizer': // 1.12.1 = 48
                $data = \App\Http\Controllers\Category\OrganizerCtrl::index($request);
                break;
            case 'land-survey': // 1.12.2 = 49
                $data = \App\Http\Controllers\Category\LandSurveyCtrl::index($request);
                break;
            case 'gardening': // 1.12.3 = 50
                $data = \App\Http\Controllers\Category\GardeningCtrl::index($request);
                break;
            case 'studio': // 1.12.4 = 51
                $data = \App\Http\Controllers\Category\StudioCtrl::index($request);
                break;
            case 'cleaning': // 1.12.5 = 52
                $data = \App\Http\Controllers\Category\CleaningCtrl::index($request);
                break;
            case 'insecticide': // 1.12.6 = 53
                $data = \App\Http\Controllers\Category\InsecticideCtrl::index($request);
                break;
            case 'other-general': // 1.12.7 = 54
                $data = \App\Http\Controllers\Category\OtherGeneralCtrl::index($request);
                break;
            case 'machinery-repair': // 1.13.1 = 55
                $data = \App\Http\Controllers\Category\MachineryRepairCtrl::index($request);
                break;
            case 'electronics-repair': // 1.13.2 = 56
                $data = \App\Http\Controllers\Category\ElectronicsRepairCtrl::index($request);
                break;
            case 'automotive-repair': // 1.13.3 = 57
                $data = \App\Http\Controllers\Category\AutomotiveRepairCtrl::index($request);
                break;
            case 'textiles-repair': // 1.13.4 = 58
                $data = \App\Http\Controllers\Category\TextilesRepairCtrl::index($request);
                break;
            case 'accessories-repair': // 1.13.5 = 59
                $data = \App\Http\Controllers\Category\AccessoriesRepairCtrl::index($request);
                break;
            case 'watersupply-repair': // 1.13.6 = 60
                $data = \App\Http\Controllers\Category\WaterSupplyRepairCtrl::index($request);
                break;
            case 'furniture-repair': // 1.13.7 = 61
                $data = \App\Http\Controllers\Category\FurnitureRepairCtrl::index($request);
                break;
            case 'machines-for-stamping': // 2.1.1 = 62
                $data = \App\Http\Controllers\Category\MachinesStampingCtrl::index($request);
                break;
            case 'machines-for-folding': // 2.1.2 = 63
                $data = \App\Http\Controllers\Category\MachinesFoldingCtrl::index($request);
                break;
            case 'machines-for-casting': // 2.1.3 = 64
                $data = \App\Http\Controllers\Category\MachinesCastingCtrl::index($request);
                break;
            case 'machines-for-dressing': // 2.1.4 = 65
                $data = \App\Http\Controllers\Category\MachinesDressingCtrl::index($request);
                break;
            case 'machines-for-compression': // 2.1.5 = 66
                $data = \App\Http\Controllers\Category\MachinesCompressionCtrl::index($request);
                break;
            case 'machines-for-rolling': // 2.1.6 = 67
                $data = \App\Http\Controllers\Category\MachinesRollingCtrl::index($request);
                break;
            case 'machines-for-welding': // 2.1.7 = 68
                $data = \App\Http\Controllers\Category\MachinesWeldingCtrl::index($request);
                break;
            case 'other-machinery': // 2.1.8 = 69
                $data = \App\Http\Controllers\Category\OtherMachineryCtrl::index($request);
                break;
            case 'forklift-industry': // 2.2.1 = 70
                $data = \App\Http\Controllers\Category\ForkliftCtrl::index($request);
                break;
            case 'heavy-machinery-industry': // 2.2.2 = 71
                $data = \App\Http\Controllers\Category\HeavyMachineryCtrl::index($request);
                break;
            case 'automotive': // 2.2.3 = 72
                $data = \App\Http\Controllers\Category\AutomotiveCtrl::index($request);
                break;
            case 'mold': // 2.3.1 = 73
                $data = \App\Http\Controllers\Category\MoldCtrl::index($request);
                break;
            case 'machine-tools': // 2.4.1 = 74
                $data = \App\Http\Controllers\Category\MachineToolsCtrl::index($request);
                break;
            case 'measuring-tools': // 2.4.2 = 75
                $data = \App\Http\Controllers\Category\MeasuringToolsCtrl::index($request);
                break;
            case 'hand-tool-industry': // 2.4.3 = 76
                $data = \App\Http\Controllers\Category\HandToolCtrl::index($request);
                break;
            case 'improve-texture': // 2.5.1 = 77
                $data = \App\Http\Controllers\Category\ImproveTextureCtrl::index($request);
                break;
            case 'baby-appliance-industry': // 2.6.1 = 78
                $data = \App\Http\Controllers\Category\BabyApplianceCtrl::index($request);
                break;
            case 'ceremony-appliance-industry': // 2.6.2 = 79
                $data = \App\Http\Controllers\Category\CeremonyApplianceCtrl::index($request);
                break;
            case 'jewelry-beauty-industry': // 2.6.3 = 80
                $data = \App\Http\Controllers\Category\JewelryBeautyCtrl::index($request);
                break;
            case 'kitchen-appliance-industry': // 2.6.4 = 81
                $data = \App\Http\Controllers\Category\KitchenApplianceCtrl::index($request);
                break;
            case 'music-audio-industry': // 2.6.5 = 82
                $data = \App\Http\Controllers\Category\MusicAudioCtrl::index($request);
                break;
            case 'sport-industry': // 2.6.6 = 83
                $data = \App\Http\Controllers\Category\SportCtrl::index($request);
                break;
            case 'foods-industry': // 2.7.1 = 84
                $data = \App\Http\Controllers\Category\FoodCtrl::index($request);
                break;
            case 'drinks-industry': // 2.7.2 = 54
                $data = \App\Http\Controllers\Category\DrinksCtrl::index($request);
                break;
            case 'home-decoration-industry': // 2.8.1 = 86
                $data = \App\Http\Controllers\Category\HomeDecorationCtrl::index($request);
                break;
            case 'office-appliance-industry': // 2.9.1 = 87
                $data = \App\Http\Controllers\Category\OfficeApplianceCtrl::index($request);
                break;
            case 'electric-kitchen-appliance': // 2.10.1 = 88
                $data = \App\Http\Controllers\Category\ElectricKitchenCtrl::index($request);
                break;
            case 'factory-electrical-appliance': // 2.10.2 = 89
                $data = \App\Http\Controllers\Category\FactoryElectricalCtrl::index($request);
                break;
            case 'power-generation': // 2.11.1 = 90
                $data = \App\Http\Controllers\Category\PowerGenertionCtrl::index($request);
                break;
            case 'electrical-appliance-industry': // 2.12.1 = 91
                $data = \App\Http\Controllers\Category\ElectricalApplianceCtrl::index($request);
                break;
            case 'steel-metal-material': // 2.13.1 = 92
                $data = \App\Http\Controllers\Category\SteelAndMetalCtrl::index($request);
                break;
            case 'wood': // 2.13.2 = 93
                $data = \App\Http\Controllers\Category\WoodCtrl::index($request);
                break;
            case 'rubber': // 2.13.3 = 94
                $data = \App\Http\Controllers\Category\RubberCtrl::index($request);
                break;
            case 'plastic': // 2.13.4 = 95
                $data = \App\Http\Controllers\Category\PlasticCtrl::index($request);
                break;
            case 'glass': // 2.13.5 = 96
                $data = \App\Http\Controllers\Category\GlassCtrl::index($request);
                break;
            case 'chemicals-industry': // 2.14.1 = 97
                $data = \App\Http\Controllers\Category\ChemicalsCtrl::index($request);
                break;
            case 'medical-equipment-industry': // 2.15.1 = 98
                $data = \App\Http\Controllers\Category\MedicalEquipmentCtrl::index($request);
                break;
            case 'medicines-industry': // 2.15.2 = 99
                $data = \App\Http\Controllers\Category\MedicinesCtrl::index($request);
                break;
            case 'agricultural-equipment': // 2.16.1 = 100
                $data = \App\Http\Controllers\Category\AgriculturalCtrl::index($request);
                break;
            case 'agricultural-chemicals': // 2.16.2 = 101
                $data = \App\Http\Controllers\Category\AgriculturalChemicalsCtrl::index($request);
                break;
            case 'laboratory-instruments': // 2.17.1 = 102
                $data = \App\Http\Controllers\Category\LaboratoryInstrumentsCtrl::index($request);
                break;
            case 'petroleum-fuel': // 2.18.1 = 103
                $data = \App\Http\Controllers\Category\PetroleumCtrl::index($request);
                break;
            case 'rock': // 2.19.1 = 104
                $data = \App\Http\Controllers\Category\RockCtrl::index($request);
                break;
            case 'brick-and-tile': // 2.19.2 = 105
                $data = \App\Http\Controllers\Category\BrickCtrl::index($request);
                break;
            case 'cement': // 2.19.3 = 106
                $data = \App\Http\Controllers\Category\CementCtrl::index($request);
                break;
            case 'pole': // 2.19.4 = 107
                $data = \App\Http\Controllers\Category\PoleCtrl::index($request);
                break;
            case 'door-windows': // 2.19.5 = 1086
                $data = \App\Http\Controllers\Category\DoorCtrl::index($request);
                break;
            case 'pipe': // 2.19.6 = 109
                $data = \App\Http\Controllers\Category\PipeCtrl::index($request);
                break;
            case 'other-construction-materials': // 2.19.7 = 110
                $data = \App\Http\Controllers\Category\OtherConstructionCtrl::index($request);
                break;
            case 'textiles-clothing': // 2.20.1 = 111
                $data = \App\Http\Controllers\Category\TextilesClothingCtrl::index($request);
                break;
            case 'costume-industry': // 2.20.2 = 112
                $data = \App\Http\Controllers\Category\CostumeCtrl::index($request);
                break;
            case 'leather': // 2.20.3 = 113
                $data = \App\Http\Controllers\Category\LeatherCtrl::index($request);
                break;
            case 'canvas': // 2.20.4 = 114
                $data = \App\Http\Controllers\Category\CanvasCtrl::index($request);
                break;
            case 'silk': // 2.20.5 = 115
                $data = \App\Http\Controllers\Category\SilkCtrl::index($request);
                break;
            case 'zipper-button': // 2.20.6 = 116
                $data = \App\Http\Controllers\Category\ZipperCtrl::index($request);
                break;
            case 'packaging-industry': // 2.21.1 = 117
                $data = \App\Http\Controllers\Category\PackagingCtrl::index($request);
                break;
            case 'interior-decoration': // 3.1.1 = 118
                $data = \App\Http\Controllers\Category\InteriorDecorationCtrl::index($request);
                break;
            case 'broker': // 3.2.1 = 119
                $data = \App\Http\Controllers\Category\BrokerCtrl::index($request);
                break;
            case 'contractor': //3.3.1 = 120
                $data = \App\Http\Controllers\Category\ContractorsCtrl::index($request);
                break;
            case 'solar-cell': // 3.4.1 = 121
                $data = \App\Http\Controllers\Category\SolarCellCtrl::index($request);
                break;
            case 'insurance-lifestyle': // 4.1.1 = 122
                $data = \App\Http\Controllers\Category\InsuranceCtrl::index($request);
                break;
            case 'institution': // 4.2.1 = 123
                $data = \App\Http\Controllers\Category\InstitutionCtrl::index($request);
                break;
            case 'organization': // 4.2.2 = 124
                $data = \App\Http\Controllers\Category\OrganizationCtrl::index($request);
                break;
            case 'farm': // 4.2.3 = 125
                $data = \App\Http\Controllers\Category\FarmCtrl::index($request);
                break;
            case 'space-for-rent-lifestyle': // 4.2.4 = 126
                $data = \App\Http\Controllers\Category\SpaceForRentCtrl::index($request);
                break;
            case 'animal-hospital': // 4.3.1 = 127
                $data = \App\Http\Controllers\Category\AnimalHospitalCtrl::index($request);
                break;
            case 'beauty-clinic': // 4.3.2 = 128
                $data = \App\Http\Controllers\Category\BeautyClinicCtrl::index($request);
                break;
            case 'tourist': // 4.4.1 = 129
                $data = \App\Http\Controllers\Category\TouristCtrl::index($request);
                break;
            case 'accommodation': // 4.4.2 = 130
                $data = \App\Http\Controllers\Category\AccommodationCtrl::index($request);
                break;

        }

        $online = $data['rows']->get()->count();
        $rows = $data['rows']->orderBy('company.type','desc')->inRandomOrder()->limit(20)->get();
        $expanded = $data['count'];

        return ['rows' => $rows, 'online' => $online, 'aboutThis' => $aboutThis, 'expanded'=> $expanded];

    }

    public static function filterOfCategory($categoryKey=null)
    {
        $key = ($categoryKey == null) ? request()->segment(2) : $categoryKey;
        $lang = Session('lang');
        if($lang == '') $lang = 'th';
        $langPro = $lang == 'th' ? 'th' : 'en';
        if(!$lang) \App::setLocale('th');
        $select = ["key","name_$lang as name"];
        $location = \App\Models\ProvinceMd::select("province_id as key","province_name_$langPro as name")->orderBy('name')->get();
        switch ($key)
        {
            case 'electrical-appliance': /*= 1.1.1 - 1 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.brand"),'name'=>'brand','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where('type','electrical-appliance')->select($select)->get(),
                        'brand' => \App\Models\ChoiceMd::where('type','electrical-appliance-brand')->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'office-appliance': /*= 1.1.2 - 2 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::select($select)->where('type', 'office-supplies-type')->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'home-appliance': /*= 1.1.3 - 3 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.product-type"),'name'=>'product','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'product' => \App\Models\ChoiceMd::select($select)->where('type','product-category')->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'ceremony-appliance': /*= 1.1.4 - 4 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::select($select)->where('type','type-of-ceremony')->get(),
                        'location'  => $location
                    ]
                ];
                break;
            case 'baby-appliance':  /*= 1.1.5 - 5 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::select($select)->where("type","baby-supplies-type")->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'home-decoration': /*= 1.1.6 - 6 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.installation"),'name'=>'installation','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.furniture"),'name'=>'furniture','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'installation' => \App\Models\ChoiceMd::select($select)->where("type","type-by-installation")->get(),
                        'furniture' => \App\Models\ChoiceMd::select($select)->where("type","type-of-furniture")->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'costume-and-beauty': /*= 1.1.7 - 7 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.costume"),'name'=>'costume','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.accessories"),'name'=>'accessories','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.beauty"),'name'=>'beauty','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'costume' => \App\Models\ChoiceMd::select("key","name_$lang as name")->where("type","costume")->get(),
                        'accessories' => \App\Models\ChoiceMd::select("key","name_$lang as name")->where("type","accessories")->get(),
                        'beauty' => \App\Models\ChoiceMd::select("key","name_$lang as name")->where("type","beauty")->get(),
                        'location' => $location
                    ]
                    ];
                break;
            case 'automotive-spareparts': /*= 1.1.8 - 8 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.typeautomotive"),'name'=>'automotive','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.spare-parts"),'name'=>'spare-parts','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.brand"),'name'=>'brand','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::select($select)->where("type","sales-type-automotive")->get(),
                        'automotive' => \App\Models\ChoiceMd::select($select)->where("type","automotive-type")->get(),
                        'spare-parts' => \App\Models\ChoiceMd::select($select)->where("type","spare-parts")->get(),
                        'brand' => \App\Models\ChoiceMd::select($select)->where("type","car-brand")->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'music-audio': /*= 1.1.9 - 9 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.thai-music"),'name'=>'thai-music','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.universal-music"),'name'=>'universal-music','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.other-music-device"),'name'=>'other-music-device','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ] ,
                    'filter' => [
                        'thai-music' => \App\Models\ChoiceMd::select($select)->where("type","thai-music")->get(),
                        'universal-music' => \App\Models\ChoiceMd::select($select)->where("type","universal-music")->get(),
                        'other-music-device' => \App\Models\ChoiceMd::select($select)->where("type","other-music-device")->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'sport': /*= 1.1.10 - 10 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.equipment"),'name'=>'equipment','type'=>'checkbox'],
                        (object)['label'=>__("phrase.$key.filter.sport"),'name'=>'sport','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'sport' => \App\Models\ChoiceMd::select($select)->where("type","type-of-sport")->get(),
                        'location' => $location
                        ]
                ];
                break;
            case 'construction-materials': /*= 1.1.11 - 11 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.construction-materials"),'name'=>'construction-materials','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'construction-materials' => \App\Models\ChoiceMd::select($select)->where("type","construction-materials")->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'chemicals': /*= 1.1.12 - 12 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where('type','type-of-chemicals')->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'packaging': /*= 1.1.13 - 13 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=> __("phrase.$key.filter.packaging"),'name' =>'packaging','type'=>'text'],
                        (object)['label'=> __("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=> __("phrase.$key.filter.material"),'name'=>'material','type'=>'text'],
                        (object)['label'=> __("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=> __("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'packaging' => \App\Models\ChoiceMd::where('type','packaging')->select($select)->get(),
                        'type' => \App\Models\ChoiceMd::where('type','packaging-type')->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where('type','package-other')->select($select)->get(),
                        'material' => \App\Models\ChoiceMd::where('type','packaging-materials')->select($select)->get(),
                        'location' => $location,
                    ]
                ];
                break;
            case 'other-product': /*= 1.1.14 - 14  =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::select($select)->where("type","other-product-type")->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'food': /*= 1.2.1 - 15 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::select($select)->where("type","food-type")->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'drinks': /*= 1.2.2 - 16 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::select($select)->where("type","beverage-type")->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'factory-equipment': /*= 1.3.1 - 17 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.products-for-factories"),'name'=>'products-for-factories','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.electric-tools-and-accessories"),'name'=>'electric-tools-and-accessories','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.warehouse-equipment"),'name'=>'warehouse-equipment','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.general-equipment-for-factory"),'name'=>'general-equipment-for-factory','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.accessories-factory"),'name'=>'accessories-factory','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'products-for-factories' => \App\Models\ChoiceMd::select($select)->where("type","products-for-factories")->get(),
                        'electric-tools-and-accessories' => \App\Models\ChoiceMd::select($select)->where("type","electric-tools-and-accessories")->get(),
                        'warehouse-equipment' => \App\Models\ChoiceMd::select($select)->where("type","warehouse-equipment")->get(),
                        'general-equipment-for-factory' => \App\Models\ChoiceMd::select($select)->where("type","general-equipment-for-factory")->get(),
                        'accessories-factory' => \App\Models\ChoiceMd::select($select)->where("type","accessories-factory")->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'hand-tool': /*= 1.3.2 - 18 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::select($select)->where("type","mechanic-tools-type")->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'machine-parts': /*= 1.3.3 - 19 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.machine-type"),'name'=>'machine-type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.machine-working-pattern"),'name'=>'machine-working-pattern','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.overhaul"),'name'=>'overhaul','type'=>'checkbox'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'machine-type' => \App\Models\ChoiceMd::select($select)->where("type","machine-type")->get(),
                        'machine-working-pattern' => \App\Models\ChoiceMd::select($select)->where("type","machine-working-pattern")->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'medicines': /*= 1.4.1 - 20 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.supplementary-food"),'name'=>'supplementary','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.drug-utilization"),'name'=>'drug-utilization','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::select($select)->where("type","type-of-medication")->get(),
                        'supplementary' => \App\Models\ChoiceMd::select($select)->where("type","supplementary-food")->get(),
                        'drug-utilization' => \App\Models\ChoiceMd::select($select)->where("type","drug-utilization")->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'medical-equipment': /*= 1.4.2 - 21 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::select($select)->where("type","medical-instruments-and-apparatus")->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'visa-support': /*= 1.5.1 - 22 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__('phrase.visa-type'),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::select($select)->where("type","type-of-visa")->get(),
                        'location' => $location,
                    ]
                ];
                break;
            case 'company-register': /*= 1.5.2 - 23 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.consulting"),'name'=>'consulting','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'service' => \App\Models\ChoiceMd::select($select)->where('type','setting-service')->get(),
                        'consulting' => \App\Models\ChoiceMd::select($select)->where('type','management-consulting')->get(),
                        'location' => $location,
                    ]
                ];
                break;
            case 'law-firm': /*= 1.5.3 - 24 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.language"),'name'=>'language','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where('type','type-of-lawsuit')->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where('type','service-of-lawfirm')->select($select)->get(),
                        'language' => \App\Models\ChoiceMd::where('type','law-firm-language')->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'space-for-rent': /*= 1.5.4 - 25 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.period"),'name'=>'period','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.seat"),'name'=>'seat','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::select($select)->where("type","type-of-space-for-rent")->get(),
                        'service' => \App\Models\ChoiceMd::select($select)->where("type","co-working-service")->get(),
                        'period' => \App\Models\ChoiceMd::select($select)->where("type","space-contract-period")->get(),
                        'seat' => \App\Models\ChoiceMd::select($select)->where("type","co-working-seat")->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'consultant': /*= 1.5.5 - 26 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'service' => \App\Models\ChoiceMd::select($select)->where("type","consultant-service")->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'translater': /*= 1.5.6 - 27 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.urgent"),'name'=>'urgent','type'=>'checkbox'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.translate"),'name'=>'translate','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.speciality"),'name'=>'speciality','type'=>'text'],
                        // (object)['label'=>__("phrase.$key.filter.postpay"),'name'=>'postpay','type'=>'checkbox'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'service' => \App\Models\ChoiceMd::select($select)->where('type','translator-interpreter-service')->get(),
                        'translate' => \App\Models\TranslateMd::select("id as key","name_th as name")->get(),
                        'speciality' => \App\Models\ChoiceMd::select($select)->where('type','translator-interpreter-documents')->get(),
                        'location' => $location,
                    ]
                ];
                break;
            case 'accounting': /*= 1.5.7 - 28 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.other"),'name'=>'other','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.nationality"),'name'=>'nationality','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'service' => \App\Models\ChoiceMd::where('type','account-service')->select('key',"name_$lang as name")->get(),
                        'other' => \App\Models\ChoiceMd::where('type','account-other')->select('key',"name_$lang as name")->get(),
                        'nationality' => \App\Models\CountryMd::select('id as key',"nationality as name")->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'prefabricated-office': /*= 1.5.8 - 29 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.seat"),'name'=>'seat','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where('type','co-working-type')->select('key',"name_$lang as name")->get(),
                        'service' => \App\Models\ChoiceMd::where('type','co-working-service')->select('key',"name_$lang as name")->get(),
                        'seat' => \App\Models\ChoiceMd::where('type','co-working-seat')->select('key',"name_$lang as name")->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'logistics': /*= 1.6.1 - 30 =*/
                $data = (object)[
                    'input' => [
                        (object)['label' => __('phrase.domestic'), 'name' => 'domestic', 'type' => 'checkbox'],
                        (object)['label' => __('phrase.international'), 'name' => 'international', 'type' => 'text'],
                        (object)['label' => __('phrase.transport'), 'name' => 'method', 'type' => 'text'],
                        (object)['label' => __('phrase.items'), 'name' => 'item', 'type' => 'text'],
                        (object)['label' => __('phrase.services'), 'name' => 'service', 'type' => 'text'],
                        (object)['label' => __("phrase.$key.filter.warehouse"), 'name' => 'warehouse', 'type' => 'text'],
                        (object)['label' => __("phrase.$key.filter.location"), 'name'=> 'location', 'type'=>'text']
                    ],
                    'filter' => [
                        'international' => \App\Models\ChoiceMd::where('type','transport')->select($select)->get(),
                        'method' => \App\Models\ChoiceMd::where('type','methods')->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where('type','services')->select($select)->get(),
                        'item' => \App\Models\ChoiceMd::where('type','warehouse')->select($select)->orderBy('key')->get(),
                        'warehouse' => $location,
                        'location' => $location,
                    ]
                ];
                break;
            case 'warehouse': /*= 1.6.2 - 31 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.warehouse"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where('type','stock')->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'forklift': /*= 1.6.3 - 32 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.fuel"),'name'=>'fuel','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.rental"),'name'=>'rental','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where('type','forklift-type')->select($select)->get(),
                        'fuel' => \App\Models\ChoiceMd::where('type','fuel-system')->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where('type','sales-type')->select($select)->get(),
                        'rental' => \App\Models\ChoiceMd::where('type','construction-rental')->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'heavy-machinery': /*= 1.6.4 - 33 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.fuel"),'name'=>'fuel','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.rental"),'name'=>'rental','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where('type','construction-type')->select($select)->orderBy('key','asc')->get(),
                        'fuel' => \App\Models\ChoiceMd::where('type','fuel-system')->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where('type','sales-type')->select($select)->get(),
                        'rental' => \App\Models\ChoiceMd::where('type','construction-rental')->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'transportation-warehouse-equipment': /*= 1.6.5 - 34 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::select($select)->where("type","transportation-warehouse-equipment")->get(),
                        'location' => $location,
                    ]
                ];
                break;
            case 'credit-loan': /*= 1.7.1 - 35 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where('type','leasing-type')->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'insurance': /*= 1.7.2 - 36 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.personal"),'name'=>'personality','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.property"),'name'=>'property','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.business"),'name'=>'business','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.pets"),'name'=>'pets','type'=>'checkbox'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'personality' => \App\Models\ChoiceMd::where('type','personal-insurance')->select($select)->get(),
                        'property' => \App\Models\ChoiceMd::where('type','property-insurance')->select($select)->get(),
                        'business' => \App\Models\ChoiceMd::where('type','insurance-business')->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'financial': /*= 1.7.3 - 37  =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'service' => \App\Models\ChoiceMd::where("type","financial-institution-service")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'online-marketing': /*= 1.8.1 - 38 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.language"),'name'=>'language','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'service' => \App\Models\ChoiceMd::where('type','marketing-service')->select($select)->get(),
                        'language' => \App\Models\ChoiceMd::where('type','online-marketing-language')->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'it-hardware': /*= 1.8.2 - 39 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.hardware"),'name'=>'hardware','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'service' => \App\Models\ChoiceMd::where('type','it-hardware-service')->select($select)->get(),
                        'hardware' => \App\Models\ChoiceMd::where('type','it-hardware')->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'web-system': /*= 1.8.3 - 40 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.other"),'name'=>'other','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.language"),'name'=>'language','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'service' => \App\Models\ChoiceMd::where('type','web-service')->select($select)->get(),
                        'other' => \App\Models\ChoiceMd::where('type','web-other-service')->select($select)->get(),
                        'language' => \App\Models\ChoiceMd::where('type','web-language')->select($select)->get(),
                        'location' => $location,
                    ]
                ];
                break;
            case 'software-development': /*= 1.8.4 - 41 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.software"),'name'=>'software','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'service' => \App\Models\ChoiceMd::select($select)->where("type","software-development-service")->get(),
                        'software' => \App\Models\ChoiceMd::select($select)->where("type","software-development")->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'printing': /*= 1.9.1 - 42 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.minimum"),'name'=>'minimum','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.other-service"),'name'=>'other','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::select($select)->where('type','type-printing')->get(),
                        'minimum' => \App\Models\ChoiceMd::select($select)->where('type','service-minimum')->get(),
                        'other' => \App\Models\ChoiceMd::select($select)->where('type','printing-other')->get(),
                        'location' => $location,
                    ]
                ];
                break;
            case 'advertising': /*= 1.9.2 - 43  =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.additional"),'name'=>'other','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'service' => \App\Models\ChoiceMd::select($select)->where("type","advertising-service")->get(),
                        'other' => \App\Models\ChoiceMd::select($select)->where("type","advertising-additional-service")->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'car-rental': /*= 1.10.1 - 44 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.car-type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.contract-period"),'name'=>'period','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where('type','car')->select('id','key',"name_$lang as name")->get(),
                        'period' => \App\Models\ChoiceMd::where('type','contract-period')->select('id','key',"name_$lang as name")->get(),
                        'location' => $location,
                    ]
                ];
                break;
            case 'public-transportation': /*= 1.10.2 - 45  =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.pick-up-point"),'name'=>'pick-up-point','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.destination"),'name'=>'destination','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::select($select)->where("type","public-transportation")->get(),
                        'pick-up-point' => $location,
                        'destination' => $location,
                        'location' => $location
                    ]
                ];
                break;
            case 'security-system': /*= 1.11.1 - 46 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'service' => \App\Models\ChoiceMd::where('type','security-system-service')->select('key',"name_$lang as name")->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'recruitment': /*= 1.11.2 - 47 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.position"),'name'=>'position','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.nationality"),'name'=>'nationality','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.employment"),'name'=>'employment','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'position' => \App\Models\ChoiceMd::where("type","recruitment-position")->select($select)->get(),
                        'nationality' => \App\Models\ChoiceMd::where("type","recruitment-nationality")->select($select)->get(),
                        'employment' => \App\Models\ChoiceMd::where('type','type-recruitment')->select('key',"name_$lang as name")->get(),
                        'location' => $location,
                    ]
                ];
                break;
            case 'organizer': /*= 1.12.1 - 48 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::select($select)->where("type","get-a-party-type")->get(),
                        'service' => \App\Models\ChoiceMd::select($select)->where("type","get-a-party-service")->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'land-survey': /*= 1.12.2 - 49 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::select($select)->where("type","property-type")->get(),
                        'service' => \App\Models\ChoiceMd::select($select)->where("type","valuation-service")->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'gardening': /*= 1.12.3 - 50 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'service' => \App\Models\ChoiceMd::select($select)->where("type","gardening-service")->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'studio': /*= 1.12.4 - 51 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.model"),'name'=>'model','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'model' => \App\Models\ChoiceMd::select($select)->where("type","photography-studio-type-service")->get(),
                        'type' => \App\Models\ChoiceMd::select($select)->where("type","photography-studio-type")->get(),
                        'service' => \App\Models\ChoiceMd::select($select)->where("type","photography-studio-service")->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'cleaning': /*= 1.12.5 - 52 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'service' => \App\Models\ChoiceMd::where('type','clean-service')->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'insecticide': /*= 1.12.6 - 53 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service-location"),'name'=>'service-location','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'service' => \App\Models\ChoiceMd::select($select)->where("type","insecticide-service")->get(),
                        'service-location' => \App\Models\ChoiceMd::select($select)->where("type","insecticide-site")->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'other-general': /*= 1.12.7 - 54 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'service' => \App\Models\ChoiceMd::select($select)->where("type","other-service-service")->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'machinery-repair': /*= 1.13.1 - 55 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.work-pattern"),'name'=>'work-pattern','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.overhaul"),'name'=>'overhaul','type'=>'checkbox'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::select($select)->where("type","machine-type")->get(),
                        'work-pattern' => \App\Models\ChoiceMd::select($select)->where("type","machine-working-pattern")->get(),
                        // 'overhaul' => [],
                        'location' => $location
                    ]
                ];
                break;
            case 'electronics-repair': /*= 1.13.2 - 56 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.electrical-appliance"),'name'=>'electrical-appliance','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.brand"),'name'=>'brand','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'electrical-appliance' => \App\Models\ChoiceMd::select($select)->where("type","electrical-appliance")->get(),
                        'brand' => \App\Models\ChoiceMd::select($select)->where("type","electrical-appliance-brand-repair")->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'automotive-repair': /*= 1.13.3 - 57 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.sales-type"),'name'=>'sales-type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.automotive-type"),'name'=>'automotive-type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.spare-parts"),'name'=>'spare-parts','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.brand"),'name'=>'brand','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.towing-service"),'name'=>'towing-service','type'=>'checkbox'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'sales-type' => \App\Models\ChoiceMd::select($select)->where("type","sales-type-automotive")->get(),
                        'automotive-type' => \App\Models\ChoiceMd::select($select)->where("type","automotive-type")->get(),
                        'spare-parts' => \App\Models\ChoiceMd::select($select)->where("type","spare-parts")->get(),
                        'brand' => \App\Models\ChoiceMd::select($select)->where("type","car-brand")->get(),
                        // 'towing-service' => [],
                        'location' => $location
                    ]
                ];
                break;
            case 'textiles-repair': /*= 1.13.4 - 58 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.costume"),'name'=>'costume','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'costume' => \App\Models\ChoiceMd::where("type","costume")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'accessories-repair': /*= 1.13.5 - 59 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.accessories"),'name'=>'accessories','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'accessories' => \App\Models\ChoiceMd::where("type","accessories")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'watersupply-repair': /*= 1.13.6 - 60 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'checkbox'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","type-of-repair")->select($select)->get(),
                        // 'service' => [],
                        'location' => $location,
                    ]
                ];
                break;
            case 'furniture-repair': /*= 1.13.7 - 61 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.usage"),'name'=>'usage','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","type-by-installation")->select($select)->get(),
                        'usage' => \App\Models\ChoiceMd::where("type","type-according-to-use")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'machines-for-stamping': /*= 2.1.1 - 62 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.usage"),'name'=>'usage','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.material"),'name'=>'material','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.compression"),'name'=>'compression','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.distribute"),'name'=>'distribute','type'=>'checkbox'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'usage' => \App\Models\ChoiceMd::where("type","usage")->select($select)->get(),
                        'material' => \App\Models\ChoiceMd::where("type","material")->select($select)->get(),
                        'compression' => \App\Models\ChoiceMd::where("type","compression")->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where("type","stamping-service")->select($select)->get(),
                        // 'distribute' => [],
                        'location' => $location
                    ]
                ];
                break;
            case 'machines-for-folding': /*= 2.1.2 - 63 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.bending-machine"),'name'=>'bending-machine','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.folding-machine"),'name'=>'folding-machine','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.materials"),'name'=>'materials','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.distribute"),'name'=>'distribute','type'=>'checkbox'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'bending-machine' => \App\Models\ChoiceMd::where("type","bending-machine")->select($select)->get(),
                        'folding-machine' => \App\Models\ChoiceMd::where("type","folding-machine")->select($select)->get(),
                        'materials' => \App\Models\ChoiceMd::where("type","materials-folding-bending")->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where("type","folding-bending-service")->select($select)->get(),
                        // 'distribute' => [],
                        'location' => $location
                    ]
                ];
                break;
            case 'machines-for-casting': /*= 2.1.3 - 64 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.material"),'name'=>'material','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.distribute"),'name'=>'distribute','type'=>'checkbox'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","machines-forming")->select($select)->get(),
                        'material' => \App\Models\ChoiceMd::where("type","material")->select($select)->whereIn('key',[1,3,4,5])->get(),
                        'service' => \App\Models\ChoiceMd::where("type","machines-forming-service")->select($select)->get(),
                        // 'distribute' => [],
                        'location' => $location
                    ]
                ];
                break;
            case 'machines-for-dressing': /*= 2.1.4 - 65 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type-of-cutter"),'name'=>'cutter','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.type-of-drilling-machine"),'name'=>'drilling','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.type-of-lathe"),'name'=>'lathe','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.type-of-grinding-machine"),'name'=>'grinding','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.materials"),'name'=>'material','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.distribute"),'name'=>'distribute','type'=>'checkbox'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'cutter' => \App\Models\ChoiceMd::where("type","type-of-cutter")->select($select)->get(),
                        'drilling' => \App\Models\ChoiceMd::where("type","type-of-drilling-machine")->select($select)->get(),
                        'lathe' => \App\Models\ChoiceMd::where("type","type-of-lathe")->select($select)->get(),
                        'grinding' => \App\Models\ChoiceMd::where("type","type-of-grinding-machine")->select($select)->get(),
                        'material' => \App\Models\ChoiceMd::where("type","materials-for-cutting/drilling/lathe/grinding")->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where("type","service-for-machines")->select($select)->get(),
                        // 'distribute' => [],
                        'location' => $location
                    ]
                ];
                break;
            case 'machines-for-compression': /*= 2.1.5 - 66 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type-of-compactor"),'name'=>'compactor','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.type-of-injection-machine"),'name'=>'injection','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.material-for-compression"),'name'=>'material','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.distribute"),'name'=>'distribute','type'=>'checkbox'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'compactor' => \App\Models\ChoiceMd::where("type","type-of-compactor")->select($select)->get(),
                        'injection' => \App\Models\ChoiceMd::where("type","type-of-injection-machine")->select($select)->get(),
                        'material' => \App\Models\ChoiceMd::where("type","material-for-compression/injection")->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where("type","compression-injection-service")->select($select)->get(),
                        // 'distribute' => [],
                        'location' => $location,
                    ]
                ];
                break;
            case 'machines-for-rolling': /*= 2.1.6 - 67 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.distribute"),'name'=>'distribute','type'=>'checkbox'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","type-of-rolling-machine")->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where("type","rolling-machine-service")->select($select)->get(),
                        // 'distribute' => [],
                        'location' => $location,
                    ]
                ];
                break;
            case 'machines-for-welding': /*= 2.1.7 - 68 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.distribute"),'name'=>'distribute','type'=>'checkbox'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","type-of-welding-machine")->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where("type","welding-service")->select($select)->get(),
                        // 'distribute' => [],
                        'location' => $location,
                    ]
                ];
                break;
            case 'other-machinery': /*= 2.1.8 - 69 =*/
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'forklift-industry': /*= 2.2.1 - 70 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.fuel-system"),'name'=>'fuel-system','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","forklift-type-industry")->select($select)->get(),
                        'fuel-system' => \App\Models\ChoiceMd::where("type","fuel-system")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'heavy-machinery-industry': /*= 2.2.2 - 71 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.fuel-system"),'name'=>'fuel-system','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","construction-type")->select($select)->get(),
                        'fuel-system' => \App\Models\ChoiceMd::where("type","fuel-system")->select($select)->get(),
                        'location' => $location
                    ]
                ] ;
                break;
            case 'automotive': /*= 2.2.3 - 72 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.spare-parts"),'name'=>'spare-parts','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.brand"),'name'=>'brand','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","automotive-type")->select($select)->get(),
                        'spare-parts' => \App\Models\ChoiceMd::where("type","spare-parts")->select($select)->get(),
                        'brand' => \App\Models\ChoiceMd::where("type","car-brand")->select($select)->get(),
                        'location' => $location
                    ]
                ] ;
                break;
            case 'mold': /*= 2.3.1 - 73 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.usage"),'name'=>'usage','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'usage' => \App\Models\ChoiceMd::where("type","mold-usage-pattern")->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where("type","mold-service")->select($select)->get(),
                        'location' => $location
                    ]
                ] ;
                break;
            case 'machine-tools': /*= 2.4.1 - 74 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","type-of-machine-tool")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'measuring-tools': /*= 2.4.2 - 75 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.kind"),'name'=>'kind','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'kind' => \App\Models\ChoiceMd::where("type","kind-of-measuring-tool")->select($select)->get(),
                        'type' => \App\Models\ChoiceMd::where("type","type-of-measuring-tool")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'hand-tool-industry': /*= 2.4.3 - 76 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","mechanic-tools-type")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'improve-texture': /*= 2.5.1 - 77 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.products"),'name'=>'products','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.production-model"),'name'=>'production-model','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'service' => \App\Models\ChoiceMd::where("type","improve-texture-service")->select($select)->get(),
                        'products' => \App\Models\ChoiceMd::where("type","products-for-plating/coating")->select($select)->get(),
                        'production-model' => \App\Models\ChoiceMd::where("type","type-of-plating/coating")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'baby-appliance-industry': /*= 2.6.1 - 78 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","baby-supplies-type")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'ceremony-appliance-industry': /*= 2.6.2 - 79 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","type-of-ceremony")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'jewelry-beauty-industry': /*= 2.6.3 - 80 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.accessories"),'name'=>'accessories','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.beauty"),'name'=>'beauty','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'accessories' => \App\Models\ChoiceMd::where("type","accessories")->select($select)->get(),
                        'beauty' => \App\Models\ChoiceMd::where("type","beauty")->select($select)->get(),
                        'location' => $location
                    ]
                    ];
                break;
            case 'kitchen-appliance-industry': /*= 2.6.4 - 81 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.category"),'name'=>'category','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'category' => \App\Models\ChoiceMd::where("type","product-category")->select($select)->get(),
                        'location' => $location,
                    ]
                ];
                break;
            case 'music-audio-industry': /*= 2.6.5 - 82 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.thai-music"),'name'=>'thai-music','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.universal-music"),'name'=>'universal-music','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.other-music-device"),'name'=>'other-music-device','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'thai-music' => \App\Models\ChoiceMd::where("type","thai-music")->whereIn('key',[1,2,3,4])->select($select)->get(),
                        'universal-music' => \App\Models\ChoiceMd::where("type","universal-music")->whereIn('key',[1,2,3,4,5])->select($select)->get(),
                        'other-music-device' => \App\Models\ChoiceMd::where("type","other-music-device")->select($select)->get(),
                        'location' => $location
                    ]
                ] ;
                break;
            case 'sport-industry': /*= 2.6.6 - 83 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.products"),'name'=>'products','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","type-of-sport")->select($select)->get(),
                        'products' => \App\Models\ChoiceMd::where("type","sports-products")->select($select)->get(),
                        'location' => $location
                    ]
                ] ;
                break;
            case 'foods-industry': /*= 2.7.1 - 84 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","food-type")->select($select)->whereNotIn('key',[13,14])->get(),
                        'service' => \App\Models\ChoiceMd::where("type","food-service")->select($select)->get(),
                        'location' => $location
                    ]
                ] ;
                break;
            case 'drinks-industry': /*= 2.7.2 - 85 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","beverage-type")->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where("type","beverage-service")->select($select)->get(),
                        'location' => $location
                    ]
                ] ;
                break;
            case 'home-decoration-industry': /*= 2.8.1 - 86 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.minimum"),'name'=>'minimum','type'=>'checkbox'],
                        (object)['label'=>__("phrase.$key.filter.made-to-order"),'name'=>'made-to-order','type'=>'checkbox'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.materials"),'name'=>'materials','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.installation"),'name'=>'installation','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.product"),'name'=>'product','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        // 'minimum' => [],
                        // 'made-to-order' => [],
                        'service' => \App\Models\ChoiceMd::where("type","furniture-decorations-service")->select($select)->get(),
                        'materials' => \App\Models\ChoiceMd::where("type","furniture-decorations-material")->select($select)->get(),
                        'installation' => \App\Models\ChoiceMd::where("type","type-by-installation")->select($select)->get(),
                        'product' => \App\Models\ChoiceMd::where("type","furniture-decorations-product-type")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'office-appliance-industry': /*= 2.9.1 - 87 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","office-supplies-type")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'electric-kitchen-appliance': /*= 2.10.1 - 88 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","electrical-appliance")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'factory-electrical-appliance': /*= 2.10.2 - 89 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","types-of-electrical-appliances")->select($select)->get(),
                        'location' => $location
                    ]
                ] ;
                break;
            case 'power-generation': /*= 2.11.1 - 90 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.agreement"),'name'=>'agreement','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.turbine"),'name'=>'turbine','type'=>'checkbox'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","power-generation-system")->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where("type","solar-cells-wind-turbines-service")->select($select)->get(),
                        'agreement' => \App\Models\ChoiceMd::where("type","solar-cells-wind-turbines-trading-agreement")->select($select)->get(),
                        // 'turbine' => [],
                        'location' => $location
                    ]
                ] ;
                break;
            case 'electrical-appliance-industry': /*= 2.12.1 - 91 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.electrical"),'name'=>'electrical','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.electronic"),'name'=>'electronic','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'electrical' => \App\Models\ChoiceMd::where("type","type-of-electrical-equipment")->select($select)->get(),
                        'electronic' => \App\Models\ChoiceMd::where("type","electronic-device-type")->select($select)->get(),
                        'location' => $location
                    ]
                ] ;
                break;
            case 'steel-metal-material': /*= 2.13.1 - 92 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.material"),'name'=>'material','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.product"),'name'=>'product','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'material' => \App\Models\ChoiceMd::where("type","steel-metal-material")->select($select)->get(),
                        'product' => \App\Models\ChoiceMd::where("type","steel-metal-product")->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where("type","steel-metal-service")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'wood': /*= 2.13.2 - 93 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.wood"),'name'=>'wood','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.product"),'name'=>'product','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'wood' => \App\Models\ChoiceMd::where("type","type-of-wood")->select($select)->get(),
                        'product' => \App\Models\ChoiceMd::where("type","wood-product")->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where("type","wood-service")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'rubber': /*= 2.13.3 - 94 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.product"),'name'=>'product','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","type-of-rubber")->select($select)->get(),
                        'product' => \App\Models\ChoiceMd::where("type","rubber-product")->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where("type","rubber-service")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'plastic': /*= 2.13.4 - 95 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.product"),'name'=>'product','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","type-of-plastic")->select($select)->get(),
                        'product' => \App\Models\ChoiceMd::where("type","plastics-product")->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where("type","plastic-service")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'glass': /*= 2.13.5 - 96 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.product"),'name'=>'product','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","type-of-glass")->select($select)->get(),
                        'product' => \App\Models\ChoiceMd::where("type","glass-products")->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where("type","glass-services")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'chemicals-industry': /*= 2.14.1 - 97 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.for-car"),'name'=>'for-car','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.cleaning"),'name'=>'cleaning','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.cosmetic"),'name'=>'cosmetic','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.chemistry"),'name'=>'chemistry','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.food"),'name'=>'food','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.category"),'name'=>'industry','type'=>'checkbox'],
                        (object)['label'=>__("phrase.$key.filter.general"),'name'=>'general','type'=>'checkbox'],
                        (object)['label'=>__("phrase.$key.filter.made-to-order"),'name'=>'made-to-order','type'=>'checkbox'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'for-car' => \App\Models\ChoiceMd::where("type","chemical-for-car")->select($select)->get(),
                        'cleaning' => \App\Models\ChoiceMd::where("type","chemical-cleaning")->select($select)->get(),
                        'cosmetic' => \App\Models\ChoiceMd::where("type","cosmetic-chemistry")->select($select)->get(),
                        'chemistry' => \App\Models\ChoiceMd::where("type","color-chemistry")->select($select)->get(),
                        'food' => \App\Models\ChoiceMd::where("type","food-chemistry")->select($select)->get(),
                        // 'industry' => [],
                        // 'general' => [],
                        // 'made-to-order' => [],
                        'location' => $location
                        ]
                    ];
                break;
            case 'medical-equipment-industry': /*= 2.15.1 - 98 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","medical-instruments-and-apparatus")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'medicines-industry': /*= 2.15.2 - 99 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.supplements"),'name'=>'supplements','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.usage"),'name'=>'usage','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","type-of-medication-industry")->select($select)->get(),
                        'supplements' => \App\Models\ChoiceMd::where("type","supplementary-food")->select($select)->get(),
                        'usage' => \App\Models\ChoiceMd::where("type","drug-utilization")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'agricultural-equipment': /*= 2.16.1 - 100 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.for-earth-work"),'name'=>'for-earth-work','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.for-plant"),'name'=>'for-plant','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.for-moving"),'name'=>'for-moving','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'for-earth-work' => \App\Models\ChoiceMd::where("type","tools-for-earth-work")->select($select)->get(),
                        'for-plant' => \App\Models\ChoiceMd::where("type","tool-for-plant")->select($select)->get(),
                        'for-moving' => \App\Models\ChoiceMd::where("type","tools-for-moving-providing-water")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'agricultural-chemicals': /*= 2.16.2 - 101 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.organic"),'name'=>'organic','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.chemical"),'name'=>'chemical','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'organic' => \App\Models\ChoiceMd::where("type","organic-type")->select($select)->get(),
                        'chemical' => \App\Models\ChoiceMd::where("type","chemical-type")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'laboratory-instruments': /*= 2.17.1 - 102 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.instruments"),'name'=>'instruments','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.glassware"),'name'=>'glassware','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.plastic"),'name'=>'plastic','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.consumables"),'name'=>'consumables','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.ceramic"),'name'=>'ceramic','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'instruments' => \App\Models\ChoiceMd::where("type","types-of-scientific-instruments")->select($select)->get(),
                        'glassware' => \App\Models\ChoiceMd::where("type","type-of-glassware")->select($select)->get(),
                        'plastic' => \App\Models\ChoiceMd::where("type","plastic-product-type")->select($select)->get(),
                        'consumables' => \App\Models\ChoiceMd::where("type","consumables")->select($select)->get(),
                        'ceramic' => \App\Models\ChoiceMd::where("type","ceramic-products")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'petroleum-fuel': /*= 2.18.1 - 103 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.material"),'name'=>'material','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.process"),'name'=>'process','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'material' => \App\Models\ChoiceMd::where("type","raw-materials-for-petroleum-fuel-production")->select($select)->get(),
                        'process' => \App\Models\ChoiceMd::where("type","petroleum-fuel-production-process")->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where("type","petroleum-fuel-product-service")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'rock': /*= 2.19.1 - 104 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.rock"),'name'=>'rock','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.sand"),'name'=>'sand','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.soil"),'name'=>'soil','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.other"),'name'=>'other','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'rock' => \App\Models\ChoiceMd::where("type","type-of-rock")->select($select)->get(),
                        'sand' => \App\Models\ChoiceMd::where("type","type-of-sand")->select($select)->get(),
                        'soil' => \App\Models\ChoiceMd::where("type","type-of-soil")->select($select)->get(),
                        'other' => \App\Models\ChoiceMd::where("type","rock-soil-sand")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'brick-and-tile': /*= 2.19.2 - 105 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.tile"),'name'=>'tile','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","type-of-brick")->select($select)->get(),
                        'tile' => \App\Models\ChoiceMd::where("type","type-of-tile")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'cement': /*= 2.19.3 - 106 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","type-of-cement")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'pole': /*= 2.19.4 - 107 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.cross"),'name'=>'cross','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","type-of-mast")->select($select)->get(),
                        'cross' => \App\Models\ChoiceMd::where("type","cross-type")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'door-windows': /*= 2.19.5 - 108 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.window"),'name'=>'window','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.door"),'name'=>'door','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.material"),'name'=>'material','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.other"),'name'=>'other','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'window' => \App\Models\ChoiceMd::where("type","type-of-window")->select($select)->get(),
                        'door' => \App\Models\ChoiceMd::where("type","type-of-door")->select($select)->get(),
                        'material' => \App\Models\ChoiceMd::where("type","type-of-door-and-window-material")->select($select)->get(),
                        'other' => \App\Models\ChoiceMd::where("type","door-window-other-product")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'pipe': /*= 2.19.6 - 109 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","type-of-pipe")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'other-construction-materials': /*= 2.19.7 - 110 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.product"),'name'=>'product','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'product' => \App\Models\ChoiceMd::where("type","other-construction-materials-and-equipment")->select($select)->get(),
                        'location' => $location,
                    ]
                ];
                break;
            case 'textiles-clothing': /*= 2.20.1 - 111 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.product"),'name'=>'product','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'product' => \App\Models\ChoiceMd::where('type','textile-products')->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where('type','textile-service')->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'costume-industry': /*= 2.20.2 - 112 =*/
                $data = (object)[
                    'input' =>[
                        (object)['label'=>__("phrase.$key.filter.product"),'name'=>'product','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'product' => \App\Models\ChoiceMd::where('type','costume-product')->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where('type','costume-service')->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'leather': /*= 2.20.3 - 113 =*/
                $data = (object)[
                    'input' =>[
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.product"),'name'=>'product','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","type-of-leather")->select($select)->get(),
                        'product' => \App\Models\ChoiceMd::where("type","leather-product")->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where("type","service-of-leather-product")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'canvas': /*= 2.20.4 - 114 =*/
                $data = (object)[
                    'input' =>[
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.product"),'name'=>'product','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","type-of-canvas")->select($select)->get(),
                        'product' => \App\Models\ChoiceMd::where("type","product-of-canvas")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'silk': /*= 2.20.5 - 115 =*/
                $data = (object)[
                    'input' =>[
                        (object)['label'=>__("phrase.$key.filter.product"),'name'=>'product','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'product' => \App\Models\ChoiceMd::where("type","silk-products")->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where("type","silk-service")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'zipper-button': /*= 2.20.6 - 116 =*/
                $data = (object)[
                    'input' =>[
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where("type","decoration-material")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'packaging-industry': /*= 2.21.1 - 117 =*/
                $data = (object)[
                    'input' =>[
                        (object)['label'=>__("phrase.$key.filter.packaging"),'name'=>'packaging','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.material"),'name'=>'material','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'packaging' => \App\Models\ChoiceMd::where("type","packaging")->select($select)->get(),
                        'type' => \App\Models\ChoiceMd::where("type","packaging-type")->select($select)->get(),
                        'material' => \App\Models\ChoiceMd::where("type","packaging-materials")->whereNotIn('key',[5])->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where("type","package-other")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'interior-decoration': /*= 3.1.1 - 118 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.renovation"),'name'=>'renovation','type'=>'checkbox'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'service' => \App\Models\ChoiceMd::where('type','type-of-interior-decoration')->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'broker': /*= 3.2.1 - 119 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.nationality"),'name'=>'nationality','type'=>'text'],
                    ],
                    'filter' => [
                        'service' => \App\Models\ChoiceMd::where('type','real-estate-service')->select($select)->get(),
                        'type' => \App\Models\ChoiceMd::where('type','real-estate-type')->select($select)->get(),
                        'location' => $location,
                        'nationality' => \App\Models\CountryMd::select('id as key',"nationality as name")->get(),
                    ]
                ];
                break;
            case 'contractor': /*= 3.3.1 - 120 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.utilities"),'name'=>'utilities','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.building"),'name'=>'building','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.energy"),'name'=>'energy','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.industrial"),'name'=>'industrial','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.environmental"),'name'=>'environmental','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.small"),'name'=>'small','type'=>'checkbox'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'utilities' => \App\Models\ChoiceMd::where('type','utilities-construction')->select($select)->get(),
                        'building' => \App\Models\ChoiceMd::where('type','building-system-construction')->select($select)->get(),
                        'energy' => \App\Models\ChoiceMd::where('type','energy-system-construction')->select($select)->get(),
                        'industrial' => \App\Models\ChoiceMd::where('type','contractor-of-industrial-systems')->select($select)->get(),
                        'environmental' => \App\Models\ChoiceMd::where('type','contractor-of-environmental-system')->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where('type','contractor-service')->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'solar-cell': /*= 3.4.1 - 121 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.power-generation"),'name'=>'product','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'other','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.condition"),'name'=>'condition','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text'],
                    ],
                    'filter' => [
                        'product' => \App\Models\ChoiceMd::where('type','power-generation-system')->select($select)->get(),
                        'other' => \App\Models\ChoiceMd::where('type','solar-cells-wind-turbines-service')->whereNotIn('key',[8])->select($select)->get(),
                        'condition' => \App\Models\ChoiceMd::where('type','solar-cells-wind-turbines-trading-agreement')->select($select)->get(),
                        'location' => $location,
                    ]
                ];
                break;
            case 'insurance-lifestyle': /*= 4.1.1 - 122 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.personal"),'name'=>'personality','type'=>"text"],
                        (object)['label'=>__("phrase.$key.filter.property"),'name'=>'property','type'=>"text"],
                        (object)['label'=>__("phrase.$key.filter.business"),'name'=>'business','type'=>"text"],
                        (object)['label'=>__("phrase.$key.filter.pets"),'name'=>'pets','type'=>"checkbox"],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>"text"],
                    ],
                    'filter' => [
                        'personality' => \App\Models\ChoiceMd::where('type','personal-insurance')->select($select)->get(),
                        'property' => \App\Models\ChoiceMd::where('type','property-insurance')->select($select)->get(),
                        'business' => \App\Models\ChoiceMd::where('type','insurance-business')->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'institution': /*= 4.2.1 - 123 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>"text"],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>"text"]
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where('type','type-of-institution')->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'organization': /*= 4.2.2 - 124 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>"text"],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>"text"]
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where('type','type-of-organization')->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'farm': /*= 4.2.3 - 125 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.aquatic"),'name'=>'aquatic','type'=>"text"],
                        (object)['label'=>__("phrase.$key.filter.terrestrial"),'name'=>'terrestrial','type'=>"text"],
                        (object)['label'=>__("phrase.$key.filter.poultry"),'name'=>'poultry','type'=>"text"],
                        (object)['label'=>__("phrase.$key.filter.reptile"),'name'=>'reptile','type'=>"text"],
                        (object)['label'=>__("phrase.$key.filter.arachnid-insect"),'name'=>'arachnid-insect','type'=>"text"],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>"text"],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>"text"],
                    ],
                    'filter' => [
                        'aquatic' => \App\Models\ChoiceMd::where('type','aquatic-animals')->select($select)->get(),
                        'terrestrial' => \App\Models\ChoiceMd::where('type','terrestrial-animal')->select($select)->get(),
                        'poultry' => \App\Models\ChoiceMd::where('type','poultry')->select($select)->get(),
                        'reptile' => \App\Models\ChoiceMd::where('type','reptile')->select($select)->get(),
                        'arachnid-insect' => \App\Models\ChoiceMd::where('type','arachnid-insect')->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where('type','farm-service')->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'space-for-rent-lifestyle': /*= 4.2.4 - 126 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>"text"],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>"text"]
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where('type','place-for-rent')->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'animal-hospital': /*= 4.3.1 - 127 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>"text"],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>"text"],
                        (object)['label'=>__("phrase.$key.filter.other"),'name'=>'other','type'=>"text"],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>"text"]
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where('type','animal-hospital')->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where('type','animal-hospital-service')->select($select)->get(),
                        'other' => \App\Models\ChoiceMd::where('type','animal-hospital-special-service')->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'beauty-clinic': /*= 4.3.2 - 128 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.beauty"),'name'=>'beauty','type'=>"text"],
                        (object)['label'=>__("phrase.$key.filter.disease"),'name'=>'disease','type'=>"text"],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>"text"]
                    ],
                    'filter' => [
                        'beauty' => \App\Models\ChoiceMd::where('type','beauty-clinic')->select($select)->get(),
                        'disease' => \App\Models\ChoiceMd::where('type','hospital')->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'tourist': /*= 4.4.1 - 129 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.attractions"),'name'=>'attractions','type'=>"text"],
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>"text"],
                        (object)['label'=>__("phrase.$key.filter.hiking-camping"),'name'=>'hiking-camping','type'=>"checkbox"],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>"text"]
                    ],
                    'filter' => [
                        'attractions' => \App\Models\ChoiceMd::where('type','tourist-attraction')->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where('type','tourist-attraction-service')->select($select)->get(),
                        // 'hiking-camping' => [],
                        'location' => $location
                    ]
                ];
                break;
            case 'accommodation': /*= 4.4.2 - 130 =*/
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.accommodates-pets"),'name'=>'accommodates-pets','type'=>"checkbox"],
                        (object)['label'=>__("phrase.$key.filter.type"),'name'=>'type','type'=>"text"],
                        (object)['label'=>__("phrase.$key.filter.facility"),'name'=>'facility','type'=>"text"],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>"text"]
                    ],
                    'filter' => [
                        'type' => \App\Models\ChoiceMd::where('type','type-of-accommodation')->select($select)->get(),
                        'facility' => \App\Models\ChoiceMd::where('type','facility')->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
        }

        return $data;
    }

    public static function myFilter($category=null,$company=null)
    {
        $lang = Session('lang');
        if (!$lang) { \App::setLocale('th'); $lang='th'; }
        $langP = $lang == 'th' ? 'th' : 'en';
        $key = ($category == null) ? request()->segment(2) : $category;

        $location = \App\Models\Filter\CpLocationMd::where('_id',$company)
            ->leftJoin('provinces as ch','cp_location.location','=','ch.province_id')
            ->select('province_id as key',"province_name_$langP as name")
            ->get();

        $select = ["ch.key","ch.name_$lang as name"];
        $choice = "choice as ch";
        switch ($key) {
            case 'electrical-appliance': /*= 1.1.1 - 1 =*/
                $data = [
                    'type' => \App\Models\Filter\CpApplianceMd::select('ch.key',"ch.name_$lang as name")
                        ->where(['ch.type'=>'electrical-appliance','cp_appliance._id'=>$company])
                        ->leftJoin($choice,'cp_appliance.appliance','=','ch.key')
                        ->get()->toJson(),
                    'brand' => \App\Models\Filter\CpBrandMd::select("ch.key","ch.name_$lang as name")
                        ->where(['ch.type'=>'electrical-appliance-brand','cp_brand._id'=>$company])
                        ->leftJoin($choice,'cp_brand.brand','=','ch.key')
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'office-appliance': /*= 1.1.2 - 2 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select('ch.key',"ch.name_$lang as name")
                        ->where(['ch.type'=>'office-supplies-type','cp_type._id'=>$company])
                        ->leftJoin("choice as ch","cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'home-appliance': /*= 1.1.3 - 3 =*/
                $data = [
                    'product' => \App\Models\Filter\CpProductMd::select($select)
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->where(['ch.type'=>'product-category','cp_product._id'=>$company])
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'ceremony-appliance': /*= 1.1.4 - 4 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->where(["ch.type"=>'type-of-ceremony','cp_type._id'=>$company])
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'baby-appliance':  /*= 1.1.5 - 5 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->where(["ch.type"=>'baby-supplies-type','cp_type._id'=>$company])
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'home-decoration': /*= 1.1.6 - 6 =*/
                $data = [
                    'installation' => \App\Models\Filter\CpTypeMd::select($select)
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->where(["ch.type"=>'type-by-installation','cp_type._id'=>$company,'cp_type.type'=>'type-by-installation'])
                        ->get()->toJson(),
                    'furniture' => \App\Models\Filter\CpTypeMd::select($select)
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->where(["ch.type"=>'type-of-furniture','cp_type._id'=>$company,'cp_type.type'=>'type-of-furniture'])
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'costume-and-beauty': /*= 1.1.7 - 7 =*/
                $data = [
                    'costume' => \App\Models\Filter\CpProductMd::select($select)
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->where(["ch.type"=>"costume","cp_product._id" => $company,'cp_product.type'=>'costume'])
                        ->get()->toJson(),
                    'accessories' => \App\Models\Filter\CpProductMd::select($select)
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->where(["ch.type"=>'accessories','cp_product._id' => $company,'cp_product.type'=>'accessories'])
                        ->get()->toJson(),
                    'beauty' => \App\Models\Filter\CpProductMd::select($select)
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->where(["ch.type"=>'beauty','cp_product._id' => $company,'cp_product.type'=>'beauty'])
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'automotive-spareparts': /*= 1.1.8 - 8 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->where([
                            "ch.type"=>'sales-type',
                            'cp_type.type'=>'sales-type',
                            'cp_type._id'=>$company,
                            ])
                        ->get()->toJson(),
                    'automotive' => \App\Models\Filter\CpTypeMd::select($select)
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->where([
                            "ch.type"=>'automotive-type',
                            'cp_type.type'=>'automotive-type',
                            'cp_type._id'=>$company,
                        ])
                        ->get()->toJson(),
                    'spare-parts' => \App\Models\Filter\CpProductMd::select($select)
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->where(["ch.type"=>"spare-parts","cp_product._id"=>$company])
                        ->get()->toJson(),
                    'brand' => \App\Models\Filter\CpBrandMd::select($select)
                        ->leftJoin($choice,"cp_brand.brand","=","ch.key")
                        ->where(["ch.type"=>"car-brand","cp_brand._id"=>$company])
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'music-audio': /*= 1.1.9 - 9 =*/
                $data = [
                    'thai-music' => \App\Models\Filter\CpTypeMd::select($select)
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->where(['ch.type'=>'thai-music', 'cp_type._id'=>$company,'cp_type.type'=>'thai-music'])
                        ->get()->toJson(),
                    'universal-music' => \App\Models\Filter\CpTypeMd::select($select)
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->where(['ch.type'=>'universal-music', 'cp_type._id'=>$company,'cp_type.type'=>'universal-music'])
                        ->get()->toJson(),
                    'other-music-device' => \App\Models\Filter\CpOtherMd::select($select)
                        ->leftJoin($choice,"cp_other.other","=","ch.key")
                        ->where(['ch.type'=>'other-music-device','cp_other._id'=>$company])
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'sport': /*= 1.1.10 - 10 =*/
                $data = [
                    'equipment' => \App\Models\Filter\CpEquipmentMd::select('equipment as key')
                        ->where("_id",$company)
                        ->get()->toJson(),
                    'sport' => \App\Models\Filter\CpTypeMd::select($select)
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->where(['ch.type'=>'type-of-sport','cp_type._id'=>$company])
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'construction-materials': /*= 1.1.11 - 11 =*/
                $data = [
                    'construction-materials' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"construction-materials","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'chemicals': /*= 1.1.12 - 12 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->where(["ch.type"=>"type-of-chemicals",'cp_type._id'=>$company])
                        ->get(),
                    'location' => $location
                ];
                break;
            case 'packaging': /*= 1.1.13 - 13 =*/
                $data = [
                    'packaging' => \App\Models\Filter\CpPackagingMd::select($select)
                        ->where(['ch.type'=>'packaging','cp_packaging._id'=>$company])
                        ->leftJoin($choice,"cp_packaging.packaging","=","ch.key")
                        ->get()->toJson(),
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(['ch.type'=>'packaging-type','cp_type._id'=>$company,])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'material' => \App\Models\Filter\CpMaterialMd::select($select)
                        ->leftJoin($choice,"cp_material.material","=","ch.key")
                        ->where(['ch.type'=>'packaging-materials','cp_material._id'=>$company])
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(['ch.type'=>'package-other','cp_service._id'=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'other-product': /*= 1.1.14 - 14  =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"other-product-type", "cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'food': /*= 1.2.1 - 15 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"food-type","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'drinks': /*= 1.2.2 - 16 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"beverage-type","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'factory-equipment': /*= 1.3.1 - 17 =*/
                $data = [
                    'products-for-factories' => \App\Models\Filter\CpProductMd::select($select)
                        ->where([
                            "ch.type"=>"products-for-factories",
                            "cp_product.type" => "products-for-factories",
                            "cp_product._id"=>$company,
                        ])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'electric-tools-and-accessories' => \App\Models\Filter\CpProductMd::select($select)
                        ->where([
                            "ch.type" => "electric-tools-and-accessories",
                            "cp_product.type" => "electric-tools-and-accessories",
                            "cp_product._id" => $company
                        ])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'warehouse-equipment' => \App\Models\Filter\CpProductMd::select($select)
                        ->where([
                            "ch.type" => "warehouse-equipment",
                            "cp_product.type" => 'warehouse-equipment',
                            "cp_product._id" => $company
                        ])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'general-equipment-for-factory' => \App\Models\Filter\CpProductMd::select($select)
                        ->where([
                            "ch.type" => "general-equipment-for-factory",
                            'cp_product.type' => 'general-equipment-for-factory',
                            "cp_product._id" => $company
                        ])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get(),
                    'accessories-factory' => \App\Models\Filter\CpProductMd::select($select)
                        ->where([
                            "ch.type" => "accessories-factory",
                            "cp_product.type" => 'accessories-factory',
                            "cp_product._id" => $company
                        ])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'hand-tool': /*= 1.3.2 - 18 =*/
                $data = [
                    'type'=> \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"mechanic-tools-type","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'machine-parts': /*= 1.3.3 - 19 =*/
                $data = [
                    'machine-type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"machine-type","cp_type._id"=>$company,'cp_type.type'=>'machine-type'])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'machine-working-pattern' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"machine-working-pattern","cp_type._id"=>$company,'cp_type.type'=>'machine-working-pattern'])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'overhaul' => \App\Models\Filter\CpOverhaulMd::select('overhaul as key')
                        ->where("_id",$company)
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'medicines': /*= 1.4.1 - 20 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"type-of-medication","cp_type._id"=>$company,'cp_type.type'=>'type-of-medication'])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'supplementary'=> \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"supplementary-food","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'drug-utilization' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"drug-utilization","cp_type._id"=>$company,'cp_type.type'=>'drug-utilization'])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'medical-equipment': /*= 1.4.2 - 21 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"medical-instruments-and-apparatus","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'visa-support': /*= 1.5.1 - 22 =*/
                $data = [
                    'type' => \App\Models\Filter\CpVisaMd::select($select)
                        ->leftJoin($choice,'cp_visa.visa','=','ch.key')
                        ->where(['cp_visa._id' => $company, 'ch.type'=> 'type-of-visa'])
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'company-register': /*= 1.5.2 - 23 =*/
                $data = [
                    'consulting' => \App\Models\Filter\CpConsultingMd::select("ch.id as key","ch.name_$lang as name")
                        ->leftJoin("consulting as ch","cp_consulting.consulting","=","ch.id")
                        ->where(['cp_consulting._id'=>$company])
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select("ch.key","ch.name_$lang as name")
                        ->leftJoin("choice as ch","cp_service.service","=","ch.key")
                        ->where(['cp_service._id'=>$company,'ch.type'=>'setting-service'])
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'law-firm': /*= 1.5.3 - 24 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->where(['ch.type'=>'type-of-lawsuit','cp_type._id'=>$company])
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->leftJoin("choice as ch","cp_service.service","=","ch.key")
                        ->where(['ch.type'=>'service-of-lawfirm','cp_service._id'=>$company])
                        ->get()->toJson(),
                    'language' => \App\Models\Filter\CpLanguageMd::select($select)
                        ->leftJoin("choice as ch","cp_language.language","=","ch.key")
                        ->where(['ch.type'=>'law-firm-language','cp_language._id'=>$company])
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'space-for-rent': /*= 1.5.4 - 25 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"type-of-space-for-rent","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"co-working-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'period' => \App\Models\Filter\CpPeriodMd::select($select)
                        ->where(["ch.type"=>"space-contract-period","cp_period._id"=>$company])
                        ->leftJoin($choice,"cp_period.period","=","ch.key")
                        ->get()->toJson(),
                    'seat' => \App\Models\Filter\CpSeatMd::select($select)
                        ->where(["ch.type"=>"co-working-seat","cp_seat._id"=>$company])
                        ->leftJoin($choice,"cp_seat.seat","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'consultant': /*= 1.5.5 - 26 =*/
                $data = [
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"consultant-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'translater': /*= 1.5.6 - 27 =*/
                $data = [
                    'urgent' => \App\Models\Filter\CpUrgentMd::where("_id",$company)
                        ->select("urgent as key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::where("cp_service._id",$company)
                        ->where(['ch.type'=>'translator-interpreter-service','cp_service._id'=>$company])
                        ->leftJoin($choice,'cp_service.service','=','ch.key')
                        ->select($select)
                        ->get()->toJson(),
                    'translate' => \App\Models\Filter\CpTranslateMd::where("cp_translate._id",$company)
                        ->leftJoin("translate as ch","cp_translate.translate","=","ch.id")
                        ->select('ch.id as key','ch.name_th as name')
                        ->get()->toJson(),
                    'speciality' => \App\Models\Filter\CpSpecialityMd::where("cp_speciality._id",$company)
                        ->where(['ch.type'=>'translator-interpreter-documents','cp_speciality._id'=>$company])
                        ->leftJoin($choice,"cp_speciality.speciality","=","ch.key")
                        ->select($select)
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'accounting': /*= 1.5.7 - 28 =*/
                $data = [
                    'service' => \App\Models\Filter\CpServiceMd::where(['ch.type'=>'account' ,'cp_service._id'=>$company, 'ch.type'=>'account-service'])
                        ->leftJoin("choice as ch","cp_service.service","=","ch.key")
                        ->select($select)
                        ->get()->toJson(),
                    'other' => \App\Models\Filter\CpOtherMd::where(['ch.type'=>'account', 'cp_other._id'=>$company, 'ch.type'=>'account-other'])
                        ->leftJoin("choice as ch","cp_other.other","=","ch.key")
                        ->select($select)
                        ->get()->toJson(),
                    'nationality' => \App\Models\Filter\CpNationalityMd::where('cp_nationality._id',$company)
                        ->leftJoin("countries as ch","cp_nationality.nationality","=","ch.id")
                        ->select("ch.id as key","ch.country as name")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'prefabricated-office': /*= 1.5.8 - 29 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->where(['ch.type'=>'co-working-type', 'cp_type._id'=>$company])
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->leftJoin("choice as ch","cp_service.service","=","ch.key")
                        ->where(['ch.type'=>'co-working-service', 'cp_service._id'=>$company])
                        ->get()->toJson(),
                    'seat' => \App\Models\Filter\CpSeatMd::select($select)
                        ->where(["ch.type"=>"co-working-seat","cp_seat._id"=>$company])
                        ->leftJoin($choice,"cp_seat.seat","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'logistics': /*= 1.6.1 - 30 =*/
                $data = [
                    'domestic' => \App\Models\Filter\CpDomesticMd::where('_id',$company)
                        ->select('transport as key')
                        ->get()->toJson(),
                    'packaging' => \App\Models\Filter\CpPackagingMd::where('_id',$company)
                        ->select('packaging as key')
                        ->get()->toJson(),
                    'international' => \App\Models\Filter\CpInternationalMd::where(['international._id'=>$company,'ch.type'=>'transport'])
                        ->leftJoin($choice,'international.transport','=','ch.key')
                        ->select('international.transport as key',"ch.name_$lang as name")
                        ->get()->toJson(),
                    'method' => \App\Models\Filter\CpMethodMd::where(['cp_method._id'=>$company,'ch.type'=>'methods'])
                        ->leftJoin($choice,'cp_method.method','=','ch.key')
                        ->select('method as key',"ch.name_$lang as name")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::where(['cp_service._id'=>$company,'ch.type'=>'services'])
                        ->leftJoin($choice,'cp_service.service','=','ch.key')
                        ->select('service as key',"ch.name_$lang as name")
                        ->get()->toJson(),
                    'item' => \App\Models\Filter\CpItemMd::select($select)
                        ->where(['cp_item._id'=>$company,'ch.type'=>'warehouse'])
                        ->leftJoin($choice,'cp_item.item','=','ch.key')
                        ->get()->toJson(),
                    'warehouse' => \App\Models\Filter\CpWarehouseMd::where('_id',$company)
                        ->leftJoin('provinces as pro','cp_warehouse.warehouse','=','pro.province_id')
                        ->select('warehouse as key',"pro.province_name_$langP as name")
                        ->get()->toJson(),
                    'location' => $location,
                ];
                break;
            case 'warehouse': /*= 1.6.2 - 31 =*/
                $data = [
                    'type' => \App\Models\Filter\CpWarehouseMd::select($select)
                        ->where(["ch.type"=>"stock","cp_warehouse._id"=>$company])
                        ->leftJoin($choice,"cp_warehouse.warehouse","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'forklift': /*= 1.6.3 - 32 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(['ch.type'=>'forklift-type','cp_type._id'=>$company])
                        ->leftJoin("choice as ch","cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'fuel' => \App\Models\Filter\CpFuelMd::select($select)
                        ->where(['ch.type'=>'fuel-system','cp_fuel._id'=>$company])
                        ->leftJoin("choice as ch","cp_fuel.fuel","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(['ch.type'=>'sales-type','cp_service._id'=>$company])
                        ->leftJoin("choice as ch","cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'rental' => \App\Models\Filter\CpRentalMd::select($select)
                        ->where(['ch.type'=>'construction-rental','cp_rental._id'=>$company])
                        ->leftJoin($choice,"cp_rental.rental","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'heavy-machinery': /*= 1.6.4 - 33 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"construction-type","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'fuel' => \App\Models\Filter\CpFuelMd::select($select)
                        ->where(["ch.type"=>"fuel-system","cp_fuel._id"=>$company])
                        ->leftJoin($choice,"cp_fuel.fuel","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"sales-type","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'rental' => \App\Models\Filter\CpRentalMd::select($select)
                        ->where(["ch.type"=>"construction-rental","cp_rental._id"=>$company])
                        ->leftJoin($choice,"cp_rental.rental","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'transportation-warehouse-equipment': /*= 1.6.5 - 34 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"transportation-warehouse-equipment","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'credit-loan': /*= 1.7.1 - 35 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"leasing-type","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'insurance': /*= 1.7.2 - 36 =*/
                $data = [
                    'personality' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where([
                            'ch.type' => 'personal-insurance',
                            'cp_service.type' => 'personal-insurance',
                            'cp_service._id' => $company
                        ])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'property' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where([
                            'ch.type' => 'property-insurance',
                            'cp_service.type' => "property-insurance",
                            'cp_service._id' => $company
                        ])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'business' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where([
                            'ch.type' => 'insurance-business',
                            'cp_service.type' => 'insurance-business',
                            'cp_service._id' => $company
                        ])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'pets' => \App\Models\Filter\CpTypeMd::select("_type as key")
                        ->where(['type' => 'pets', '_id' => $company])
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'financial': /*= 1.7.3 - 37  =*/
                $data = [
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"financial-institution-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'online-marketing': /*= 1.8.1 - 38 =*/
                $data = [
                    'language' => \App\Models\Filter\CpLanguageMd::where(['ch.type'=>'marketing-language','cp_language._id'=>$company])
                        ->leftJoin($choice,"cp_language.language","=","ch.key")
                        ->select($select)
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::where(['ch.type'=>'marketing-service','cp_service._id'=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->select($select)
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'it-hardware': /*= 1.8.2 - 39 =*/
                $data = [
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"it-hardware-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'hardware' => \App\Models\Filter\CpHardwareMd::select($select)
                        ->where(["ch.type"=>"it-hardware","cp_hardware._id"=>$company])
                        ->leftJoin($choice,"cp_hardware.hardware","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'web-system': /*= 1.8.3 - 40 =*/
                $data = [
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(['ch.type'=>'web-service','cp_service._id'=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'other' => \App\Models\Filter\CpOtherMd::select($select)
                        ->where(['ch.type'=>'web-other-service','cp_other._id'=>$company])
                        ->leftJoin($choice,"cp_other.other","=","ch.key")
                        ->get()->toJson(),
                    'language' => \App\Models\Filter\CpLanguageMd::select($select)
                        ->where(['ch.type'=>'web-language ','cp_language._id'=>$company])
                        ->leftJoin($choice,"cp_language.language","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'software-development': /*= 1.8.4 - 41 =*/
                $data = [
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"software-development-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'software' => \App\Models\Filter\CpSoftwareMd::select($select)
                        ->where(["ch.type"=>"software-development","cp_software._id"=>$company])
                        ->leftJoin($choice,"cp_software.software","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'printing': /*= 1.9.1 - 42 =*/
                $data = [
                    'type' => \App\Models\Filter\CpPrintingMd::select($select)
                        ->leftJoin($choice,"cp_printing.printing","=","ch.key")
                        ->where(["ch.type"=>"type-printing","cp_printing._id"=>$company])
                        ->get()->toJson(),
                    'minimum' => \App\Models\Filter\CpMinimumMd::select($select)
                        ->leftJoin($choice,"cp_minimum.minimum","=","ch.key")
                        ->where(["ch.type"=>"service-minimum","cp_minimum._id"=>$company])
                        ->get()->toJson(),
                    'other' => \App\Models\Filter\CpOtherMd::select($select)
                        ->where(["ch.type"=>"printing-other","cp_other._id"=>$company])
                        ->leftJoin($choice,"cp_other.other","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'advertising': /*= 1.9.2 - 43  =*/
                $data = [
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"advertising-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'other' => \App\Models\Filter\CpOtherMd::select($select)
                        ->where(["ch.type"=>"advertising-additional-service","cp_other._id"=>$company])
                        ->leftJoin($choice,"cp_other.other","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'car-rental': /*= 1.10.1 - 44 =*/
                $data = [
                    'type' => \App\Models\Filter\CpCarTypeMd::select($select)
                        ->leftJoin($choice,'cp_cartype.type','=','ch.key')
                        ->where(['ch.type'=>'car','cp_cartype._id'=>$company])
                        ->get(),
                    'period' => \App\Models\Filter\CpPeriodMd::select($select)
                        ->leftJoin($choice,"cp_period.period","=","ch.key")
                        ->where(['ch.type'=>'contract-period','cp_period._id'=>$company])
                        ->get(),
                    'other' => \App\Models\Filter\CpConditionMd::select($select)
                        ->leftJoin('choice as ch','cp_condition.condition','=','ch.key')
                        ->where(['ch.type'=>'other-conditions','cp_condition._id'=>$company]),
                    'location' => $location
                ];
                break;
            case 'public-transportation': /*= 1.10.2 - 45  =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"public-transportation","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'pick-up-point' => \App\Models\Filter\CpLocationMd::select('province_id as key',"province_name_$langP as name")
                        ->leftJoin('provinces as ch','cp_location.location','=','ch.province_id')
                        ->where(['_id'=>$company,'cp_location.type'=>'pick-up-point'])
                        ->get()->toJson(),
                    'destination' => \App\Models\Filter\CpLocationMd::select('province_id as key',"province_name_$langP as name")
                        ->leftJoin('provinces as ch','cp_location.location','=','ch.province_id')
                        ->where(['_id'=>$company,'cp_location.type'=>'destination'])
                        ->get()->toJson(),
                    'location' => \App\Models\Filter\CpLocationMd::select('province_id as key',"province_name_$langP as name")
                        ->leftJoin('provinces as ch','cp_location.location','=','ch.province_id')
                        ->where(['_id'=>$company,'cp_location.type'=>'location'])
                        ->get()->toJson(),
                ];
                break;
            case 'security-system': /*= 1.11.1 - 46 =*/
                $data = [
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(['ch.type'=>'security-system-service','cp_service._id'=>$company])
                        ->leftJoin("choice as ch","cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'recruitment': /*= 1.11.2 - 47 =*/
                $data = [
                    'position' => \App\Models\Filter\CpPositionMd::select($select)
                        ->where(['ch.type'=>'recruitment-position','cp_position._id'=>$company])
                        ->leftJoin($choice,"cp_position.position","=","ch.key")
                        ->get()->toJson(),
                    'nationality' => \App\Models\Filter\CpNationalityMd::select($select)
                        ->where(['ch.type'=>'recruitment-nationality', 'cp_nationality._id'=>$company])
                        ->leftJoin($choice,"cp_nationality.nationality","=","ch.key")
                        ->get()->toJson(),
                    'employment' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(['ch.type'=>'type-recruitment','cp_type._id'=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'organizer': /*= 1.12.1 - 48 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"get-a-party-type","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"get-a-party-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'land-survey': /*= 1.12.2 - 49 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"property-type","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"valuation-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'gardening': /*= 1.12.3 - 50 =*/
                $data = [
                    'service' =>\App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"gardening-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'studio': /*= 1.12.4 - 51 =*/
                $data = [
                    'model' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"photography-studio-type-service","cp_service._id"=>$company,'cp_service.type'=>'photography-studio-type-service'])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"photography-studio-type","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"photography-studio-service","cp_service._id"=>$company,'cp_service.type'=>'photography-studio-service'])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'cleaning': /*= 1.12.5 - 52 =*/
                $data = [
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"clean-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'insecticide': /*= 1.12.6 - 53 =*/
                $data = [
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"insecticide-service","cp_service.type"=>"insecticide-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'service-location' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"insecticide-site","cp_service.type"=>"insecticide-site","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'other-general': /*= 1.12.7 - 54 =*/
                $data = [
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"other-service-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'machinery-repair': /*= 1.13.1 - 55 =*/
                $data = [
                    'type' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"machine-type","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'work-pattern' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"machine-working-pattern","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'overhaul' => \App\Models\Filter\CpOverhaulMd::select('overhaul as key')
                        ->where("_id",$company)
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'electronics-repair': /*= 1.13.2 - 56 =*/
                $data = [
                    'electrical-appliance' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"electrical-appliance","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'brand' => \App\Models\Filter\CpBrandMd::select($select)
                        ->where(["ch.type"=>"electrical-appliance-brand-repair","cp_brand._id"=>$company])
                        ->leftJoin($choice,"cp_brand.brand","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'automotive-repair': /*= 1.13.3 - 57 =*/
                $data = [
                    'sales-type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"sales-type-automotive","cp_type.type"=>"sales-type-automotive","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'automotive-type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"automotive-type","cp_type.type"=>"automotive-type","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'spare-parts' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"spare-parts","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'brand' => \App\Models\Filter\CpBrandMd::select($select)
                        ->where(["ch.type"=>"car-brand","cp_brand._id"=>$company])
                        ->leftJoin($choice,"cp_brand.brand","=","ch.key")
                        ->get()->toJson(),
                    'towing-service' => \App\Models\Filter\CpServiceMd::select("service as key")
                        ->where(["cp_service._id"=>$company])
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'textiles-repair': /*= 1.13.4 - 58 =*/
                $data = [
                    'costume' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"costume","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'accessories-repair': /*= 1.13.5 - 59 =*/
                $data = [
                    'accessories' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"accessories","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'watersupply-repair': /*= 1.13.6 - 60 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"type-of-repair","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select('service as key')
                        ->where("_id",$company)
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'furniture-repair': /*= 1.13.7 - 61 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"type-by-installation","cp_type._id"=>$company,'cp_type.type'=>'type-by-installation'])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'usage' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"type-according-to-use","cp_type._id"=>$company,'cp_type.type'=>'type-according-to-use'])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'machines-for-stamping': /*= 2.1.1 - 62 =*/
                $data = [
                    'usage' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"usage","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'material' => \App\Models\Filter\CpMaterialMd::select($select)
                        ->where(["ch.type"=>"material","cp_material._id"=>$company])
                        ->leftJoin($choice,"cp_material.material","=","ch.key")
                        ->get()->toJson(),
                    'compression' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"compression","cp_service._id"=>$company,"cp_service.type"=>"compression"])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"stamping-service","cp_service._id"=>$company,"cp_service.type"=>"stamping-service"])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'distribute' => \App\Models\Filter\CpDistributeMd::select("distribute as key")
                        ->where(["cp_distribute._id"=>$company])
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'machines-for-folding': /*= 2.1.2 - 63 =*/
                $data = [
                    'bending-machine' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"bending-machine","cp_product._id"=>$company,"cp_product.type"=>"bending-machine"])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'folding-machine' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"folding-machine","cp_product._id"=>$company,"cp_product.type"=>"folding-machine"])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'materials' => \App\Models\Filter\CpMaterialMd::select($select)
                        ->where(["ch.type"=>"materials-folding-bending","cp_material._id"=>$company])
                        ->leftJoin($choice,"cp_material.material","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"folding-bending-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'distribute' => \App\Models\Filter\CpDistributeMd::select("distribute as key")
                        ->where(["cp_distribute._id"=>$company])
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'machines-for-casting': /*= 2.1.3 - 64 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"machines-forming","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'material' => \App\Models\Filter\CpMaterialMd::select($select)
                        ->where(["ch.type"=>"material","cp_material._id"=>$company])
                        ->whereIn('key',[1,3,4,5])
                        ->leftJoin($choice,"cp_material.material","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"machines-forming-service", "cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'distribute' => \App\Models\Filter\CpDistributeMd::select("distribute as key")
                        ->where(["cp_distribute._id"=>$company])
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'machines-for-dressing': /*= 2.1.4 - 65 =*/
                $data = [
                    'cutter' => \App\Models\Filter\CpProductMd::select($select)
                        ->where([
                            "ch.type" => "type-of-cutter",
                            "cp_product.type" => "type-of-cutter",
                            "cp_product._id" => $company
                        ])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'drilling' => \App\Models\Filter\CpProductMd::select($select)
                        ->where([
                            "ch.type" => "type-of-drilling-machine",
                            "cp_product.type" => "type-of-drilling-machine",
                            "cp_product._id" => $company
                        ])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'lathe' => \App\Models\Filter\CpProductMd::select($select)
                        ->where([
                            "ch.type" => "type-of-lathe",
                            "cp_product.type" => "type-of-lathe",
                            "cp_product._id" => $company
                        ])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'grinding' => \App\Models\Filter\CpProductMd::select($select)
                        ->where([
                            "ch.type" => "type-of-grinding-machine",
                            "cp_product.type" => "type-of-grinding-machine",
                            "cp_product._id" => $company
                        ])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'material' => \App\Models\Filter\CpMaterialMd::select($select)
                        ->where(["ch.type"=>"materials-for-cutting/drilling/lathe/grinding","cp_material._id"=>$company])
                        ->leftJoin($choice,"cp_material.material","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"service-for-machines","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'distribute' => \App\Models\Filter\CpDistributeMd::select("distribute as key")
                        ->where(["cp_distribute._id"=>$company])
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'machines-for-compression': /*= 2.1.5 - 66 =*/
                $data = [
                    'compactor' => \App\Models\Filter\CpProductMd::select($select)
                        ->where([
                            "ch.type" => "type-of-compactor",
                            "cp_product.type" => "type-of-compactor",
                            "cp_product._id" => $company
                        ])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'injection' => \App\Models\Filter\CpProductMd::select($select)
                        ->where([
                            "ch.type" => "type-of-injection-machine",
                            "cp_product.type" => "type-of-injection-machine",
                            "cp_product._id" => $company
                        ])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'material' => \App\Models\Filter\CpMaterialMd::select($select)
                        ->where(["ch.type"=>"material-for-compression/injection","cp_material._id"=>$company])
                        ->leftJoin($choice,"cp_material.material","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"compression-injection-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'distribute' => \App\Models\Filter\CpDistributeMd::select("distribute as key")
                        ->where(["cp_distribute._id"=>$company])
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'machines-for-rolling': /*= 2.1.6 - 67 =*/
                $data = [
                    "type" =>  \App\Models\Filter\CpProductMd::select($select)
                        ->where([
                            "ch.type" => "type-of-rolling-machine",
                            "cp_product._id" => $company
                        ])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    "service" => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"rolling-machine-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'distribute' => \App\Models\Filter\CpDistributeMd::select("distribute as key")
                        ->where(["cp_distribute._id"=>$company])
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'machines-for-welding': /*= 2.1.7 - 68 =*/
                $data = [
                    "type" =>  \App\Models\Filter\CpProductMd::select($select)
                        ->where([
                            "ch.type" => "type-of-welding-machine",
                            "cp_product._id" => $company
                        ])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    "service" => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"welding-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'distribute' => \App\Models\Filter\CpDistributeMd::select("distribute as key")
                        ->where(["cp_distribute._id"=>$company])
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'other-machinery': /*= 2.1.8 - 69 =*/
                $data = [
                    'location' => $location
                ];
                break;
            case 'forklift-industry': /*= 2.2.1 - 70 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"forklift-type-industry","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'fuel-system' => \App\Models\Filter\CpFuelMd::select($select)
                        ->where(["ch.type"=>"fuel-system","cp_fuel._id"=>$company])
                        ->leftJoin($choice,"cp_fuel.fuel","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'heavy-machinery-industry': /*= 2.2.2 - 71 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"construction-type","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'fuel-system' => \App\Models\Filter\CpFuelMd::select($select)
                        ->where(["ch.type"=>"fuel-system","cp_fuel._id"=>$company])
                        ->leftJoin($choice,"cp_fuel.fuel","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'automotive': /*= 2.2.3 - 72 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"automotive-type","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'spare-parts' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"spare-parts","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'brand' => \App\Models\Filter\CpBrandMd::select($select)
                        ->where(["ch.type"=>"car-brand","cp_brand._id"=>$company])
                        ->leftJoin($choice,"cp_brand.brand","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'mold': /*= 2.3.1 - 73 =*/
                $data = [
                    'usage' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"mold-usage-pattern","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    "service" => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"mold-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'machine-tools': /*= 2.4.1 - 74 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type" => "type-of-machine-tool", "cp_type._id" => $company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'measuring-tools': /*= 2.4.2 - 75 =*/
                $data = [
                    'kind' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where([
                            "ch.type"=>"kind-of-measuring-tool",
                            "cp_type.type"=>"kind-of-measuring-tool",
                            "cp_type._id"=>$company
                        ])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where([
                            "ch.type"=>"type-of-measuring-tool",
                            "cp_type.type"=>"type-of-measuring-tool",
                            "cp_type._id"=>$company
                        ])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'hand-tool-industry': /*= 2.4.3 - 76 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type" => "mechanic-tools-type", "cp_type._id" => $company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'improve-texture': /*= 2.5.1 - 77 =*/
                $data = [
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"improve-texture-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'products' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"products-for-plating/coating","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'production-model' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type" => "type-of-plating/coating", "cp_type._id" => $company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'baby-appliance-industry': /*= 2.6.1 - 78 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"baby-supplies-type","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'ceremony-appliance-industry': /*= 2.6.2 - 79 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"type-of-ceremony","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'jewelry-beauty-industry': /*= 2.6.3 - 80 =*/
                $data = [
                    'accessories' => \App\Models\Filter\CpProductMd::select($select)
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->where(["ch.type"=>'accessories','cp_product._id'=>$company])
                        ->get()->toJson(),
                    'beauty' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"beauty","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'kitchen-appliance-industry': /*= 2.6.4 - 81 =*/
                $data = [
                    'category' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>'product-category','cp_product._id'=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'music-audio-industry': /*= 2.6.5 - 82 =*/
                $data = [
                    'thai-music' => \App\Models\Filter\CpTypeMd::select($select)
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->where([
                            'ch.type'=>'thai-music',
                            'cp_type._id'=>$company,
                            'cp_type.type'=>'thai-music'
                            ])
                        ->whereIn('key',[1,2,3,4])
                        ->get()->toJson(),
                    'universal-music' => \App\Models\Filter\CpTypeMd::select($select)
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->where([
                            'ch.type'=>'universal-music',
                            'cp_type._id'=>$company,
                            'cp_type.type'=>'universal-music'
                        ])
                        ->whereIn('key',[1,2,3,4,5])
                        ->get()->toJson(),
                    'other-music-device' => \App\Models\Filter\CpOtherMd::select($select)
                        ->leftJoin($choice,"cp_other.other","=","ch.key")
                        ->where(['ch.type'=>'other-music-device','cp_other._id'=>$company])
                        ->get()->toJson(),
                    'location' => $location
                    ];
                break;
            case 'sport-industry': /*= 2.6.6 - 83 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"type-of-sport","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'products' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"sports-products","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'foods-industry': /*= 2.7.1 - 84 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"food-type","cp_type._id"=>$company])
                        ->whereNotIn('key',[13,14])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"food-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'drinks-industry': /*= 2.7.2 - 85 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"beverage-type","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"beverage-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'home-decoration-industry': /*= 2.8.1 - 86 =*/
                $data = [
                    'minimum' => \App\Models\Filter\CpMinimumMd::select("minimum as key")
                        ->where(["cp_minimum._id"=>$company])
                        ->get()->toJson(),
                    'made-to-order' => \App\Models\Filter\CpOrderMd::select("order as key")
                        ->where(["cp_order._id"=>$company])
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"furniture-decorations-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'materials' => \App\Models\Filter\CpMaterialMd::select($select)
                        ->where(["ch.type"=>"furniture-decorations-material","cp_material._id"=>$company])
                        ->leftJoin($choice,"cp_material.material","=","ch.key")
                        ->get()->toJson(),
                    'installation' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"type-by-installation","cp_type._id"=>$company,"cp_type.type"=>"type-by-installation"])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'product' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"furniture-decorations-product-type","cp_type._id"=>$company,"cp_type.type"=>"furniture-decorations-product-type"])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'office-appliance-industry': /*= 2.9.1 - 87 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"office-supplies-type","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'electric-kitchen-appliance': /*= 2.10.1 - 88 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"electrical-appliance","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'factory-electrical-appliance': /*= 2.10.2 - 89 =*/
                $data = [
                    'type'=>\App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"types-of-electrical-appliances","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'power-generation': /*= 2.11.1 - 90 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"power-generation-system","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"solar-cells-wind-turbines-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'agreement' => \App\Models\Filter\CpConditionMd::select($select)
                        ->where(["ch.type"=>"solar-cells-wind-turbines-trading-agreement","cp_condition._id"=>$company])
                        ->leftJoin($choice,"cp_condition.condition","=","ch.key")
                        ->get()->toJson(),
                    'turbine' => \App\Models\Filter\CpManufactorMd::select("manufactor as key")
                        ->where(["cp_manufactor._id"=>$company])
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'electrical-appliance-industry': /*= 2.12.1 - 91 =*/
                $data = [
                    'electrical' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"type-of-electrical-equipment","cp_type._id"=>$company,"cp_type.type"=>"type-of-electrical-equipment"])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'electronic' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"electronic-device-type","cp_type._id"=>$company,"cp_type.type"=>"electronic-device-type"])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'steel-metal-material': /*= 2.13.1 - 92 =*/
                $data = [
                    'material' => \App\Models\Filter\CpMaterialMd::select($select)
                        ->where(["ch.type"=>"steel-metal-material","cp_material._id"=>$company])
                        ->leftJoin($choice,"cp_material.material","=","ch.key")
                        ->get()->toJson(),
                    'product' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"steel-metal-product","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"steel-metal-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'wood': /*= 2.13.2 - 93 =*/
                $data = [
                    'wood' => \App\Models\Filter\CpMaterialMd::select($select)
                        ->where(["ch.type"=>"type-of-wood","cp_material._id"=>$company])
                        ->leftJoin($choice,"cp_material.material","=","ch.key")
                        ->get()->toJson(),
                    'product' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"wood-product","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"wood-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'rubber': /*= 2.13.3 - 94 =*/
                $data = [
                    'type' => \App\Models\Filter\CpMaterialMd::select($select)
                        ->where(["ch.type"=>"type-of-rubber","cp_material._id"=>$company])
                        ->leftJoin($choice,"cp_material.material","=","ch.key")
                        ->get()->toJson(),
                    'product' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"rubber-product","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"rubber-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'plastic': /*= 2.13.4 - 95 =*/
                $data = [
                    'type' => \App\Models\Filter\CpMaterialMd::select($select)
                        ->where(["ch.type"=>"type-of-plastic","cp_material._id"=>$company])
                        ->leftJoin($choice,"cp_material.material","=","ch.key")
                        ->get()->toJson(),
                    'product' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"plastics-product","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"plastic-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'glass': /*= 2.13.5 - 96 =*/
                $data = [
                    'type' => \App\Models\Filter\CpMaterialMd::select($select)
                        ->where(["ch.type"=>"type-of-glass","cp_material._id"=>$company])
                        ->leftJoin($choice,"cp_material.material","=","ch.key")
                        ->get()->toJson(),
                    'product' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"glass-products","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"glass-services","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'chemicals-industry': /*= 2.14.1 - 97 =*/
                $data = [
                    'for-car' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"chemical-for-car","cp_product.type"=>"chemical-for-car","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'cleaning' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"chemical-cleaning","cp_product.type"=>"chemical-cleaning","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'cosmetic' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"cosmetic-chemistry","cp_product.type"=>"cosmetic-chemistry","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'chemistry' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"color-chemistry","cp_product.type"=>"color-chemistry","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'food' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"food-chemistry","cp_product.type"=>"food-chemistry","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'industry' => \App\Models\Filter\CpTypeMd::select("_type as key")
                        ->where(["cp_type._id"=>$company,"cp_type.type"=>"industry"])
                        ->get()->toJson(),
                    'general' => \App\Models\Filter\CpTypeMd::select("_type as key")
                        ->where(["cp_type._id"=>$company,"cp_type.type"=>"general"])
                        ->get()->toJson(),
                    'made-to-order' => \App\Models\Filter\CpOrderMd::select("order as key")
                        ->where(["cp_order._id"=>$company])
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'medical-equipment-industry': /*= 2.15.1 - 98 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"medical-instruments-and-apparatus","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'medicines-industry': /*= 2.15.2 - 99 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"type-of-medication","cp_type._id"=>$company,'cp_type.type'=>'type-of-medication'])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'supplements' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"supplementary-food","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'usage' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"drug-utilization","cp_type._id"=>$company,'cp_type.type'=>'drug-utilization'])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'agricultural-equipment': /*= 2.16.1 - 100 =*/
                $data = [
                    'for-earth-work' => \App\Models\Filter\CpProductMd::select($select)
                        ->where([
                            "ch.type"=>"tools-for-earth-work",
                            "cp_product.type"=>"tools-for-earth-work",
                            "cp_product._id"=>$company
                        ])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'for-plant' => \App\Models\Filter\CpProductMd::select($select)
                        ->where([
                            "ch.type"=>"tool-for-plant",
                            "cp_product.type"=>"tool-for-plant",
                            "cp_product._id"=>$company
                        ])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'for-moving' => \App\Models\Filter\CpProductMd::select($select)
                        ->where([
                            "ch.type"=>"tools-for-moving-providing-water",
                            "cp_product.type"=>"tools-for-moving-providing-water",
                            "cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'agricultural-chemicals': /*= 2.16.2 - 101 =*/
                $data = [
                    'organic' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"organic-type","cp_type._id"=>$company,'cp_type.type'=>'organic-type'])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'chemical' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"chemical-type","cp_type._id"=>$company,'cp_type.type'=>'chemical-type'])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'laboratory-instruments': /*= 2.17.1 - 102 =*/
                $data = [
                    'instruments' => \App\Models\Filter\CpProductMd::select($select)
                        ->where([
                            "ch.type"=>"types-of-scientific-instruments",
                            "cp_product.type"=>"types-of-scientific-instruments",
                            "cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'glassware' => \App\Models\Filter\CpProductMd::select($select)
                        ->where([
                            "ch.type"=>"type-of-glassware",
                            "cp_product.type"=>"type-of-glassware",
                            "cp_product._id"=>$company
                        ])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'plastic' => \App\Models\Filter\CpProductMd::select($select)
                        ->where([
                            "ch.type"=>"plastic-product-type",
                            "cp_product.type"=>"plastic-product-type",
                            "cp_product._id"=>$company
                        ])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'consumables' => \App\Models\Filter\CpProductMd::select($select)
                        ->where([
                            "ch.type"=>"consumables",
                            "cp_product.type"=>"consumables",
                            "cp_product._id"=>$company
                        ])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'ceramic' => \App\Models\Filter\CpProductMd::select($select)
                        ->where([
                            "ch.type"=>"ceramic-products",
                            "cp_product.type"=>"ceramic-products",
                            "cp_product._id"=>$company
                        ])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'petroleum-fuel': /*= 2.18.1 - 103 =*/
                $data = [
                    'material' => \App\Models\Filter\CpMaterialMd::select($select)
                        ->where(["ch.type"=>"raw-materials-for-petroleum-fuel-production","cp_material._id"=>$company])
                        ->leftJoin($choice,"cp_material.material","=","ch.key")
                        ->get()->toJson(),
                    'process' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"petroleum-fuel-production-process","cp_service._id"=>$company,'cp_service.type'=>'petroleum-fuel-production-process'])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"petroleum-fuel-product-service","cp_service._id"=>$company,'cp_service.type'=>'petroleum-fuel-product-service'])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'rock': /*= 2.19.1 - 104 =*/
                $data = [
                    'rock' => \App\Models\Filter\CpProductMd::select($select)
                        ->where([
                            "ch.type"=>"type-of-rock",
                            "cp_product.type"=>"type-of-rock",
                            "cp_product._id"=>$company
                        ])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'sand' => \App\Models\Filter\CpProductMd::select($select)
                        ->where([
                            "ch.type"=>"type-of-sand",
                            "cp_product.type"=>"type-of-sand",
                            "cp_product._id"=>$company
                        ])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'soil' => \App\Models\Filter\CpProductMd::select($select)
                        ->where([
                            "ch.type"=>"type-of-soil",
                            "cp_product.type"=>"type-of-soil",
                            "cp_product._id"=>$company
                        ])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'other' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"rock-soil-sand","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'brick-and-tile': /*= 2.19.2 - 105 =*/
                $data = [
                    'type' => \App\Models\Filter\CpProductMd::select($select)
                        ->where([
                            "ch.type"=>"type-of-brick",
                            "cp_product.type"=>"type-of-brick",
                            "cp_product._id"=>$company
                        ])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'tile' => \App\Models\Filter\CpProductMd::select($select)
                        ->where([
                            "ch.type"=>"type-of-tile",
                            "cp_product.type"=>"type-of-tile",
                            "cp_product._id"=>$company
                        ])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'cement': /*= 2.19.3 - 106 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"type-of-cement","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'pole': /*= 2.19.4 - 107 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"type-of-mast","cp_type.type"=>"type-of-mast","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'cross' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"cross-type","cp_type.type"=>"cross-type","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'door-windows': /*= 2.19.5 - 108 =*/
                $data = [
                    'window' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"type-of-window","cp_product.type"=>"type-of-window","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'door' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"type-of-door","cp_product.type"=>"type-of-door","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'material' => \App\Models\Filter\CpMaterialMd::select($select)
                        ->where(["ch.type"=>"type-of-door-and-window-material","cp_material._id"=>$company])
                        ->leftJoin($choice,"cp_material.material","=","ch.key")
                        ->get()->toJson(),
                    'other' => \App\Models\Filter\CpOtherMd::select($select)
                        ->where(["ch.type"=>"door-window-other-product","cp_other._id"=>$company])
                        ->leftJoin($choice,"cp_other.other","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'pipe': /*= 2.19.6 - 109 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"type-of-pipe","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'other-construction-materials': /*= 2.19.7 - 110 =*/
                $data = [
                    'product' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"other-construction-materials-and-equipment","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'textiles-clothing': /*= 2.20.1 - 111 =*/
                $data = [
                    'product' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"textile-products","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'service' =>\App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"textile-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'costume-industry': /*= 2.20.2 - 112 =*/
                $data = [
                    'product' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"costume-product","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"costume-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'leather': /*= 2.20.3 - 113 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"type-of-leather","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'product' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"leather-product","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"service-of-leather-product","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'canvas': /*= 2.20.4 - 114 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"type-of-canvas","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'product' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"product-of-canvas","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'silk': /*= 2.20.5 - 115 =*/
                $data = [
                    'product' => \App\Models\Filter\CpProductMd::select($select)
                        ->where(["ch.type"=>"silk-products","cp_product._id"=>$company])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"silk-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'zipper-button': /*= 2.20.6 - 116 =*/
                $data = [
                    'type' => \App\Models\Filter\CpMaterialMd::select($select)
                        ->where(["ch.type"=>"decoration-material","cp_material._id"=>$company])
                        ->leftJoin($choice,"cp_material.material","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'packaging-industry': /*= 2.21.1 - 117 =*/
                $data = [
                    'packaging' => \App\Models\Filter\CpPackagingMd::select($select)
                        ->where(["ch.type"=>"packaging","cp_packaging._id"=>$company])
                        ->leftJoin($choice,"cp_packaging.packaging","=","ch.key")
                        ->get()->toJson(),
                    'type'  => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"packaging-type","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'material' => \App\Models\Filter\CpMaterialMd::select($select)
                        ->where(["ch.type"=>"packaging-materials","cp_material._id"=>$company])
                        ->whereNotIn('key',[5])
                        ->leftJoin($choice,"cp_material.material","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"package-other","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'interior-decoration': /*= 3.1.1 - 118 =*/
                $data = [
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(['ch.type'=>'type-of-interior-decoration','cp_service._id'=>$company])
                        ->leftJoin("choice as ch","cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'renovation' => \App\Models\Filter\CpRenovationMd::select('renovation as key')
                        ->where('_id',$company)
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'broker': /*= 3.2.1 - 119 =*/
                $data = [
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->leftJoin("choice as ch","cp_service.service","=","ch.key")
                        ->where(['ch.type'=>'real-estate-service', 'cp_service._id'=>$company])
                        ->get()->toJson(),
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->leftJoin("choice as ch","cp_type._type","=","ch.key")
                        ->where(['ch.type'=>'real-estate-type', 'cp_type._id'=>$company])
                        ->get()->toJson(),
                    'nationality' => \App\Models\Filter\CpNationalityMd::select("ch.id as key","ch.country as name")
                        ->leftJoin("countries as ch","cp_nationality.nationality",'=',"ch.id")
                        ->where(['cp_nationality._id'=>$company])
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'contractor': /*= 3.3.1 - 120 =*/
                $data = [
                    'utilities' => \App\Models\Filter\CpConstructionMd::select($select)
                        ->where([
                            "ch.type" => "utilities-construction",
                            "cp_construction.type" => "utilities-construction",
                            "cp_construction._id" => $company
                        ])
                        ->leftJoin($choice,"cp_construction.construction","=","ch.key")
                        ->get()->toJson(),
                    'building' => \App\Models\Filter\CpConstructionMd::select($select)
                        ->where([
                            "ch.type" => "building-system-construction",
                            "cp_construction.type" => "building-system-construction",
                            "cp_construction._id" => $company
                        ])
                        ->leftJoin($choice,"cp_construction.construction","=","ch.key")
                        ->get()->toJson(),
                    'energy' => \App\Models\Filter\CpConstructionMd::select($select)
                        ->where([
                            "ch.type" => "energy-system-construction",
                            "cp_construction.type" => "energy-system-construction",
                            "cp_construction._id" => $company
                        ])
                        ->leftJoin($choice,"cp_construction.construction","=","ch.key")
                        ->get()->toJson(),
                    'industrial' => \App\Models\Filter\CpConstructionMd::select($select)
                        ->where([
                            "ch.type" => "contractor-of-industrial-systems",
                            "cp_construction.type" => "contractor-of-industrial-systems",
                            "cp_construction._id" => $company
                        ])
                        ->leftJoin($choice,"cp_construction.construction","=","ch.key")
                        ->get()->toJson(),
                    'environmental' => \App\Models\Filter\CpConstructionMd::select($select)
                        ->where([
                            "ch.type" => "contractor-of-environmental-system",
                            "cp_construction.type" => "contractor-of-environmental-system",
                            "cp_construction._id" => $company
                        ])
                        ->leftJoin($choice,"cp_construction.construction","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"contractor-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'small' => \App\Models\Filter\CpOtherMd::select("other as key")
                        ->where("_id",$company)
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'solar-cell': /*= 3.4.1 - 121 =*/
                $data = [
                    'product' => \App\Models\Filter\CpProductMd::select($select)
                        ->where([
                            "ch.type"=>"power-generation-system",
                            'cp_product._id'=>$company
                        ])
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->get()->toJson(),
                    'other' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where([
                            "ch.type" => "solar-cells-wind-turbines-service",
                            'cp_service._id' => $company
                            ])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'condition' => \App\Models\Filter\CpConditionMd::select($select)
                        ->where([
                            "ch.type" => "solar-cells-wind-turbines-trading-agreement",
                            'cp_condition._id' => $company
                        ])
                        ->leftJoin($choice,"cp_condition.condition","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location,
                ];
                break;
            case 'insurance-lifestyle': /*= 4.1.1 - 122 =*/
                $data = [
                    'personality' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where([
                            'ch.type' => 'personal-insurance',
                            'cp_service.type' => 'personal-insurance',
                            'cp_service._id' => $company
                        ])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'property' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where([
                            'ch.type' => 'property-insurance',
                            'cp_service.type' => "property-insurance",
                            'cp_service._id' => $company
                        ])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'business' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where([
                            'ch.type' => 'insurance-business',
                            'cp_service.type' => 'business-insurance',
                            'cp_service._id' => $company
                        ])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'pets' => \App\Models\Filter\CpTypeMd::select("_type as key")
                        ->where(['type' => 'pets', '_id' => $company])
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'institution': /*= 4.2.1 - 123 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(['ch.type'=>"type-of-institution","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'organization': /*= 4.2.2 - 124 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(['ch.type'=>"type-of-organization","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'farm': /*= 4.2.3 - 125 =*/
                $data = [
                    'aquatic' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"aquatic-animals","cp_type.type"=>"aquatic-animals","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'terrestrial' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"terrestrial-animal","cp_type.type"=>"terrestrial-animal","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'poultry' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"poultry","cp_type.type"=>"poultry","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'reptile' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"reptile","cp_type.type"=>"reptile","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'arachnid-insect' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"arachnid-insect","cp_type.type"=>"arachnid-insect","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"farm-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'space-for-rent-lifestyle': /*= 4.2.4 - 126 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(['ch.type'=>"place-for-rent","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'animal-hospital': /*= 4.3.1 - 127 =*/
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"animal-hospital","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"animal-hospital-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'other' => \App\Models\Filter\CpOtherMd::select($select)
                        ->where(["ch.type"=>"animal-hospital-special-service","cp_other._id"=>$company])
                        ->leftJoin($choice,"cp_other.other","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'beauty-clinic': /*= 4.3.2 - 128 =*/
                $data = [
                    'beauty' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where([
                            "ch.type"=>"beauty-clinic",
                            "cp_service.type"=>"beauty-clinic",
                            "cp_service._id"=>$company
                        ])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'disease' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where([
                            "ch.type"=>"hospital",
                            "cp_service.type"=>"hospital",
                            "cp_service._id"=>$company
                        ])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'tourist': /*= 4.4.1 - 129 =*/
                $data = [
                    'attractions' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"tourist-attraction","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"tourist-attraction-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'hiking-camping' => \App\Models\Filter\CpOtherMd::select("other as key")
                        ->where(['type' => 'hiking-camping', '_id' => $company])
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'accommodation': /*= 4.4.2 - 130 =*/
                $data = [
                    'accommodates-pets' => \App\Models\Filter\CpOtherMd::select("other as key")
                        ->where(['type' => 'accommodates-pets', '_id' => $company])
                        ->get()->toJson(),
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(['ch.type'=>'type-of-accommodation', 'cp_type._id'=>$company])
                        ->leftJoin("choice as ch","cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'facility' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"facility","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
        }
        return $data;
    }

    public function confirmation()
    {
        return view('front-end.confirmation',['prefix'=>$this->prefix]);
    }
}
