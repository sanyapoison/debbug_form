<?
if(!(strlen($_POST["id_et"])))
    $_POST["id_et"] = 0;

if(!(strlen($_POST["id_block"])))
    $_POST["id_block"] = 0;

/*
echo "<pre>";
print_r($_POST);
echo "</pre>";
*/

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php';

if (CModule::IncludeModule('iblock')) { 
    echo "<script>console.log('modul iblock_map_vid');</script>"; 
    $arFilter = Array("IBLOCK_ID"=>17, "ACTIVE"=>"Y", "PROPERTY_komplex"=>$_POST["id_komplex"], "PROPERTY_hodstroi"=>$_POST["id_gallery_hod_stroi"]);
    $resList = CIBlockElement::GetList(array(), $arFilter);
    
    if($resList){
        echo "<script>console.log('определен список слайдов');</script> <div class='hod_stroi_detail_product_gallery'>";  
            while($obList = $resList->GetNextElement()){
                $arListFields = $obList->GetFields();
                $arListProperties = $obList->GetProperties();
                $block_slide_url_detail = CFile::GetPath($arListFields["DETAIL_PICTURE"]);  
                echo "<div class='slick-slide-item'><img src='".$block_slide_url_detail."'></div>";   
                /*  
                echo "<pre>";
                print_r($arListProperties);
                echo "</pre>"; 
                */               
            }
            
        echo "</div>";    
                   
    }

    else{
        echo "<script>console.log('не определен список слайдов');</script>";
    } 
    
    
}
else{
    echo "<script>console.log('no modul iblock_map_vid');</script>";    
}
?>

