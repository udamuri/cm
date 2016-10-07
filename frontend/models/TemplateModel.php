<?php
namespace frontend\models;

use Yii;
use app\components\Constants;
use yii\base\Model;
use yii\helpers\Html;
use yii\data\Pagination;

class TemplateModel extends Model
{
    

    public function getCatalog($page_Size = 10, $_kategori = '', $search = '')
    {
        $query = (new \yii\db\Query())
                    ->select([
                        'catalog_id',
                        'catalog_name',
                        'catalog_image',
                    ])
                    ->from('tbl_catalog')
                    ->where('1')
                    ->andWhere(['catalog_status'=>1]);
        

        if($search !== '')
        {
            $query->andWhere('lower(catalog_name) LIKE "%'.$search.'%" OR lower(catalog_desc) LIKE "%'.$search.'%" ');
        }

        if($_kategori != '0')
        {
            $query->andWhere('catalog_category_id = "'.$_kategori.'"'); 
        }
        
        $countQuery = clone $query;
        $pageSize = (int)$page_Size;
        $pages = new Pagination([
                'totalCount' => $countQuery->count(), 
                'pageSize'=>$pageSize
            ]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy(['catalog_id'=>SORT_DESC])
            ->all();

        return [
                'catalog_cat' => $this->getCatalogCategory(),
                '_kategori' => $_kategori,
                'models' => $models,
                'pages' => $pages,
                'offset' =>$pages->offset,
                'page' =>$pages->page,
                'search' =>$search
            ]; 
    }

    //get comment
    public function getCatalogCategory($limit = 0)
    {

        //$uid = Yii::$app->user->identity->id;
        
        $query = (new \yii\db\Query())
                    ->select([
                        'category_id',
                        'category_parent_id',
                        'category_name',
                        'category_status',
                    ])
                    ->from('tbl_catalog_category')
                    ->where('1')
                    ->andWhere(['category_status'=>1]);

                    if($limit > 0)
                    {
                         $query->limit(10);  
                    }
                   
                    $query->orderBy(['category_name'=>SORT_ASC]);

                    $rows = $query->all();
        
        if($query)
        {
            return $rows;  
        }
        return false;
    }

    //get comment
    public function getNewCatalog()
    {

        //$uid = Yii::$app->user->identity->id;
        
        $query = (new \yii\db\Query())
                    ->select([
                        'catalog_id',
                        'catalog_name',
                        'catalog_image',
                    ])
                    ->from('tbl_catalog')
                    ->where('1')
                    ->andWhere(['catalog_status'=>1])
                    ->limit(8)
                    ->orderBy(['catalog_id'=>SORT_DESC])
                    ->all();
        
        if($query)
        {
            return $query;  
        }
        return false;
    }

    //get comment
    public function getRandomCatalog($limit = 8)
    {

        //$uid = Yii::$app->user->identity->id;
        
        $query = (new \yii\db\Query())
                    ->select([
                        'catalog_id',
                        'catalog_name',
                        'catalog_image',
                    ])
                    ->from('tbl_catalog')
                    ->where('1')
                    ->andWhere(['catalog_status'=>1])
                    ->limit($limit)
                    ->orderBy(['catalog_id'=>rand()])
                    ->all();
        
        if($query)
        {
            return $query;  
        }
        return false;
    }

    //get comment
    public function getRandomClient()
    {

        //$uid = Yii::$app->user->identity->id;
        
        $query = (new \yii\db\Query())
                    ->select([
                        'client_id',
                        'client_name',
                        'client_image',
                    ])
                    ->from('tbl_client')
                    ->where('1')
                    ->andWhere(['client_status'=>1])
                    ->limit(8)
                    ->orderBy(['client_id'=>rand()])
                    ->all();
        
        if($query)
        {
            return $query;  
        }
        return false;
    }

    //get detail
    public function getDetailCatalog($cid)
    {

        //$uid = Yii::$app->user->identity->id;
        
        $query = (new \yii\db\Query())
                    ->select([
                        'catalog_id',
                        'catalog_name',
                        'catalog_image',
                        'catalog_desc',
                    ])
                    ->from('tbl_catalog')
                    ->where('1')
                    ->andWhere(['catalog_status'=>1])
                    ->andWhere(['catalog_id'=>$cid])
                    ->one();
        
        if($query)
        {
            return $query;  
        }

        return false;
    }

    //get comment
    public function getContentDetail($id = 0)
    {

        //$uid = Yii::$app->user->identity->id;
        
        $query = (new \yii\db\Query())
                    ->select([
                        'content_id',
                        'content_desc',
                    ])
                    ->from('tbl_content')
                    ->where('1')
                    ->andWhere(['content_id'=>$id])
                    ->one();
        
        if($query)
        {
            return $query;  
        }
        return false;
    }
}