<?php 
function dequy($data,$selected = 0,$parent=0,$str=""){

  foreach($data as $key => $value){
    
    if ($value->parent_id == $parent){
      if($value->id == $selected){
        echo'<option value="'.$value->id.'" selected>'.$str.''.$value->name.'</option>';
      }else{  
        echo'<option value="'.$value->id.'">'.$str.''.$value->name.'</option>';
      }

      dequy($data,$selected,$value->id,$str."---|");
    }
  }
}


function dequycate($data,$selected = 0,$parent=0,$str=""){

  foreach($data as $key => $value){
    
    if ($value->parent_id == $parent){
      if($value->id == $selected){
        echo'<option value="'.$value->id.'" selected>'.$str.''.$value->name.'</option>';
      }else{  
        echo'<option value="'.$value->id.'">'.$str.''.$value->name.'</option>';
      }

      dequycate($data,$selected,$value->id,$str."---|");
    }
  }
}




function showCategories($categories, $category_product = [], $parent_id = 0, $char = '')
{
    // BƯỚC 2.1: LẤY DANH SÁCH CATE CON
    $cate_child = array();
    foreach ($categories as $key => $item)
    {
        // Nếu là chuyên mục con thì hiển thị
        if ($item->parent_id == $parent_id)
        {
            $cate_child[] = $item;
            unset($categories[$key]);
        }
    }
     
    // BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ
    if ($cate_child)
    {
        echo '<ul>';
        foreach ($cate_child as $key => $item)
        {
          
            if (in_array($item->id, $category_product)) {
              echo '<li><input type="checkbox" checked="checked" name="category[]" value="'.$item->id.'" /> '.$item->name;
            } else {
              echo '<li><input type="checkbox" name="category[]" value="'.$item->id.'" /> '.$item->name;
            }
            // Hiển thị tiêu đề chuyên mục
            
             
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showCategories($categories, $category_product, $item->id, $char.'|---');
            echo '</li>';
        }
        echo '</ul>';
    }
}




// Checkbox attribute
function showAttribute($attribute, $product_attribute = [], $parent_id = 0, $char = '')
{
    // BƯỚC 2.1: LẤY DANH SÁCH CATE CON
    $attribute_child = array();
    foreach ($attribute as $key => $item)
    {
        // Nếu là chuyên mục con thì hiển thị
        if ($item->parent_id == $parent_id)
        {
            $attribute_child[] = $item;
            unset($attribute[$key]);
        }
    }
     
    // BƯỚC 2.2: HIỂN THỊ DANH SÁCH CHUYÊN MỤC CON NẾU CÓ
    if ($attribute_child)
    {
        echo '<ul>';
        foreach ($attribute_child as $key => $item)
        {
          
            if (in_array($item->id, $product_attribute)) {
              echo '<li><input type="checkbox" checked="checked" name="attribute[]" value="'.$item->id.'" /> '.$item->name;
            } else {
              echo '<li><input type="checkbox" name="attribute[]" value="'.$item->id.'" /> '.$item->name;
            }
            // Hiển thị tiêu đề chuyên mục
            
             
            // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
            showAttribute($attribute, $product_attribute, $item->id, $char.'|---');
            echo '</li>';
        }
        echo '</ul>';
    }
}
?>