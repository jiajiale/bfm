<?php
/**
 * Created by PhpStorm.
 * User: KU04PC
 * Date: 2015/5/11
 * Time: 21:07
 */

namespace Admin\Data;


use Admin\Model\BaseModel;
use Common\Util\Page;

class BaseData extends BaseModel{

    /**
     * 获取分页数据
     * @return Page
     */
    public function selectPage()
    {
        $options = $this->options;
        $page = new Page();
        $pagePara = $options['page'];
        $page->setPageIndex($pagePara[0]);
        $page->setPageSize($pagePara[1]);
        $data = $this->select();
        if ($data) {
            $page->setItems($data);
        } else {
            return false;
        }

        //统计数量
        $options['page'] = null; //去除分页条件
        $options['order'] = null; //去除排序
        $sql = ($this->buildSql($options));
        $sql = 'SELECT COUNT(*) AS item_count FROM' . $sql . 'count_temp';
        $result = $this->query($sql);
        if($result){
            $page->setItemsCount((int)$result[0]['item_count']);
        }else{
            $page->setItemsCount(0);
        }

        $page->calcTotalPages(); //计算分页数
        return $page;
    }
}