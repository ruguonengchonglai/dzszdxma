<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Auction extends Model
{
    protected $connection = 'mysql_new';
    protected $table = "ea_auction";
    protected $primaryKey='id';
    
    /**
     * 根据id查看拍卖会
     *
     * @param integer $limit
     * @param integer $page
     * @return void
     */
    public function getData($id){
        $data = DB::connection($this->connection)
            ->table($this->table)
            ->where('id',$id)
            ->first();
        return $data;
    }


    /**
     * 根据id查看标的
     */
    public function getTarData($id){
        $data = DB::connection($this->connection)
            ->table('ea_targets')
            ->where('auction_id',$id)
            ->get();
        return $data;
    }
}
