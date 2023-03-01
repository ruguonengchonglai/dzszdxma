<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TargetsSd extends Model
{
    protected $table='pm_targets_sd';
    protected $primaryKey='id';

    /**获得列表
     * @param $typeId
     * @param int $limit
     * @param int $page
     * @param string $vChar
     * @return \Illuminate\Support\Collection
     */
    public function getList($limit = 10 ,$page = 1){
        $query = DB::table($this->table)
            ->select();
        return $query->offset($limit*($page-1))->limit($limit)->get();
    }
   
    /**
     * 通过id查找数据
     *
     * @param [type] $id
     * @return void
     */
    public function getData($entrust_code){
        $data = DB::table($this->table)
            ->where('id',$entrust_code)
            ->first();
        return $data;
    }
   /**插入数据
    */
    public function insert($data){
        if(!isset($data['createdAt'])){
            $data['createdAt'] = time();
        }
        $id = DB::table($this->table)
            ->insertOrIgnore($data);
        return $id;
    }

    public function getListCount($typeId,$vChar = '')
    {
        $query = DB::table($this->table)
            ->select(['entry_id','entry_name','entry_content'])
            ->where(array('channel'=>$typeId,'is_top'=>0));
        if($vChar != ''){
            $query->where('v_char',strtoupper($vChar));
        }
        return $query->count();
    }

    /**获得文章详情
     * @param $entryId
     * @return Model|\Illuminate\Database\Query\Builder|null|object
     */
    public function getDetailByEntryId($entryId){
        return DB::table($this->table)->where($this->primaryKey,$entryId)->first();
    }
    
    /**
     * 更新数据**/
     
    public function updateByEntryId($entryId,$data){
         return DB::table($this->table)->where('id', $entryId)->update($data);
    }

    public function getTopArticle($typeId,$vChar = '',$limit = 2){
        $query = DB::table($this->table);
        if($vChar != ''){
            $query->where('v_char',strtoupper($vChar));
        }
        $where = array(
            'channel'=>$typeId,
            'is_top'=>1
        );
        return $query->where($where)->limit($limit)->get();
    }

    public function getDetails($entryId,$uid = 0){
        $row = DB::table($this->table)
            ->select([$this->table.'.*','thumb_up.good_num','at.channel','at.name as class_name','at.pid','at.class as type_class'])
            ->leftJoin('thumb_up',$this->table.'.'.$this->primaryKey,'=','thumb_up.entry_id')
            ->leftJoin('article_type as at','at.channel',$this->table.'.channel')
            ->where($this->table.'.'.$this->primaryKey,$entryId)
            ->first();

        if($row){
            $row->p_name = ArticleType::where('channel',$row->pid)->select('name')->first()['name'];

            if($row->good_num == null){
                $row->good_num = 0;
            }

            if($uid != 0){
                $coll = new Collection();
                $cRow = $coll->getDetails(array('entry_id'=>$entryId,'user_id'=>$uid,'class'=>'article'));
                if($cRow){
                    $row->is_coll = true;
                }else{
                    $row->is_coll = false;
                }
            }else{
                $row->is_coll = false;
            }
        }

        return $row;
    }
}
