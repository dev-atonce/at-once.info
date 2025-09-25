<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
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
        $data = \App\Models\CategoryMd::where(['key' => $this->category, 'status' => 1, 'coming_soon' => 0])->first();
        if ($data->id) return $data->id;
    }
    public function categoryName()
    {
        $lang = Session('lang');
        $data = \App\Models\CategoryMd::select("name_$lang as name")->where('key',$this->category)->first();
        if (@$data->name) return $data->name;
    }
    public function index(Request $request)
    {
        try {

            $lang = Session('lang');
            $data = $this->CompanyData($request);

            return view("$this->prefix.layout.index",[
                'prefix' => $this->prefix,
                'module' => $this->category,
                'categoryId' => $this->categoryId(),
                'categoryName' => $this->categoryName(),
                'lang' => $lang,
                'company' => $data['rows'],
                'filter' => $this->filterOfCategory(),
                'online' => $data['online'],
                'aboutThis' => $data['aboutThis'],
                'sponsor' => \App\Http\Controllers\SponsorCtrl::__blank(),
                'category' => \App\Http\Controllers\CategoryCtrl::_index(),
                'blogs' => \App\Http\Controllers\BlogCtrl::inMainpage($type=$this->categoryId(),$limit=12),
                'blogs_company' => \App\Http\Controllers\BlogCtrl::inMainPageCompany($type=$this->categoryId(),$limit=12),
                'seo' => \App\Helpers\SeoLandingPage::getCategorySeoKeyword($this->categoryId(), $lang)
            ]);
        }catch(\ErrorException $e){
            abort(404);
            return view("error.404", ['prefix' => $this->prefix]);
        }
    }

    public function CompanyData($request)
    {
        $category = request()->segment(2);

        $online = 0;
        $aboutThis = "";
        switch($category){
            case 'visa-support': // 1.1.1
                $data = \App\Http\Controllers\Category\VisaCtrl::index($request);
                break;
            case 'company-registration': // 1.1.2
                $data = \App\Http\Controllers\Category\CompanyRegisterCtrl::index($request);
                break;
            case 'law-firm': // 1.1.3
                $data = \App\Http\Controllers\Category\LawFirmCtrl::index($request);
                break;
            case 'business-consulting': // 1.1.4
                $data = \App\Http\Controllers\Category\ConsultantCtrl::index($request);
                break;
            case 'accounting': // 1.1.5
                $data = \App\Http\Controllers\Category\AccountingCtrl::index($request);
                break;
            case 'translation-interpreter': // 1.1.6
                $data = \App\Http\Controllers\Category\TranslateCtrl::index($request);
                break;
            case 'agent-for-land': // 1.1.7
                $data = \App\Http\Controllers\Category\BrokerCtrl::index($request);
                break;

            case 'recruitment-agency': // 1.2.1
                $data = \App\Http\Controllers\Category\RecruitmentCtrl::index($request);
                break;
            case 'security': // 1.2.2
                $data = \App\Http\Controllers\Category\SecuritySystemCtrl::index($request);
                break;
            case 'logistics-warehouse-delivery': // 1.2.3
                $data = \App\Http\Controllers\Category\LogisticsCtrl::index($request);
                $aboutThis = "front-end.category.logistics.AboutThis";
                break;
            case 'printing': // 1.2.4
                $data = \App\Http\Controllers\Category\PrintingCtrl::index($request);
                break;
            case 'gardening': // 1.2.5
                $data = \App\Http\Controllers\Category\GardeningCtrl::index($request);
                break;
            case 'office-design-and-renovation': // 1.2.6
                $data = \App\Http\Controllers\Category\InteriorDecorationCtrl::index($request);
                break;
            case 'office-appliance': // 1.2.7
                $data = \App\Http\Controllers\Category\OfficeApplianceCtrl::index($request);
                break;
            case 'oa-machine': // 1.2.8
                $data = \App\Http\Controllers\Category\OaMachineCtrl::index($request);
                break;
            case 'office-equipment-maintenance': // 1.2.9
                $data = \App\Http\Controllers\Category\OfficeEquipmentMaintenanceCtrl::index($request);
                break;
            case 'website-development': // 1.2.10
                $data = \App\Http\Controllers\Category\WebSystemCtrl::index($request);
                break;
            case 'system-iot-dx': // 1.2.11
                $data = \App\Http\Controllers\Category\SystemIotDxCtrl::index($request);
                break;
            case 'car-rental': // 1.2.12
                $data = \App\Http\Controllers\Category\CarrentCtrl::index($request);
                break;
            case 'it-computer-hardware': // 1.2.13
                $data = \App\Http\Controllers\Category\ItCtrl::index($request);
                break;
            case 'prefabricated-office': // 1.2.14
                $data = \App\Http\Controllers\Category\PrefabricateOfficeCtrl::index($request);
                break;
            case 'call-center': // 1.3.1
                $data = \App\Http\Controllers\Category\CallCenterCtrl::index($request);
                break;
            case 'advertising-publisment': // 1.3.2
                $data = \App\Http\Controllers\Category\AdvertisingCtrl::index($request);
                break;
            case 'web-marketing': // 1.3.3
                $data = \App\Http\Controllers\Category\OnlineMarketingCtrl::index($request);
                break;
            // case 'exhibition': // 1.3.4
            //     $data = \App\Http\Controllers\Category\ExhibitionCtrl::index($request);
            //     break;

            case 'financial': // 1.4.1
                $data = \App\Http\Controllers\Category\FinancialCtrl::index($request);
                break;
            case 'leasing': // 1.4.2
                $data = \App\Http\Controllers\Category\CreditLoanCtrl::index($request);
                break;
            case 'insurance': // 1.4.3
                $data = \App\Http\Controllers\Category\InsuranceCtrl::index($request);
                break;
            // case 'factoring': // 1.4.4
            //     $data = \App\Http\Controllers\Category\FactoringCtrl::index($request);
            //     break;
            // case 'credit-cards': // 1.4.5
            //     $data = \App\Http\Controllers\Category\CreditCardCtrl::index($request);
            //     break;

            case 'travel-agency': // 1.5.1
                $data = \App\Http\Controllers\Category\TravelAgencyCtrl::index($request);
                break;
            case 'hotel-accommodation': // 1.5.2
                $data = \App\Http\Controllers\Category\AccommodationCtrl::index($request);
                break;
            case 'event-organizer-exhibition': // 1.5.3
                $data = \App\Http\Controllers\Category\OrganizerCtrl::index($request);
                break;
            case 'gift-suvenir': // 1.5.4
                $data = \App\Http\Controllers\Category\GiftSuvenirCtrl::index($request);
                break;

            case 'press-machine': // 2.1.1
                $data = \App\Http\Controllers\Category\PressMachineCtrl::index($request);
                break;
            case 'cnc-lathe-manual-late': // 2.1.2
                $data = \App\Http\Controllers\Category\CncLatherCtrl::index($request);
                break;
            case 'machine-center-milling-machine': // 2.1.3
                $data = \App\Http\Controllers\Category\MachinesMillingCtrl::index($request);
                break;
            case 'die-casting-machine': // 2.1.4
                $data = \App\Http\Controllers\Category\MachinesCastingCtrl::index($request);
                break;
            case 'plastic-injection': // 2.1.5
                $data = \App\Http\Controllers\Category\PlasticInjectionCtrl::index($request);
                break;
            case 'welding-machine': // 2.1.6
                $data = \App\Http\Controllers\Category\MachinesWeldingCtrl::index($request);
                break;
            case 'robot-automation': // 2.1.7
                $data = \App\Http\Controllers\Category\RobotAutomationCtrl::index($request);
                break;
            case 'machine-maintennance-spare-part': // 2.1.8
                $data = \App\Http\Controllers\Category\MachinePartsCtrl::index($request);
                break;
            case 'second-hand-machine': // 2.1.9
                $data = \App\Http\Controllers\Category\MachinesSecondHandCtrl::index($request);
                break;
            case 'coating-painting-heating-treatment-machine': // 2.1.10
                $data = \App\Http\Controllers\Category\MachinesCoatingCtrl::index($request);
                break;
            case 'grinding-edm-wire-cut-machine': // 2.1.11
                $data = \App\Http\Controllers\Category\MachinesGrindingCtrl::index($request);
                break;
            case 'qc-equipment': // 2.1.12
                $data = \App\Http\Controllers\Category\QcEquipmentCtrl::index($request);
                break;
            case 'cutting-blending-machine': // 2.1.13
                $data = \App\Http\Controllers\Category\MachinesCuttingCtrl::index($request);
                break;
            case 'hand-tools': // 2.1.14
                $data = \App\Http\Controllers\Category\HandToolCtrl::index($request);
                break;
            case 'washing-machine': // 2.1.15
                $data = \App\Http\Controllers\Category\MachinesWashingCtrl::index($request);
                break;
            case 'painting-equipment': // 2.1.16
                $data = \App\Http\Controllers\Category\PaintingEquipmentCtrl::index($request);
                break;
            case 'special-machine-product-designed-line': // 2.1.17
                $data = \App\Http\Controllers\Category\MachinesSpecialCtrl::index($request);
                break;
            case 'other-machine-equipment': // 2.1.18
                $data = \App\Http\Controllers\Category\MachinesOtherCtrl::index($request);
                break;
            case 'clean-room-temperature-control': // 2.1.19
                $data = \App\Http\Controllers\Category\CleanRoomCtrl::index($request);
                break;

            case 'automotive-motorcycle-industrial': // 2.2.1
                $data = \App\Http\Controllers\Category\AutomotiveSparepartsCtrl::index($request);
                break;
            case 'chemical-industrial': // 2.2.2
                $data = \App\Http\Controllers\Category\ChemicalsIndustrialCtrl::index($request);
                break;
            case 'jewely-cosmetic-industrial': // 2.2.3
                $data = \App\Http\Controllers\Category\JewelryBeautyCtrl::index($request);
                break;
            case 'food-drinks-industrial': // 2.2.4
                $data = \App\Http\Controllers\Category\FoodDrinkCtrl::index($request);
                break;
            case 'mold': // 2.2.5
                $data = \App\Http\Controllers\Category\MoldCtrl::index($request);
                break;
            case 'electric-product-part-industrial': // 2.2.6
                $data = \App\Http\Controllers\Category\ElectricalApplianceCtrl::index($request);
                break;
            case 'electric-product-part-industrial-service': // 2.2.6 ***********************
                $data = \App\Http\Controllers\Category\ElectricalApplianceCtrl::index($request);
                break;
            case 'home-appliance-industrial': // 2.2.7
                $data = \App\Http\Controllers\Category\HomeApplianceCtrl::index($request);
                break;
            case 'agriculture-industrial': // 2.2.8
                $data = \App\Http\Controllers\Category\AgriculturalChemicalsCtrl::index($request);
                break;
            case 'heavy-machine-industrial': // 2.2.9
                $data = \App\Http\Controllers\Category\HeavyMachineryCtrl::index($request);
                break;
            case 'job-shops': // 2.2.10
                $data = \App\Http\Controllers\Category\JobShopCtrl::index($request);
                break;
            case 'textile-garment': // 2.2.11
                $data = \App\Http\Controllers\Category\TextileGarmentCtrl::index($request);
                break;
            case 'shoes-bags': // 2.2.12
                $data = \App\Http\Controllers\Category\ShoesBagCtrl::index($request);
                break;
            case 'medical-industrial': // 2.2.13
                $data = \App\Http\Controllers\Category\MedicalCtrl::index($request);
                break;
            case 'glass-mirror-lens': // 2.2.14
                $data = \App\Http\Controllers\Category\GlassMirrorCtrl::index($request);
                break;
            case 'packaging': // 2.2.15
                $data = \App\Http\Controllers\Category\PackagingCtrl::index($request);
                break;
            case 'other-industrial': // 2.2.16
                $data = \App\Http\Controllers\Category\OtherIndustrialCtrl::index($request);
                break;

            case 'cutting-tool-grinding-stone': // 2.3.1
                $data = \App\Http\Controllers\Category\CuttingToolCtrl::index($request);
                break;
            case 'coolant-oil': // 2.3.2
                $data = \App\Http\Controllers\Category\CoolantOilCtrl::index($request);
                break;
            case 'chemical': // 2.3.3
                $data = \App\Http\Controllers\Category\ChemicalsCtrl::index($request);
                break;
            case 'filter': // 2.3.4
                $data = \App\Http\Controllers\Category\FilterPartCtrl::index($request);
                break;
            case 'fuel-gas': // 2.3.5
                $data = \App\Http\Controllers\Category\FuelGasCtrl::index($request);
                break;
            case 'paint': // 2.3.6
                $data = \App\Http\Controllers\Category\PaintCtrl::index($request);
                break;

            case 'textile-silk': // 2.4.1
                $data = \App\Http\Controllers\Category\TextilesClothingCtrl::index($request);
                break;
            case 'rubber': // 2.4.2
                $data = \App\Http\Controllers\Category\RubberCtrl::index($request);
                break;
            case 'plastic-resin': // 2.4.3
                $data = \App\Http\Controllers\Category\PlasticResinCtrl::index($request);
                break;
            case 'pipe': // 2.4.4
                $data = \App\Http\Controllers\Category\PipeCtrl::index($request);
                break;
            case 'pulp': // 2.4.5
                $data = \App\Http\Controllers\Category\PulpCtrl::index($request);
                break;
            case 'woods': // 2.4.6
                $data = \App\Http\Controllers\Category\WoodCtrl::index($request);
                break;
            case 'ceramic': // 2.4.7
                $data = \App\Http\Controllers\Category\CeramicCtrl::index($request);
                break;
            case 'leather': // 2.4.8
                $data = \App\Http\Controllers\Category\LeatherCtrl::index($request);
                break;

            case 'compressor': // 2.5.1
                $data = \App\Http\Controllers\Category\CompressorCtrl::index($request);
                break;
            case 'solar-windmilling': // 2.5.2
                $data = \App\Http\Controllers\Category\SolarCellCtrl::index($request);
                $aboutThis = "front-end.category.solar-cell.AboutThis";
                break;
            case 'boiler': // 2.5.3
                $data = \App\Http\Controllers\Category\BoilerCtrl::index($request);
                break;
            case 'conveyor-shelter-rack': // 2.5.4
                $data = \App\Http\Controllers\Category\ShatterRackCtrl::index($request);
                break;
            case 'generator': // 2.5.5
                $data = \App\Http\Controllers\Category\GeneratorCtrl::index($request);
                break;
            case 'crane-hoist': // 2.5.6
                $data = \App\Http\Controllers\Category\CraneHoistCtrl::index($request);
                break;
            case 'contractor-maintenance-renovation': // 2.5.7
                $data = \App\Http\Controllers\Category\ContractorsCtrl::index($request);
                break;
            case 'forklift-stocker': // 2.5.8
                $data = \App\Http\Controllers\Category\ForkliftCtrl::index($request);
                break;
            case 'safety-goods': // 2.5.9
                $data = \App\Http\Controllers\Category\SafetyFactoryCtrl::index($request);
                break;
            case 'pump-motor': // 2.5.10
                $data = \App\Http\Controllers\Category\PumpMotorCtrl::index($request);
                break;
            case 'pipe-electrical-engineering': // 2.5.11
                $data = \App\Http\Controllers\Category\PipeElectricalCtrl::index($request);
                break;
            case 'factory-gardening': // 2.5.12
                $data = \App\Http\Controllers\Category\GardeningCtrl::index($request);
                break;
            case 'maintenance-for-facility-pump-motor': // 2.5.13
                $data = \App\Http\Controllers\Category\MaintenanceCtrl::index($request);
                break;

            case 'general-security': // 2.6.1
                $data = \App\Http\Controllers\Category\SecuritySystemCtrl::index($request);
                break;
            case 'system-iot-dx-factory': // 2.6.2
                $data = \App\Http\Controllers\Category\SystemIotDxCtrl::index($request);
                break;
            case 'consulting': // 2.6.3
                $data = \App\Http\Controllers\Category\ConsultantCtrl::index($request);
                break;
            case 'canteen': // 2.6.4
                $data = \App\Http\Controllers\Category\CanteenCtrl::index($request);
                break;
            case 'trading-company': // 2.6.5
                $data = \App\Http\Controllers\Category\TradingCompanyCtrl::index($request);
                break;
            case 'recruitment': // 2.6.6
                $data = \App\Http\Controllers\Category\RecruitmentCtrl::index($request);
                break;
            case 'logistics-warehouse-delivery-factory': // 2.6.7
                $data = \App\Http\Controllers\Category\LogisticsCtrl::index($request);
                $aboutThis = "front-end.category.logistics.AboutThis";
                // $data = \App\Http\Controllers\Category\WareHouseCtrl::index($request);
                break;
            case 'other-service': // 2.6.8
                $data = \App\Http\Controllers\Category\OtherServiceCtrl::index($request);
                break;

            case 'amata': // 2.7.1
                break;
            case 'pintong': // 2.7.2
                $data = \App\Http\Controllers\Category\PintongCtrl::index($request);
                break;
            // case '': // 2.7.3
            //     break;
            // case '': // 2.7.4
            //     break;
            // case '': // 2.7.5
            //     break;
            // case '': // 2.7.6
            //     break;
            // case '': // 2.7.7
            //     break;
            // case '': // 2.7.8
            //     break;
            // case '': // 2.7.9
            //     break;
            case 'agent-for-land-industrial': // 2.7.10
                $data = \App\Http\Controllers\Category\BrokerCtrl::index($request);
                break;

            case 'developer': // 3.1.1
                $data = \App\Http\Controllers\Category\ConstructionDeveloperCtrl::index($request);
                break;
            case 'contractor': // 3.1.2 
                $data = \App\Http\Controllers\Category\ContractorsCtrl::index($request);
                break;
            case 'contractor-service': // 3.1.2 *********************************
                $data = \App\Http\Controllers\Category\ContractorsCtrl::index($request);
                break;

            case 'compressor-construction': // 3.2.1
                $data = \App\Http\Controllers\Category\CompressorCtrl::index($request);
                break;
            case 'generator-construction': // 3.2.2
                $data = \App\Http\Controllers\Category\GeneratorCtrl::index($request);
                break;
            case 'maintenance-for-facility-construction': // 3.2.3
                $data = \App\Http\Controllers\Category\MaintenanFacilityCtrl::index($request);
                break;
            case 'solar-windmilling-construction': // 3.2.4
                $data = \App\Http\Controllers\Category\SolarCellCtrl::index($request);
                break;
            case 'solar-windmilling-service': // 3.2.4 ************************
                $data = \App\Http\Controllers\Category\SolarCellCtrl::index($request);
                $aboutThis = "front-end.category.solar-cell.AboutThis";
                break;
            
            case 'conveyor-shelter-rack-construction': // 3.2.5
                $data = \App\Http\Controllers\Category\ShatterRackCtrl::index($request);
                break;

            case 'heavy-machinery': // 3.3.1
                $data = \App\Http\Controllers\Category\HeavyMachineryCtrl::index($request);
                break;
            case 'heavy-machinery-service': // 3.3.1 **************************************
                $data = \App\Http\Controllers\Category\HeavyMachineryCtrl::index($request);
                break;

            case 'construction-machine': // 3.3.2
                $data = \App\Http\Controllers\Category\ConstructionMachineCtrl::index($request);
                break;

            case 'door-window': // 3.4.1
                $data = \App\Http\Controllers\Category\DoorWindowCtrl::index($request);
                break;
            case 'fuel-gas-construction': // 3.4.2
                $data = \App\Http\Controllers\Category\FuelGasCtrl::index($request);
                break;
            case 'electrical-equipment': // 3.4.3
                $data = \App\Http\Controllers\Category\ElectricalApplianceCtrl::index($request);
                break;
            case 'leather-construction': // 3.4.4
                $data = \App\Http\Controllers\Category\LeatherCtrl::index($request);
                break;
            case 'rubber-construction': // 3.4.5
                $data = \App\Http\Controllers\Category\RubberCtrl::index($request);
                break;
            case 'rock': // 3.4.6
                $data = \App\Http\Controllers\Category\RockCtrl::index($request);
                break;
            case 'brick-tile': // 3.4.7
                $data = \App\Http\Controllers\Category\BrickCtrl::index($request);
                break;
            case 'sound': // 3.4.8
                $data = \App\Http\Controllers\Category\SoundCtrl::index($request);
                break;
            case 'steel-metal': // 3.4.9
                $data = \App\Http\Controllers\Category\SteelAndMetalCtrl::index($request);
                break;
            case 'pipe-construction': // 3.4.10
                $data = \App\Http\Controllers\Category\PipeCtrl::index($request);
                break;
            case 'valve': // 3.4.11
                $data = \App\Http\Controllers\Category\ValveCtrl::index($request);
                break;
            case 'glass': // 3.4.12
                $data = \App\Http\Controllers\Category\GlassCtrl::index($request);
                break;
            case 'chemical-construction': // 3.4.13
                $data = \App\Http\Controllers\Category\ChemicalsCtrl::index($request);
                break;
            case 'ceramic-construction': // 3.4.14
                $data = \App\Http\Controllers\Category\CeramicCtrl::index($request);
                break;
            case 'pulp-construction': // 3.4.15
                $data = \App\Http\Controllers\Category\PulpCtrl::index($request);
                break;
            case 'blending-item': // 3.4.16
                $data = \App\Http\Controllers\Category\BlendingCtrl::index($request);
                break;
            case 'light': // 3.4.17
                $data = \App\Http\Controllers\Category\LightCtrl::index($request);
                break;

            case 'bus': // 4.1.1
                $data = \App\Http\Controllers\Category\BusCtrl::index($request);
                break;
            case 'taxi': // 4.1.2
                $data = \App\Http\Controllers\Category\TaxiCtrl::index($request);
                break;
            case 'bts': // 4.1.3
                $data = \App\Http\Controllers\Category\BtsCtrl::index($request);
                break;
            case 'air-plane': // 4.1.4
                $data = \App\Http\Controllers\Category\PlaneCtrl::index($request);
                break;
            case 'train': // 4.1.5
                $data = \App\Http\Controllers\Category\TrainCtrl::index($request);
                break;

            case 'fuel': // 4.2.1
                $data = \App\Http\Controllers\Category\FuelGasCtrl::index($request);
                break;
            case 'gas': // 4.2.2
                $data = \App\Http\Controllers\Category\FuelGasCtrl::index($request);
                break;
            case 'electric': // 4.2.3
                $data = \App\Http\Controllers\Category\ElectricCtrl::index($request);
                break;
            case 'windmilling': // 4.2.4
                $data = \App\Http\Controllers\Category\SolarCellCtrl::index($request);
                break;

            case 'airport': // 4.3.1
                $data = \App\Http\Controllers\Category\AirPortCtrl::index($request);
                break;
            case 'sea-port': // 4.3.2
                $data = \App\Http\Controllers\Category\SeaPortCtrl::index($request);
                break;

            case 'kindergarten': // 4.4.1
                $data = \App\Http\Controllers\Category\KindergartenCtrl::index($request);
                break;
            case 'primary-school': // 4.4.2
                $data = \App\Http\Controllers\Category\PrimarySchoolCtrl::index($request);
                break;
            case 'junior-high-school': // 4.4.3
                $data = \App\Http\Controllers\Category\JuniorHighSchoolCtrl::index($request);
                break;
            case 'high-school': // 4.4.4
                $data = \App\Http\Controllers\Category\HighSchoolCtrl::index($request);
                break;
            case 'university': // 4.4.5
                $data = \App\Http\Controllers\Category\UniversityCtrl::index($request);
                break;

            case 'embassy': // 4.5.1
                $data = \App\Http\Controllers\Category\EmbassyCtrl::index($request);
                break;

            case 'interconnection': // 4.6.1
                $data = \App\Http\Controllers\Category\InterconnectionCtrl::index($request);
                break;
            case 'radio-communication': // 4.6.2
                $data = \App\Http\Controllers\Category\RadioCtrl::index($request);
                break;

            case 'retail-bank': // 5.1.1
                $data = \App\Http\Controllers\Category\BankCtrl::index($request);
                break;
            case 'retail-insurance': // 5.1.2
                $data = \App\Http\Controllers\Category\InsuranceCtrl::index($request);
                break;
            case 'retail-leasing': // 5.1.3
                $data = \App\Http\Controllers\Category\CreditLoanCtrl::index($request);
                break;

            case 'human': // 5.2.1
                $data = \App\Http\Controllers\Category\ClinicCtrl::index($request);
                break;
            case 'animal': // 5.2.2
                $data = \App\Http\Controllers\Category\AnimalHospitalCtrl::index($request);
                break;

            case 'retail-travel-agency': // 5.3.1
                $data = \App\Http\Controllers\Category\TravelAgencyCtrl::index($request);
                break;
            case 'hotel': // 5.3.2
                $data = \App\Http\Controllers\Category\AccommodationCtrl::index($request);
                break;
            // case 'car-for-rent': // 5.3.3
            //     break;

            case 'kitchen': // 5.4.1
                $data = \App\Http\Controllers\Category\KitchenApplianceCtrl::index($request);
                break;
            case 'electronic': // 5.4.2
                $data = \App\Http\Controllers\Category\ElectricalApplianceCtrl::index($request);
                break;
            case 'home-renovation': // 5.4.3
                $data = \App\Http\Controllers\Category\HomeRenovationCtrl::index($request);
                break;
            case 'gardening-appliance': // 5.4.4
                $data = \App\Http\Controllers\Category\GardeningCtrl::index($request);
                break;
            case 'store': // 5.4.5
                $data = \App\Http\Controllers\Category\StoreCtrl::index($request);
                break;

            case 'daily-renovation': // 5.5.1
                $data = \App\Http\Controllers\Category\HomeRenovationCtrl::index($request);
                break;
            case 'stock-room': // 5.5.2
                $data = \App\Http\Controllers\Category\AccommodationCtrl::index($request);
                break;
            case 'engineering-maintenance': // 5.5.3\
                $data = \App\Http\Controllers\Category\AutomotiveRepairCtrl::index($request);
                break;
            case 'drug-store': // 5.5.4
                $data = \App\Http\Controllers\Category\MedicinesCtrl::index($request);
                break;
            case 'cosmetic': // 5.5.5
                $data = \App\Http\Controllers\Category\CosmeticCtrl::index($request);
                break;
            case 'pet': // 5.5.6
                $data = \App\Http\Controllers\Category\PetCtrl::index($request);
                break;
            case 'sport-entertainment': // 5.5.7
                $data = \App\Http\Controllers\Category\SportCtrl::index($request);
                break;
            case 'retail-other': // 5.5.8
                $data = \App\Http\Controllers\Category\OtherRetailCtrl::index($request);
                break;
        }

        $online = $data['rows']->get()->count();
        $rows = $data['rows']->orderBy('our_customer.id', 'desc')->orderByRaw("FIELD(company.type, 'full', 'semi', 'basic')")->inRandomOrder()->limit(20)->get();

        return ['rows' => $rows, 'online' => $online, 'aboutThis' => $aboutThis];

    }

    public static function filterOfCategory($categoryKey=null)
    {
        $key = ($categoryKey == null) ? request()->segment(2) : $categoryKey;
        $lang = Session('lang');
        $langPro = $lang == 'th' ? 'th' : 'en';
        $select = ["key","name_$langPro as name", "name_th"];

        $location = \App\Models\ProvinceMd::select("province_id as key","province_name_$langPro as name")->orderBy('name')->get();
        switch($key){
            case 'visa-support': // 1.1.1
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
            case 'company-registration': // 1.1.2
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.consulting"),'name'=>'consulting','type'=>'text'],
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
            case 'law-firm': // 1.1.3
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
            case 'business-consulting': // 1.1.4
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
            case 'accounting': // 1.1.5
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
            case 'translation-interpreter': // 1.1.6
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
            case 'agent-for-land': // 1.1.7
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

            case 'recruitment-agency': // 1.2.1
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
            case 'security': // 1.2.2
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
            case 'logistics-warehouse-delivery': // 1.2.3
                $data = (object)[
                    'input' => [
                        (object)['label' => __('phrase.domestic'), 'name' => 'domestic', 'type' => 'checkbox'],
                        (object)['label' => __('phrase.international'), 'name' => 'international', 'type' => 'text' ,'selectAll'=>true],
                        (object)['label' => __('phrase.transport'), 'name' => 'method', 'type' => 'text'],
                        (object)['label' => __('phrase.items'), 'name' => 'item', 'type' => 'text'],
                        (object)['label' => __('phrase.services'), 'name' => 'service', 'type' => 'text'],
                        (object)['label' => __("phrase.$key.filter.typewarehouse"), 'name' => 'type','type'=>'text'],
                        (object)['label' => __("phrase.$key.filter.warehouse"), 'name' => 'warehouse', 'type' => 'text'],
                        (object)['label' => __("phrase.$key.filter.location"), 'name'=> 'location', 'type'=>'text']
                    ],
                    'filter' => [
                        'international' => \App\Models\ChoiceMd::where('type','transport')->select($select)->get(),
                        'method' => \App\Models\ChoiceMd::where('type','methods')->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where('type','services')->select($select)->orderBy('sort')->get(),
                        'item' => \App\Models\ChoiceMd::where('type','warehouse')->select($select)->orderBy('sort')->get(),
                        'type' => \App\Models\ChoiceMd::where('type','stock')->select($select)->get(),
                        'warehouse' => $location,
                        'location' => $location,
                    ]
                ];
                break;
            case 'printing': // 1.2.4
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
            case 'gardening': // 1.2.5
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
            case 'office-design-and-renovation': // 1.2.6
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
            case 'office-appliance': // 1.2.7
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
            case 'oa-machine': // 1.2.8
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'office-equipment-maintenance': // 1.2.9
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'website-development': // 1.2.10
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
            case 'system-iot-dx': // 1.2.11
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'car-rental': // 1.2.12
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
            case 'it-computer-hardware': // 1.2.13
                $data = (object)[
                    'input' => [
                        (object)['label'=>__("phrase.$key.filter.service"),'name'=>'service','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.hardware"),'name'=>'hardware','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.software"),'name'=>'software','type'=>'text'],
                        (object)['label'=>__("phrase.$key.filter.location"),'name'=>'location','type'=>'text']
                    ],
                    'filter' => [
                        'service' => \App\Models\ChoiceMd::where('type','it-hardware-service')->select($select)->get(),
                        'hardware' => \App\Models\ChoiceMd::where('type','it-hardware')->select($select)->get(),
                        'software' => \App\Models\ChoiceMd::where("type","software-development")->select($select)->get(),
                        'location' => $location
                    ]
                ];
                break;
            case 'prefabricated-office': // 1.2.14
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
            case 'call-center': // 1.3.1
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'advertising-publisment': // 1.3.2
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
            case 'web-marketing': // 1.3.3
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
            // case 'exhibition': // 1.3.4
            //     break;

            case 'financial': // 1.4.1
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'leasing': // 1.4.2
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
            case 'insurance': // 1.4.3
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
            // case 'factoring': // 1.4.4
            //     $data = (object)[
            //         'input' => [],
            //         'filter' => []
            //     ];
            //     break;
            // case 'credit-cards': // 1.4.5
            //     $data = (object)[
            //         'input' => [],
            //         'filter' => []
            //     ];
            //     break;

            case 'travel-agency': // 1.5.1
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'hotel-accommodation': // 1.5.2
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
            case 'event-organizer-exhibition': // 1.5.3
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
            case 'gift-suvenir': // 1.5.4
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;

            case 'press-machine': // 2.1.1
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'cnc-lathe-manual-late': // 2.1.2
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'machine-center-milling-machine': // 2.1.3
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'die-casting-machine': // 2.1.4
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'plastic-injection': // 2.1.5
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'welding-machine': // 2.1.6
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'robot-automation': // 2.1.7
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'machine-maintennance-spare-part': // 2.1.8
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
            case 'second-hand-machine': // 2.1.9
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'coating-painting-heating-treatment-machine': // 2.1.10
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'grinding-edm-wire-cut-machine': // 2.1.11
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'qc-equipment': // 2.1.12
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'cutting-blending-machine': // 2.1.13
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'hand-tools': // 2.1.14
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
            case 'washing-machine': // 2.1.15
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'painting-equipment': // 2.1.16
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'special-machine-product-designed-line': // 2.1.17
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'other-machine-equipment': // 2.1.18
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'clean-room-temperature-control': // 2.1.19
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;

            case 'automotive-motorcycle-industrial': // 2.2.1
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
            case 'chemical-industrial': // 2.2.2
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
            case 'jewely-cosmetic-industrial': // 2.2.3
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'food-drinks-industrial': // 2.2.4
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'mold': // 2.2.5
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'electric-product-part-industrial': // 2.2.6
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
            case 'electric-product-part-industrial-service': // 2.2.6 *******************
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
            case 'home-appliance-industrial': // 2.2.7
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
            case 'agriculture-industrial': // 2.2.8
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'heavy-machine-industrial': // 2.2.9
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'job-shops': // 2.2.10
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'textile-garment': // 2.2.11
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'shoes-bags': // 2.2.12
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'medical-industrial': // 2.2.13
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'glass-mirror-lens': // 2.2.14
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'packaging': // 2.2.15
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
            case 'other-industrial': // 2.2.16
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;

            case 'cutting-tool-grinding-stone': // 2.3.1
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'coolant-oil': // 2.3.2
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'chemical': // 2.3.3
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'filter': // 2.3.4
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'fuel-gas': // 2.3.5
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'paint': // 2.3.6
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;

            case 'textile-silk': // 2.4.1
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
            case 'rubber': // 2.4.2
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'plastic-resin': // 2.4.3
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'pipe': // 2.4.4
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'pulp': // 2.4.5
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'woods': // 2.4.6
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'ceramic': // 2.4.7
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'leather': // 2.4.8
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;

            case 'compressor': // 2.5.1
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'solar-windmilling': // 2.5.2
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'boiler': // 2.5.3
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'conveyor-shelter-rack': // 2.5.4
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'generator': // 2.5.5
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'crane-hoist': // 2.5.6
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'contractor-maintenance-renovation': // 2.5.7
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'forklift-stocker': // 2.5.8
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
            case 'safety-goods': // 2.5.9
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'pump-motor': // 2.5.10
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'pipe-electrical-engineering': // 2.5.11
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'factory-gardening': // 2.5.12
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
            case 'maintenance-for-facility-pump-motor': // 2.5.13
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;

            case 'general-security': // 2.6.1
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
            case 'system-iot-dx-factory': // 2.6.2
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'consulting': // 2.6.3
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'canteen': // 2.6.4
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'trading-company': // 2.6.5
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'recruitment': // 2.6.6
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
            case 'logistics-warehouse-delivery-factory': // 2.6.7
                $data = (object)[
                    'input' => [
                        (object)['label' => __('phrase.domestic'), 'name' => 'domestic', 'type' => 'checkbox'],
                        (object)['label' => __('phrase.international'), 'name' => 'international', 'type' => 'text'],
                        (object)['label' => __('phrase.transport'), 'name' => 'method', 'type' => 'text'],
                        (object)['label' => __('phrase.items'), 'name' => 'item', 'type' => 'text'],
                        (object)['label' => __('phrase.services'), 'name' => 'service', 'type' => 'text'],
                        (object)['label' => __("phrase.$key.filter.typewarehouse"), 'name' => 'type','type'=>'text'],
                        (object)['label' => __("phrase.$key.filter.warehouse"), 'name' => 'warehouse', 'type' => 'text'],
                        (object)['label' => __("phrase.$key.filter.location"), 'name'=> 'location', 'type'=>'text']
                    ],
                    'filter' => [
                        'international' => \App\Models\ChoiceMd::where('type','transport')->select($select)->get(),
                        'method' => \App\Models\ChoiceMd::where('type','methods')->select($select)->get(),
                        'service' => \App\Models\ChoiceMd::where('type','services')->select($select)->get(),
                        'item' => \App\Models\ChoiceMd::where('type','warehouse')->select($select)->orderBy('key')->get(),
                        'type' => \App\Models\ChoiceMd::where('type','stock')->select($select)->get(),
                        'warehouse' => $location,
                        'location' => $location,
                    ]
                ];
                break;
            case 'other-service': // 2.6.8
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;

            case 'amata': // 2.7.1
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'pintong': // 2.7.2
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case '': // 2.7.3
                break;
            // case '': // 2.7.4
            //     break;
            // case '': // 2.7.5
            //     break;
            // case '': // 2.7.6
            //     break;
            // case '': // 2.7.7
            //     break;
            // case '': // 2.7.8
            //     break;
            // case '': // 2.7.9
            //     break;
            case 'agent-for-land-industrial': // 2.7.10
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

            case 'developer': // 3.1.1
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'contractor': // 3.1.2
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
            case 'contractor-service': // 3.1.2 **************************
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

            case 'compressor-construction': // 3.2.1
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'generator-construction': // 3.2.2
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'maintenance-for-facility-construction': // 3.2.3
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'solar-windmilling-construction': // 3.2.4
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

            case 'solar-windmilling-service': // 3.2.4 **********************
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

            case 'conveyor-shelter-rack-construction': // 3.2.5
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;

            case 'heavy-machinery': // 3.3.1
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'heavy-machinery-service': // 3.3.1 *****************
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'construction-machine': // 3.3.2
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;

            case 'door-window': // 3.4.1
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'fuel-gas-construction': // 3.4.2
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'electrical-equipment': // 3.4.3
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'leather-construction': // 3.4.4
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'rubber-construction': // 3.4.5
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'rock': // 3.4.6
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'brick-tile': // 3.4.7
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'sound': // 3.4.8
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'steel-metal': // 3.4.9
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'pipe-construction': // 3.4.10
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'valve': // 3.4.11
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'glass': // 3.4.12
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'chemical-construction': // 3.4.13
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'ceramic-construction': // 3.4.14
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'pulp-construction': // 3.4.15
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'blending-item': // 3.4.16
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'light': // 3.4.17
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;

            case 'bus': // 4.1.1
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'taxi': // 4.1.2
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'bts': // 4.1.3
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'air-plane': // 4.1.4
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'train': // 4.1.5
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;

            case 'fuel': // 4.2.1
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'gas': // 4.2.2
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'electric': // 4.2.3
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'windmilling': // 4.2.4
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;

            case 'airport': // 4.3.1
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'sea-port': // 4.3.2
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;

            case 'kindergarten': // 4.4.1
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'primary-school': // 4.4.2
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'junior-high-school': // 4.4.3
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'high-school': // 4.4.4
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'university': // 4.4.5
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;

            case 'embassy': // 4.5.1
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;

            case 'interconnection': // 4.6.1
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'radio-communication': // 4.6.2
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;

            case 'retail-bank': // 5.1.1
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'retail-insurance': // 5.1.2
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'retail-leasing': // 5.1.3
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

            case 'human': // 5.2.1
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'animal': // 5.2.2
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;

            case 'retail-travel-agency': // 5.3.1
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'hotel': // 5.3.2
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            // case 'car-for-rent': // 5.3.3
            //     $data = (object)[
            //         'input' => [],
            //         'filter' => []
            //     ];
            //     break;

            case 'kitchen': // 5.4.1
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'electronic': // 5.4.2
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'home-renovation': // 5.4.3
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'gardening-appliance': // 5.4.4
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
            case 'store': // 5.4.5
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;

            case 'daily-renovation': // 5.5.1
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'stock-room': // 5.5.2
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'engineering-maintenance': // 5.5.3
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
            case 'drug-store': // 5.5.4
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'cosmetic': // 5.5.5
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'pet': // 5.5.6
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'sport-entertainment': // 5.5.7
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
            case 'retail-other': // 5.5.8
                $data = (object)[
                    'input' => [],
                    'filter' => []
                ];
                break;
        }

        return $data;
    }

    public static function myFilter($category=null,$company=null)
    {
        $lang = Session('lang', 'th');
        // if (!$lang) { \App::setLocale('th'); $lang='th'; }
        $langP = $lang == 'th' ? 'th' : 'en';
        $key = ($category == null) ? request()->segment(2) : $category;

        $location = \App\Models\Filter\CpLocationMd::where('_id',$company)
            ->leftJoin('provinces as ch','cp_location.location','=','ch.province_id')
            ->select('province_id as key',"province_name_$langP as name")
            ->get();

        $select = ["ch.key","ch.name_$lang as name", "ch.name_th" ];
        $choice = "choice as ch";
        switch($key){
            case 'visa-support': // 1.1.1
                $data = [
                    'type' => \App\Models\Filter\CpVisaMd::select($select)
                        ->leftJoin($choice,'cp_visa.visa','=','ch.key')
                        ->where(['cp_visa._id' => $company, 'ch.type'=> 'type-of-visa'])
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'company-registration': // 1.1.2
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
            case 'law-firm': // 1.1.3
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
            case 'business-consulting': // 1.1.4
                $data = [
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"consultant-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'accounting': // 1.1.5
                $data = [
                    'service' => \App\Models\Filter\CpServiceMd::where(['cp_service._id'=>$company, 'ch.type'=>'account-service'])
                        ->leftJoin("choice as ch","cp_service.service","=","ch.key")
                        ->select($select)
                        ->get()->toJson(),
                    'other' => \App\Models\Filter\CpOtherMd::where(['cp_other._id'=>$company, 'ch.type'=>'account-other'])
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
            case 'translation-interpreter': // 1.1.6
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
            case 'agent-for-land': // 1.1.7
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

            case 'recruitment-agency': // 1.2.1
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
            case 'security': // 1.2.2
                $data = [
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(['ch.type'=>'security-system-service','cp_service._id'=>$company])
                        ->leftJoin("choice as ch","cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'logistics-warehouse-delivery': // 1.2.3
                $data = [
                    'domestic' => \App\Models\Filter\CpDomesticMd::where('_id',$company)
                        ->select('transport as key')
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
                    'type' => \App\Models\Filter\CpWarehouseMd::select($select)
                        ->where(["ch.type"=>"stock","cp_warehouse._id"=>$company,"cp_warehouse.type" => "type-warehouse"])
                        ->leftJoin($choice,"cp_warehouse.warehouse","=","ch.key")
                        ->get()->toJson(),
                    'warehouse' => \App\Models\Filter\CpWarehouseMd::where(['_id' => $company, "cp_warehouse.type" => "location-warehouse"])
                        ->leftJoin('provinces as pro','cp_warehouse.warehouse','=','pro.province_id')
                        ->select('warehouse as key',"pro.province_name_$langP as name")
                        ->get()->toJson(),
                    'location' => $location,
                ];
                break;
            case 'printing': // 1.2.4
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
            case 'gardening': // 1.2.5
                $data = [
                    'service' =>\App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"gardening-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'office-design-and-renovation': // 1.2.6
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
            case 'office-appliance': // 1.2.7
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select('ch.key',"ch.name_$lang as name")
                        ->where(['ch.type'=>'office-supplies-type','cp_type._id'=>$company])
                        ->leftJoin("choice as ch","cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'oa-machine': // 1.2.8
                $data = [];
                break;
            case 'office-equipment-maintenance': // 1.2.9
                $data = [];
                break;
            case 'website-development': // 1.2.10
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
            case 'system-iot-dx': // 1.2.11
                $data = [];
                break;
            case 'car-rental': // 1.2.12
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
            case 'it-computer-hardware': // 1.2.13
                $data = [
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"it-hardware-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'hardware' => \App\Models\Filter\CpHardwareMd::select($select)
                        ->where(["ch.type"=>"it-hardware","cp_hardware._id"=>$company])
                        ->leftJoin($choice,"cp_hardware.hardware","=","ch.key")
                        ->get()->toJson(),
                    'software' => \App\Models\Filter\CpSoftwareMd::select($select)
                        ->where(["ch.type"=>"software-development","cp_software._id"=>$company])
                        ->leftJoin($choice,"cp_software.software","=","ch.key")
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
            case 'call-center': // 1.3.1
                $data = [];
                break;
            case 'advertising-publisment': // 1.3.2
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
            case 'web-marketing': // 1.3.3
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
            // case 'exhibition': // 1.3.4
            //     break;

            case 'financial': // 1.4.1
                $data = [];
                break;
            case 'leasing': // 1.4.2
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"leasing-type","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'insurance': // 1.4.3
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
            // case 'factoring': // 1.4.4
            //     $data = [];
            //     break;
            // case 'credit-cards': // 1.4.5
            //     $data = [];
            //     break;

            case 'travel-agency': // 1.5.1
                $data = [];
                break;
            case 'hotel-accommodation': // 1.5.2
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
            case 'event-organizer-exhibition': // 1.5.3
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
            case 'gift-suvenir': // 1.5.4
                $data = [];
                break;

            case 'press-machine': // 2.1.1
                $data = [];
                break;
            case 'cnc-lathe-manual-late': // 2.1.2
                $data = [];
                break;
            case 'machine-center-milling-machine': // 2.1.3
                $data = [];
                break;
            case 'die-casting-machine': // 2.1.4
                $data = [];
                break;
            case 'plastic-injection': // 2.1.5
                $data = [];
                break;
            case 'welding-machine': // 2.1.6
                $data = [];
                break;
            case 'robot-automation': // 2.1.7
                $data = [];
                break;
            case 'machine-maintennance-spare-part': // 2.1.8
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
            case 'second-hand-machine': // 2.1.9
                $data = [];
                break;
            case 'coating-painting-heating-treatment-machine': // 2.1.10
                $data = [];
                break;
            case 'grinding-edm-wire-cut-machine': // 2.1.11
                $data = [];
                break;
            case 'qc-equipment': // 2.1.12
                $data = [];
                break;
            case 'cutting-blending-machine': // 2.1.13
                $data = [];
                break;
            case 'hand-tools': // 2.1.14
                $data = [
                    'type'=> \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"mechanic-tools-type","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'washing-machine': // 2.1.15
                $data = [];
                break;
            case 'painting-equipment': // 2.1.16
                $data = [];
                break;
            case 'special-machine-product-designed-line': // 2.1.17
                $data = [];
                break;
            case 'other-machine-equipment': // 2.1.18
                $data = [];
                break;
            case 'clean-room-temperature-control': // 2.1.19
                $data = [];
                break;

            case 'automotive-motorcycle-industrial': // 2.2.1
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
            case 'chemical-industrial': // 2.2.2
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->where(["ch.type"=>"type-of-chemicals",'cp_type._id'=>$company])
                        ->get(),
                    'location' => $location
                ];
                break;
            case 'jewely-cosmetic-industrial': // 2.2.3
                $data = [];
                break;
            case 'food-drinks-industrial': // 2.2.4
                $data = [];
                break;
            case 'mold': // 2.2.5
                $data = [];
                break;
            case 'electric-product-part-industrial': // 2.2.6
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
            case 'electric-product-part-industrial-service': // 2.2.6 ******************
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
            case 'home-appliance-industrial': // 2.2.7
                $data = [
                    'product' => \App\Models\Filter\CpProductMd::select($select)
                        ->leftJoin($choice,"cp_product.product","=","ch.key")
                        ->where(['ch.type'=>'product-category','cp_product._id'=>$company])
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'agriculture-industrial': // 2.2.8
                $data = [];
                break;
            case 'heavy-machine-industrial': // 2.2.9
                $data = [];
                break;
            case 'job-shops': // 2.2.10
                $data = [];
                break;
            case 'textile-garment': // 2.2.11
                $data = [];
                break;
            case 'shoes-bags': // 2.2.12
                $data = [];
                break;
            case 'medical-industrial': // 2.2.13
                $data = [];
                break;
            case 'glass-mirror-lens': // 2.2.14
                $data = [];
                break;
            case 'packaging': // 2.1.15
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
            case 'other-industrial': // 2.2.16
                $data = [];
                break;

            case 'cutting-tool-grinding-stone': // 2.3.1
                $data = [];
                break;
            case 'coolant-oil': // 2.3.2
                $data = [];
                break;
            case 'chemical': // 2.3.3
                $data = [];
                break;
            case 'filter': // 2.3.4
                $data = [];
                break;
            case 'fuel-gas': // 2.3.5
                $data = [];
                break;
            case 'paint': // 2.3.6
                $data = [];
                break;

            case 'textile-silk': // 2.4.1
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
            case 'rubber': // 2.4.2
                $data = [];
                break;
            case 'plastic-resin': // 2.4.3
                $data = [];
                break;
            case 'pipe': // 2.4.4
                $data = [];
                break;
            case 'pulp': // 2.4.5
                $data = [];
                break;
            case 'woods': // 2.4.6
                $data = [];
                break;
            case 'ceramic': // 2.4.7
                $data = [];
                break;
            case 'leather': // 2.4.8
                $data = [];
                break;

            case 'compressor': // 2.5.1
                $data = [];
                break;
            case 'solar-windmilling': // 2.5.2
                $data = [];
                break;
            case 'boiler': // 2.5.3
                $data = [];
                break;
            case 'conveyor-shelter-rack': // 2.5.4
                $data = [];
                break;
            case 'generator': // 2.5.5
                $data = [];
                break;
            case 'crane-hoist': // 2.5.6
                $data = [];
                break;
            case 'contractor-maintenance-renovation': // 2.5.7
                $data = [];
                break;
            case 'forklift-stocker': // 2.5.8
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
            case 'safety-goods': // 2.5.9
                $data = [];
                break;
            case 'pump-motor': // 2.5.10
                $data = [];
                break;
            case 'pipe-electrical-engineering': // 2.5.11
                $data = [];
                break;
            case 'factory-gardening': // 2.5.12
                $data = [
                    'service' =>\App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"gardening-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'maintenance-for-facility-pump-motor': // 2.5.13
                $data = [];
                break;

            case 'general-security': // 2.6.1
                $data = [
                    'service' => \App\Models\Filter\CpServiceMd::select($select)
                        ->where(['ch.type'=>'security-system-service','cp_service._id'=>$company])
                        ->leftJoin("choice as ch","cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'system-iot-dx-factory': // 2.6.2
                $data = [];
                break;
            case 'consulting': // 2.6.3
                $data = [];
                break;
            case 'canteen': // 2.6.4
                $data = [];
                break;
            case 'trading-company': // 2.6.5
                $data = [];
                break;
            case 'recruitment': // 2.6.6
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
            case 'logistics-warehouse-delivery-factory': // 2.6.7
                $data = [
                    'domestic' => \App\Models\Filter\CpDomesticMd::where('_id',$company)
                        ->select('transport as key')
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
                    'type' => \App\Models\Filter\CpWarehouseMd::select($select)
                        ->where(["ch.type"=>"stock","cp_warehouse._id"=>$company])
                        ->leftJoin($choice,"cp_warehouse.warehouse","=","ch.key")
                        ->get()->toJson(),
                    'warehouse' => \App\Models\Filter\CpWarehouseMd::where('_id',$company)
                        ->leftJoin('provinces as pro','cp_warehouse.warehouse','=','pro.province_id')
                        ->select('warehouse as key',"pro.province_name_$langP as name")
                        ->get()->toJson(),
                    'location' => $location,
                ];
                break;
            case 'other-service': // 2.6.8
                $data = [];
                break;

            case 'amata': // 2.7.1
                $data = [];
                break;
            case 'pintong': // 2.7.2
                $data = [];
                break;
            // case '': // 2.7.3
            //     break;
            // case '': // 2.7.4
            //     break;
            // case '': // 2.7.5
            //     break;
            // case '': // 2.7.6
            //     break;
            // case '': // 2.7.7
            //     break;
            // case '': // 2.7.8
            //     break;
            // case '': // 2.7.9
            //     break;
            case 'agent-for-land-industrial': // 2.7.10
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

            case 'developer': // 3.1.1
                $data = [];
                break;
            case 'contractor': // 3.1.2
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
            case 'contractor-service': // 3.1.2 *****************
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

            case 'compressor-construction': // 3.2.1
                $data = [];
                break;
            case 'generator-construction': // 3.2.2
                $data = [];
                break;
            case 'maintenance-for-facility-construction': // 3.2.3
                $data = [];
                break;
            case 'solar-windmilling-construction': // 3.2.4
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

            case 'solar-windmilling-service': // 3.2.4 ***************************
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

            case 'conveyor-shelter-rack-construction': // 3.2.5
                $data = [];
                break;

            case 'heavy-machinery': // 3.3.1
                $data = [];
                break;
            case 'heavy-machinery-service': // 3.3.1
                $data = [];
                break;
            case 'construction-machine': // 3.3.2
                $data = [];
                break;

            case 'door-window': // 3.4.1
                $data = [];
                break;
            case 'fuel-gas-construction': // 3.4.2
                $data = [];
                break;
            case 'electrical-equipment': // 3.4.3
                $data = [];
                break;
            case 'leather-construction': // 3.4.4
                $data = [];
                break;
            case 'rubber-construction': // 3.4.5
                $data = [];
                break;
            case 'rock': // 3.4.6
                $data = [];
                break;
            case 'brick-tile': // 3.4.7
                $data = [];
                break;
            case 'sound': // 3.4.8
                $data = [];
                break;
            case 'steel-metal': // 3.4.9
                $data = [];
                break;
            case 'pipe-construction': // 3.4.10
                $data = [];
                break;
            case 'valve': // 3.4.11
                $data = [];
                break;
            case 'glass': // 3.4.12
                $data = [];
                break;
            case 'chemical-construction': // 3.4.13
                $data = [];
                break;
            case 'ceramic-construction': // 3.4.14
                $data = [];
                break;
            case 'pulp-construction': // 3.4.15
                $data = [];
                break;
            case 'blending-item': // 3.4.16
                $data = [];
                break;
            case 'light': // 3.4.17
                $data = [];
                break;

            case 'bus': // 4.1.1
                $data = [];
                break;
            case 'taxi': // 4.1.2
                $data = [];
                break;
            case 'bts': // 4.1.3
                $data = [];
                break;
            case 'air-plane': // 4.1.4
                $data = [];
                break;
            case 'train': // 4.1.5
                $data = [];
                break;

            case 'fuel': // 4.2.1
                $data = [];
                break;
            case 'gas': // 4.2.2
                $data = [];
                break;
            case 'electric': // 4.2.3
                $data = [];
                break;
            case 'windmilling': // 4.2.4
                $data = [];
                break;

            case 'airport': // 4.3.1
                $data = [];
                break;
            case 'sea-port': // 4.3.2
                $data = [];
                break;

            case 'kindergarten': // 4.4.1
                $data = [];
                break;
            case 'primary-school': // 4.4.2
                $data = [];
                break;
            case 'junior-high-school': // 4.4.3
                $data = [];
                break;
            case 'high-school': // 4.4.4
                $data = [];
                break;
            case 'university': // 4.4.5
                $data = [];
                break;

            case 'embassy': // 4.5.1
                $data = [];
                break;

            case 'interconnection': // 4.6.1
                $data = [];
                break;
            case 'radio-communication': // 4.6.2
                $data = [];
                break;

            case 'retail-bank': // 5.1.1
                $data = [];
                break;
            case 'retail-insurance': // 5.1.2
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
            case 'retail-leasing': // 5.1.3
                $data = [
                    'type' => \App\Models\Filter\CpTypeMd::select($select)
                        ->where(["ch.type"=>"leasing-type","cp_type._id"=>$company])
                        ->leftJoin($choice,"cp_type._type","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;

            case 'human': // 5.2.1
                $data = [];
                break;
            case 'animal': // 5.2.2
                $data = [];
                break;

            case 'retail-travel-agency': // 5.3.1
                $data = [];
                break;
            case 'hotel': // 5.3.2
                $data = [];
                break;
            // case 'car-for-rent': // 5.3.3
            //     $data = [];
            //     break;

            case 'kitchen': // 5.4.1
                $data = [];
                break;
            case 'electronic': // 5.4.2
                $data = [];
                break;
            case 'home-renovation': // 5.4.3
                $data = [];
                break;
            case 'gardening-appliance': // 5.4.4
                $data = [
                    'service' =>\App\Models\Filter\CpServiceMd::select($select)
                        ->where(["ch.type"=>"gardening-service","cp_service._id"=>$company])
                        ->leftJoin($choice,"cp_service.service","=","ch.key")
                        ->get()->toJson(),
                    'location' => $location
                ];
                break;
            case 'store': // 5.4.5
                $data = [];
                break;

            case 'daily-renovation': // 5.5.1
                $data = [];
                break;
            case 'stock-room': // 5.5.2
                $data = [];
                break;
            case 'engineering-maintenance': // 5.5.3
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
            case 'drug-store': // 5.5.4
                $data = [];
                break;
            case 'cosmetic': // 5.5.5
                $data = [];
                break;
            case 'pet': // 5.5.6
                $data = [];
                break;
            case 'sport-entertainment': // 5.5.7
                $data = [];
                break;
            case 'retail-other': // 5.5.8
                $data = [];
                break;
        }
        return $data;
    }

    public function confirmation()
    {
        return view('front-end.confirmation',['prefix'=>$this->prefix]);
    }
}
