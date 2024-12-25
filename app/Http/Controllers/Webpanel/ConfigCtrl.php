<?php

namespace App\Http\Controllers\Webpanel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

use Illuminate\Filesystem\Filesystem as File;


class ConfigCtrl extends Controller
{
    /**
	 * Instance of the File class
	 *
	 * @var \Illuminate\Filesystem\Filesystem
	 */
    protected $file;
    /**
	 * Instance of the Config class
	 *
	 * @var \Illuminate\Config\Repository
	 */
	protected $repository;
    /**
	 * Cache of configuration contents
	 *
	 * @var string
	 */
    protected $contentsCache;
    /**
	 * Creates the PackageInstaller Instance
	 *
	 * @param Illuminate\Filesystem\Filesystem $file
	 */
	public function __construct(File $file, Config $config)
	{
		$this->file = $file;
		$this->config = $config;
	}

    protected function configCategoryUpdate()
    {
        // $this->getConfigContents();
        $array = $this->getNewConfig();
        $this->replaceConfig($array);
        $this->putConfigContents();
    }
    protected function getConfig()
    {
        $string = str_replace('];','',$this->contentsCache);
        $string = str_replace('[','',$string);
        $string = str_replace(']','',$string);
        $string = trim($string);
        $array = explode(',',$string);
        return $array;
    }
    protected function getNewConfig()
	{
		$categoryMap = array();
		foreach(\App\Models\CategoryMd::get() as $k => $v)
        {
			$categoryMap[] = $v->key;
		}
        return $categoryMap;
	}

	protected function putConfigContents()
	{
		return $this->file->put($this->getConfigPath(), $this->contentsCache);
	}

    protected function replaceConfig($array)
	{
        $replace = $this->getNewConfigContents($array);
		$this->contentsCache = $replace;
	}

	protected function getNewConfigContents($array)
	{
        $header = "<?php\nreturn [\n\t'category' => [\n\t\t'";
        $values = implode("',\n\t\t'", $array);
        $content = $header.$values."',\n\t]\n];";
		return $content;
	}

	protected function getConfigContents()
	{
		if(!isset($this->contentsCache)) {
			$this->contentsCache = $this->file->get($this->getConfigPath());
		}
		return $this->contentsCache;
    }

    protected function getConfigPath()
	{
		return config_path('category.php');
	}
}
