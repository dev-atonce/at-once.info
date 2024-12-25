<?php

namespace App\Http\Controllers\Webpanel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

use Illuminate\Filesystem\Filesystem as File;


class CssCtrl extends Controller
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

    protected function configColorUpdate()
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
		$color = array();
        foreach(\App\Http\Models\ColorMd::all() as $k => $v)
        {
            $color['--primary'] = $v->primary;
            $color['--secondary'] = $v->secondary;
            $color['--info'] = $v->info;
            $color['--light'] = $v->light;
            $color['--dark'] = $v->dark;
            $color['--warning'] = $v->warning;
            $color['--danger'] = $v->danger;
            $color['--success'] = $v->success;
        }
		
        return $color;
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
        $header = "::root{\n'";
        $values = '';
        foreach($array as $k => $v){
            $values += "    $k: $v\n\t";
        }
        $content = $header.$values."'\n}";
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
		return public_path('css/color.css');
	}
}
