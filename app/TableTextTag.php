<?
namespace App;

use App\Contracts\Message\TextTag;

class TableTextTag implements TextTag
{
    public function tags($table, $model, $condition = null)
    {
        // $fields = Schema::getColumnListing($table);
        
        //TODO: there are many condition types, go a little deeper; adding whereBetween, etc...
        if(is_null($condition)) {
            $models = $model::all();
        } else {
            $models = $model::whereIn('id', $condition)->get();
        }
        
        $tags = array();
        foreach($models as $mod){
            foreach($mod->getAttributes() as $field => $value){
                $tags[$mod->id][$field] = $value;
            }
        }
        return $tags;
    }
}
