<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sale;
use App\Profitability;
use App\Gearing;
use App\DSCR;
use App\Creditors;
use App\Debtor;
use App\Liquidity;
use App\Worth;

class FinancialAnalysis extends Model {

	//

    public function  sale()
    {
        return $this::hasOne('App\Sale','fa_id','id');
    }
    public function  profitability()
    {
        return $this::hasOne('App\Profitability','fa_id','id');
    }
    public function  gearing()
    {
        return $this::hasOne('App\Gearing','fa_id','id');
    }
    public function  dscr()
    {
        return $this::hasOne('App\DSCR','fa_id','id');
    }
    public function  creditors()
    {
        return $this::hasOne('App\Creditors','fa_id','id');
    }
    public function  debtor()
    {
        return $this::hasOne('App\Debtor','fa_id','id');
    }
    public function  liquidity()
    {
        return $this::hasOne('App\Liquidity','fa_id','id');
    }
    public function  worth()
    {
        return $this::hasOne('App\Worth','fa_id','id');
    }


}
