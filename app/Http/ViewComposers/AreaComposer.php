<?php

namespace App\Http\ViewComposers;

use App\Area;
use Illuminate\Contracts\View\View;

class AreaComposer 
{
    private $area;
    
    public function compose(View $view) 
    {
        if(!$this->area) {
            $this->area = Area::where('slug', session()
                    ->get('area', config()->get('passona.defaults.area')))
                    ->first();
        }
        
        return $view->with('area', $this->area);
    }
}
